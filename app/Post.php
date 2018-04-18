<?php

namespace noname;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //table name
    protected $table = 'posts';
    //primary key
    public $primaryKey = 'id';
    //timestamps
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('noname\User');
    }

    public function comments()
    {
        return $this->hasMany('noname\Comment');
    }

    public function get_url()
    {
        return '/storage/post_images/' . $this->post_image;
    }

    public function is_default_image() 
    {
        return ($this->post_image == 'default.png');
    }
}
