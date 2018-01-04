<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'userId', 'title', 'completed',
    ];

    protected $table = 'todos';

    public function user()
    {
        return $this->belongsTo('App\User', 'userId');
    }
}
