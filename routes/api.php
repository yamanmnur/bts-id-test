<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Shopping\ShoppingController;
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
Route::group([
  'prefix' => 'users'
], function($router) {
  Route::post('/signup', [AuthController::class, 'signup']);
  Route::post('/signin', [AuthController::class, 'signin']);
  Route::get('/', [AuthController::class, 'index']);
});

Route::resource('shopping',ShoppingController::class);