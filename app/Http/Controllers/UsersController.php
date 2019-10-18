<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 現在認証されているユーザー(自分)を取得するときにAuth::user();を使うためにAuthをuseする。
use Illuminate\Support\Facades\Auth;

use App\Follow;
use App\Tweet;
use App\User;

class UsersController extends Controller
{
    // Userモデルにログイン済みのユーザー(自分)以外の全てのユーザーを取得するgetAllUsersメソッドを作成し、
    // その関数をUsersControllerで呼び出すときに引数として認証ユーザーを設定してあげる。
    // そしてgetAllUsersメソッドで取得した値を$all_users変数に格納してあげて、viewに渡す。

    // ユーザー一覧を取得
    public function index(User $user)
    {
      $all_users = $user->getAllUsers(Auth::id());

      return view('user.index', [
        'all_users' => $all_users
      ]);
    }

    // フォローする関数
    // フォローしているかを判断し、フォローしていなければフォローする。
    public function follow(User $user)
    {
      $follower = Auth::users();

      $is_following = $follower->isFollowing($user->id);
      // $is_followingに該当する値がなかったら
      if(!$is_following) {
        $follower->follow($user->id);

        return back();
      }
    }

    // フォロー解除する
    public function unfollow(User $user)
    {
      $follower = Auth::users();

      $is_following = $follower->isFollowing($user->id);

      // $is_followingに該当する値があったら
      if($is_following) {
        $follower->unfollow($user->id);

        return back();
      }
    }
}
