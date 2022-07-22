<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//User
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::delete('logout', [UserController::class, 'logout']);

Route::get('cars', [CarController::class, 'index']);
Route::get('search', [CarController::class, 'search']);

Route::post('store', [CarController::class, 'store']);
Route::delete('destroy/{car_id}', [CarController::class, 'destroy']);
Route::get('update/{car_id}', [CarController::class, 'update']);
Route::post('update/car/{car_id}', [CarController::class, 'postUpdate']);
Route::get('about/{car_id}', [CarController::class, 'about']);

//Profile
Route::get('profile/{user_id}', [ProfileController::class, 'index']);

//Dashboard
Route::get('dashboard', [DashboardController::class, 'index']);
