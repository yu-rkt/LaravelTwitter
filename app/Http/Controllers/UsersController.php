<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Follow;
use App\Tweet;
use Appzz\User;

class UsersController extends Controller
{
    public function index(User $user)
    {
      $my_user = $user->getAllUsers(auth()->user()->id);

      return view('list', [
        'my_user' => $my_user
      ]);
    }
}
