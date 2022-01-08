<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/registration', [RegistrationController::class, 'registration']);


Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::get('/info', [HomeController::class, 'home']);
    Route::put('/update-user-info', [UserController::class, 'updateUserInfo']);
    Route::get('/user-tokens', [UserController::class, 'getUserTokens']);
    Route::delete('/logout', [LoginController::class, 'logout']);

});
