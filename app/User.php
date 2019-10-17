<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function follows()
    {
      return $this->hasMany('App\Follow');
    }

    // $follow_ids配列に自分とフォローしているユーザーを格納し、その中からtweetsテーブルのuser_idカラムに該当するものを取り出し
    // orderByで降順に並べる
    public function getTimeLines(Int $user_id, Array $follow_ids)
    {
      $follow_ids[] = $user_id;
      return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'desc')->paginate(10);
    }

    // ログインしているユーザー以外の全てのうユーザーを10人取得する
    public function getAllUsers(Int $user_id)
    {
        return $this->Where('id', '<>', $user_id)->paginate(10);
    }
}
