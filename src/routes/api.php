<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SNSLoginController;

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

Route::post('/login', LoginController::class);
Route::get('/login/git-hub', [SNSLoginController::class, 'getGitHubRedirectUrl']);
Route::post('/login/git-hub', [SNSLoginController::class, 'gitHub']);

Route::post('/register', RegisterController::class);