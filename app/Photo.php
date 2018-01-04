<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'albumId', 'title', 'url', 'thumbnailUrl',
    ];

    protected $table = 'photos';

    public function album() 
    {
        return $this->belongsTo('App\Album', 'albumId');
    }
}
