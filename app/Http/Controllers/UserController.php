<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getEmployeesindex(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with(['roles' => function ($query) {
                $query->whereIn('name', array('Manager', 'Sales Executive'));
            }])
                ->withTrashed()
                ->whereHas('roles', function ($query) {
                    $query->whereIn('name', array('Manager', 'Sales Executive'));
                })
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('gender', function ($row) {
                    return ucfirst($row['gender']);
                })
                ->addColumn('role', function ($row) {
                    $role = $row->roles;
                    return ucfirst($role[0]['name']);
                })
                ->addColumn('action', function ($row) {

                    $btn = '<div class="d-flex justify-content-around">'
                        . '<div>'
                        . '<a type="button" class="btn btn-sm btn-info" href="' . route('users.show', $row['id']) . '">'
                        . '<i class="bi bi-eye"></i>'
                        . '</a>'
                        . '</div>'
                        . '<div>'
                        . '<a type="button" class="btn btn-sm btn-warning" href="' . route('users.edit', $row['id']) . '">'
                        . '<i class="ri-file-edit-line"></i>'
                        . '</a>'
                        . '</div>'
                        . '<div>'
                        . '<form action="' . route('users.destroy', $row['id']) . '" method="POST">'
                        . '<input type="hidden" name="_method" value="DELETE">'
                        . csrf_field()
                        . '<button type="submit" class="btn btn-sm btn-danger">'
                        . '<i class="ri-delete-bin-6-line"></i>'
                        . '</button>'
                        . '</form>'
                        . '</div>'
                        . '</div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('users.employee-index');
    }

    public function getCustomersindex(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with(['roles' => function ($query) {
                $query->whereIn('name', array('Customer'));
            }])
                ->withTrashed()
                ->whereHas('roles', function ($query) {
                    $query->whereIn('name', array('Customer'));
                })
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('gender', function ($row) {
                    return ucfirst($row['gender']);
                })
                ->addColumn('role', function ($row) {
                    $role = $row->roles;
                    return ucfirst($role[0]['name']);
                })
                ->addColumn('action', function ($row) {

                    $btn = '<div class="d-flex justify-content-around">'
                        . '<div>'
                        . '<a type="button" class="btn btn-sm btn-info" href="' . route('users.show', $row['id']) . '">'
                        . '<i class="bi bi-eye"></i>'
                        . '</a>'
                        . '</div>'
                        . '<div>'
                        . '<a type="button" class="btn btn-sm btn-warning" href="' . route('users.edit', $row['id']) . '">'
                        . '<i class="ri-file-edit-line"></i>'
                        . '</a>'
                        . '</div>'
                        . '<div>'
                        . '<form action="' . route('users.destroy', $row['id']) . '" method="POST">'
                        . '<input type="hidden" name="_method" value="DELETE">'
                        . csrf_field()
                        . '<button type="submit" class="btn btn-sm btn-danger">'
                        . '<i class="ri-delete-bin-6-line"></i>'
                        . '</button>'
                        . '</form>'
                        . '</div>'
                        . '</div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('users.customer-index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('name', '<>', 'admin')->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $input = $request->only(['name', 'email', 'password', 'dob', 'phone', 'gender', 'address', 'status', 'role_id']);
            $input['password'] = Hash::make($input['password']);
            $input['name'] = ucwords($input['name']);

            $role = Role::find($input['role_id']);

            if (!$role) {
                return redirect()->back()->withInput();
            }

            $uniqueId = User::getUserUniqueId($role->name);

            $user = User::create([
                'unique_id' => $uniqueId,
                'name' => $input['name'],
                'phone' => $input['phone'],
                'email' => $input['email'],
                'password' => $input['password'],
                'dob' => $input['dob'],
                'gender' => $input['gender'],
                'address' => $input['address'],
                'status' => $input['status'],
            ]);

            $user->assignRole($role->name);

            DB::commit();

            if ($role->name == ROLE_CUSTOMER) {
                return redirect(route('get_customers'));
            } else {
                return redirect(route('get_employees'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            logError($e, 'Error While Storing User Details', 'app/Http/Controllers/UserController.php');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('roles')->findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::where('name', '<>', 'admin')->get();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $input = $request->only(['name', 'email', 'password', 'dob', 'phone', 'gender', 'address', 'status', 'role_id']);
            $input['password'] = Hash::make($input['password']);
            $input['name'] = ucwords($input['name']);

            $user = User::with('roles')->findOrFail($id);

            if ($user->roles[0]['id'] != $input['role_id']) {
                $newRole = Role::find($input['role_id']);
                $user->syncRoles([$newRole->name]);
            }

            $user->update([
                'name' => $input['name'],
                'phone' => $input['phone'],
                'email' => $input['email'],
                'password' => $input['password'],
                'dob' => $input['dob'],
                'gender' => $input['gender'],
                'address' => $input['address'],
                'status' => $input['status'],
            ]);

            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            logError($e, 'Error While Updating User Details', 'app/Http/Controllers/UserController.php');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $user->update([
                'status' => STATUS_INACTIVE,
            ]);
            $user->delete();
            DB::commit();
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            logError($exception, 'Error While Deleting User', 'app/Http/Controllers/UserController.php');
            return redirect()->back()->withInput();
        }
    }
}
