<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::select(['name', 'email'])
            ->where('email', 'like', '%example.com')
            ->whereNotNull('name')
            ->whereBetween('created_at', ['2024-01-01', '2024-12-31'])
            ->whereIn('name', ['Pemohon', 'Staff'])
            ->get();

        return response()->json($users);
    }

    public function show(Request $request, User $user)
    {
        $user->load('applications');
        return response()->json($user);
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
            'name' => ['min:5'],
            'email' => ['email', Rule::unique('users')->ignore($user->id)],
            'password' => ['confirmed']
        ]);

        $user->fill($validatedData);
        $user->save();

        return $user;
    }
}
