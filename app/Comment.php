<?php

namespace noname;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post()
    {
        return $this->belongsTo('noname\Post');
    }

    public function user()
    {
        return $this->belongsTo('noname\User');
    }
}
