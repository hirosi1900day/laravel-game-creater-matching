<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{

   /** JSONに含める属性 */
    protected $appends = [
        'url',
    ];

    protected $perPage = 8;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites_users()
    {
        return $this->belongsToMany(User::class, 'favorites', 'post_id', 'user_id')->withTimestamps();
    }

    public function getUrlAttribute()
    {
        if(!$this->image){
            return "" ;
        }
        return Storage::disk('s3')->url($this->image);
    }
   
    
}
