<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}