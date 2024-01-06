<?php

use App\Http\Controllers\QuotesController;
use App\Http\Controllers\RegisterController;
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
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::middleware('auth:api')->group(function () {
  Route::put('/update-user/{user}', [RegisterController::class, 'updateUser']);
  Route::get('/quotes', [QuotesController::class, 'getQuotes']);
  Route::post('/add-favorite/{user}', [QuotesController::class, 'addFavorite']);
  Route::delete('/delete-favorite/{favorite}', [QuotesController::class, 'deleteFavorite']);
});
