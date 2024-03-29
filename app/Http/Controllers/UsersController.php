<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {
        $users = User::with('applications')->get();
        return UserResource::collection($users);
    }

    public function show(Request $request, User $user)
    {
        $user->load('applications');
        return UserResource::make($user);
    }

    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());
        return response()->json([
            'message' => 'Data stored.',
            'success' => true
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return response()->json([
            'message' => 'Data updated.',
            'success' => true
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return 'User has been deleted';
    }
}
