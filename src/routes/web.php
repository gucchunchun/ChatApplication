<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SNSLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('/login', LoginController::class);
Route::get('/login/github', [SNSLoginController::class, 'getGithubRedirectUrl']);
Route::post('/login/github', [SNSLoginController::class, 'github']);
