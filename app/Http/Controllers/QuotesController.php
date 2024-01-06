<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
class QuotesController extends BaseController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function getQuotes(Request $request)
  {

    $user = Auth::user();

    $executed = RateLimiter::attempt('send-message:'.$user->id, 30, function() {});

    if (!$executed) {
      return $this->sendError('You may try again in 60 seconds.', ['error' => 'Too Many Attempts.'], 429);
    }

    $amount = is_numeric($request->query('amount')) ? intval($request->query('amount')) : 5;
    $quotes = [];

    for ($i = 0; $i < $amount; $i++) {
      $response = Http::get('https://api.kanye.rest');
      $newQuote = $response->json()['quote'];
      $isDuplicate = false;
      if ($i != 0) {
        for ($j = 0; $j < count($quotes); $j++) {
          if ($newQuote == $quotes[$j]) {
            $i--;
            $isDuplicate = true;
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
