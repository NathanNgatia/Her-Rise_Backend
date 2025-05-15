<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function getUser(Request $request): JsonResponse
    {
        $this->authorize('viewAny', User::class);
        $user = User::find();
        echo $user->role->name; // This will output the name of the role associated with the user
        return response()->json($request->user());
    }

    public function store(Request $request): JsonResponse
    {
        $this->authorize('create', User::class);
        $this->authorize('create', Role::class);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role_id' => ['required', 'exists:roles,id'],
        ]);


        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        return response()->json($user->load('role'), 201);

        return $request->all();

    }

    public function show(User $user): JsonResponse
    {
        $this->authorize('view', $user);
        return response()->json($user->load('role'));
    }

    public function update(Request $request, User $user): JsonResponse
    {
        $this->authorize('update', $user,);
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['sometimes', 'string', 'min:8'],
            'user_photo' => ['nullable|image|MAX:2048'],
            'role_id' => ['sometimes', 'exists:roles,id'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        if ($request->hasFile('user_photo')) {
            $path = $request->file('user_photo')->store('profile_photos', 'public');
            $user->user_photo = $path;
        }

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }
        $user->update($validated);
        return response()->json($user->load('role'));
    }

    public function destroy(User $user): JsonResponse
    {
        $this->authorize('delete', $user);
        $user->delete();
        return response()->json(null, 204);
    }
}
