<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'userId', 'title',
    ];
    
    protected $table = 'albums';

    public function user() 
    {
        return $this->belongsTo('App\User', 'userId');
    }

    public function photo()
    {
        return $this->hasMany('App\Photo');
    }
}
