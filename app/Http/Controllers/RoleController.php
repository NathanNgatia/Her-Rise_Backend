<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    public function index(
        Request $request, JsonResponse $response,
        Role $role
    ) {
        // Fetch all roles from the database
        $roles = Role::all();

        $this->authorize('create', Role::class);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role_id' => ['required', 'exists:roles,id'],
        ]);


        // Return the roles to the view
        return view('roles.index', [
            'roles' => $roles,
        ])->with('success', 'Roles fetched successfully.');
    }
}
