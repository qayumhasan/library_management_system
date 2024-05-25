<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowdBookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){

    Route::get('/auth/varify',[AuthController::class,'varify']);
    Route::apiResource('authors',AuthorController::class);
    Route::apiResource('books',BookController::class);
    Route::apiResource('members',MemberController::class);
    Route::apiResource('borrowd-book',BorrowdBookController::class);
    Route::apiResource('permissions',PermissionController::class);
    Route::apiResource('roles',RoleController::class);
    Route::apiResource('users',UserController::class);
    Route::post('/logout',[AuthController::class,'logout']);

});
