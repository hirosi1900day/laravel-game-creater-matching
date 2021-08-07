<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','email_verified', 'email_verify_token',
    ];

     /** JSONに含める属性 */
    protected $appends = [
        'url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','email','email_verified_at','payment'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //ここからはリレーション関連
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function recruits()
    {
        return $this->hasMany(Recruit::class);
    }

    //お気に入り投稿一覧を取得
    public function favorites()
    {
        return $this->belongsToMany(Post::class, 'favorites', 'user_id', 'post_id')->withTimestamps();
    }

    //お気に入り登録されているかを確認する
    public function is_favorite($postId){
        return $this->favorites()->where('post_id',$postId)->exists();
    }

    //お気に入り登録する
    public function favorite($postId){
        // すでにお気に入りしているかの確認
        $exist = $this->is_favorite($postId);
        if ($exist) {
            // すでにお気に入りしていれば何もしない
            return false;
        } else {
            $this->favorites()->attach($postId);
            return true;
        }
    }
    public function unfavorite($postId){
        $exist = $this->is_favorite($postId);
        if ($exist) {
            $this->favorites()->detach($postId);
            return true;
        } else {
            return false;
        }
    }

     /**
     * アクセサ - image_location
     * @return string
     */
    public function getUrlAttribute()
    {
        if(!$this->image_location){
            return "" ;
        }
        return Storage::disk('s3')->url($this->image_location);
    }
}

