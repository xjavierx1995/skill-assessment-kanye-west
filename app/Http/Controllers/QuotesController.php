<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;

class QuotesController extends BaseController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function getQuotes()
  {
    return $this->sendResponse([], 'hola mundo');
  }

  public function addFavorite(User $user, Request $request)
  {
    $request->validate([
      'quote' => 'required'
    ]);

    $newFavorite = new Favorite();

    $newFavorite->quote = $request->quote;
    $newFavorite->userId = $user->id;

    $newFavorite->save();

    return $this->sendResponse($newFavorite, 'Quote added to favorites');
  }

  public function deleteFavorite(Favorite $favorite)
  {
    $favorite->delete();
    return $this->sendResponse(null, 'Favorite eliminated');
  }

  public function myFavorites(User $user)
  {
    return $this->sendResponse($user->favorites, 'Favorites found');
  }
}
