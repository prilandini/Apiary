<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'userId', 'title', 'body',
    ];

    protected $table = 'posts';

    public function user() 
    {
        return $this->belongsTo('App\User', 'userId');
    }

    public function comment()
    {
        return $this->hasMany()('App\Comment');
    }
}
