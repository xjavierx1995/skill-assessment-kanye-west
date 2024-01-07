<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;

class RegisterController extends BaseController
{
  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'required|email',
      'password' => 'required',
      'c_password' => 'required|same:password',
    ]);

    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    $success['token'] =  $user->createToken('authToken')->accessToken;
    $success['user'] =  $user;

    return $this->sendResponse($success, 'User register successfully.');
  }

  public function login(Request $request)
  {
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
      $user = Auth::user();

      if (!$user->canLogin) {
        return $this->sendError('This user is blocked', ['error' => 'Blocked']);
      }
      /** @var \App\Models\User $user **/
      $success['token'] =  $user->createToken('authToken')->accessToken;
      $success['user'] =  $user;
      return $this->sendResponse($success, 'User login successfully.');
    } else {
      return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    }
  }

  public function updateUser(Request $request, User $user)
  {
    $request->validate([
      'name' => 'required',
    ]);
    $user->update($request->all());

    return $this->sendResponse($user, 'User updated successfully.');
  }

  public function blockUser($userId)
  {
    $user = User::find($userId);
    if (!$user) {
      return $this->sendError('User not found', ['error' => 'not found']);
    }
    $user->canLogin = false;
    $user->save();
    return $this->sendResponse($user, 'User blocked successfully.');
  }

  public function unlockUser($userId)
  {
    $user = User::find($userId);

    if (!$user) {
      return $this->sendError('User not found', ['error' => 'not found']);
    }
    $user->canLogin = true;
    $user->save();
    return $this->sendResponse($user, 'User unlocked successfully.');
  }

  public function getUsers()
  {
    $users = User::with('favorites')->where('isAdmin', false)->get();
    return $this->sendResponse($users, 'Users list.');
  }
}
