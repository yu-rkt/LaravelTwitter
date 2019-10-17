<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follows extends Model
{
    // フォローしているユーザーのID($user_id)を引数で渡す
    // following_idカラムの中から$use_idと合致するレコードを取り出し、get()メソッドでfollowed_idカラムのみ取得する

    public function followingIds(Int $user_id)
    {
      return $this->where('following_id', $user_id)->get('followed_id');
    }
}
