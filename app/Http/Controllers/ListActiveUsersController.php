<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListActiveUsersController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $users = User::query()
            ->whereHas('applications', function ($squery) {
                $squery->where(DB::raw('YEAR(created_at)'), now()->year)
                    ->whereHas('scheme', fn ($squery) => $squery->where('status', 'active'));
            })
            ->get();

        $users->load('applications.scheme');

        // // return DB::select('select name, email from users where id = 1');

        // return User::query()
        //     ->select('users.name', 'users.email', 'schemes.name AS scheme_name')
        //     ->leftJoin('applications', 'applications.user_id', '=', 'users.id')
        //     ->leftJoin('schemes', 'schemes.id', '=', 'applications.scheme_id')
        //     ->get();

        return $users;
    }
}
