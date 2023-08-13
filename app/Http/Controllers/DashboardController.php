<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{

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
