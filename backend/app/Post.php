<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{

  

    protected $perPage = 5;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites_users()
    {
        return $this->belongsToMany(User::class, 'favorites', 'post_id', 'user_id')->withTimestamps();
    }

   
    
}
