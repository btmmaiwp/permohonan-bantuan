<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::with('applications')->get();

        return UserResource::collection($users);
    }

    public function show(Request $request, User $user)
    {
        $user->load('applications');
        return new UserResource($user);
    }

    public function store(Request $request)
    {
        // validate inputs
        $validatedData = $request->validate([
            'name' => ['required', 'min:5'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed']
        ]);

        // store data into database
        $user = User::create($validatedData);

        // return response
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:5'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['confirmed']
        ]);

        $user->fill($validatedData);
        $user->save();

        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();

        return 'User has been deleted';
    }
}
