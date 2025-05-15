<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    public function index() {
        // Fetch all roles from the database
        $roles = Role::all();

        return response()->json($roles);
    }
}
