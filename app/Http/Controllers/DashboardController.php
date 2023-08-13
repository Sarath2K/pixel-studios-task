<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{

    /**
     * Get the count of users by roles.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $roles = Role::all();

        $roleCounts = [];

        foreach ($roles as $role) {
            $roleCounts[$role->name] = User::role($role->name)->count();
        }

        return view('dashboard', ['roleCounts' => $roleCounts]);
    }
}
