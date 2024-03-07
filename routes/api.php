<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\ListActiveUsersController;
use App\Http\Controllers\SchemesController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\AdminRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])
    ->get('/user', function (Request $request) {
        return $request->user();
    });

Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    // auth
    Route::post('logout', [AuthController::class, 'logout']);


    Route::middleware('admin.route')->group(function () {
        // users
        Route::apiResource('users', UsersController::class);
    });

    // schemes
    Route::apiResource('schemes', SchemesController::class);
    Route::delete('schemes/{scheme}/delete', [SchemesController::class, 'forceDelete']);

    // applications
    Route::apiResource('applications', ApplicationsController::class);
    Route::delete('applications/{application}/delete', [ApplicationsController::class, 'forceDelete']);
    Route::get('active-users', ListActiveUsersController::class);
});
