<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QuotesController extends BaseController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function getQuotes(Request $request)
  {

    $amount = is_numeric($request->query('amount')) ? intval($request->query('amount')) : 5;
    $quotes = [];
    // loop adds quotes to array until there are 5 unique values.
    for ($i = 0; $i < $amount; $i++) {
      $response = Http::get('https://api.kanye.rest');
      $newQuote = $response->json()['quote'];
      $isDuplicate = false;
      if ($i != 0) { // first quote always placed into array
        // looping through array to check if quotes are duplicates
        for ($j = 0; $j < count($quotes); $j++) {
          if ($newQuote == $quotes[$j]) {
            $i--; // don't progess in parent for loop
            $isDuplicate = true; // prevents duplicate from being added
          }
        }
      }
      if (!$isDuplicate) {
        $quotes[] = $newQuote;
      }
    }

    return $this->sendResponse($quotes, '');
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
