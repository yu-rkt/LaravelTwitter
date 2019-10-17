<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Tweet;
use App\Follow;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Tweet $tweet, Follow $follow)
    {
      // 認証済みのユーザーを取得する
      $user = auth()->user();

      // 関数を呼び出し$follow_ids配列に格納
      // followed_idのみを取り出し、関数に格納
      $follow_ids = $follow->followingIds($user->id);
      $following_ids = $follow_ids->pluck('followed_id')->toArray();


      $timelines = $user->getTimeLines($user->id, $following_ids);

      return view('home', [
        'user' => $user,
        'timelines' => $timelines
      ]);
    }
}
