<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'body', 'map',
    ];

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function likes()
    {
      return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    public function isLikedBy(?User $user)
    {
      return $user
        ? (bool)$this->likes->where('id', $user->id)->count()
        : false;
    }

    public function getCountLikesAttribute()
    {
      return $this->likes->count();
    }

    public function tags()
    {
      return $this->belongsToMany('App\Tag')->withTimeStamps();
    }
}
