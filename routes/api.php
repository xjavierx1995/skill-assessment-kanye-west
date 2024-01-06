<?php

use App\Http\Controllers\QuotesController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::middleware('auth:api')->group(function () {

  //user
  Route::put('/update-user/{user}', [RegisterController::class, 'updateUser']);
  Route::put('/block-user/{userId}', [RegisterController::class, 'blockUser'])->middleware('isAdmin');
  Route::put('/unlock-user/{user}', [RegisterController::class, 'unlockUser'])->middleware('isAdmin');

  //Quotes
  Route::get('/quotes', [QuotesController::class, 'getQuotes']);

  // favorites
  Route::get('/my-favorites/{user}', [QuotesController::class, 'myFavorites']);
  Route::post('/add-favorite/{user}', [QuotesController::class, 'addFavorite']);
  Route::delete('/delete-favorite/{favorite}', [QuotesController::class, 'deleteFavorite']);
});
