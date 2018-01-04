<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'userId', 'postId', 'body',
    ];

    protected $table = 'comments';

    public function user()
    {
        return $this->belongsTo('App\User', 'userId');
    }

    public function post()
    {
        return $this->belongsTo('App\Post', 'postId');
    }
}
