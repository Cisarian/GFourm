<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['title', 'slug', 'games_id'];

    public function games()
    {
        return $this->belongsTo(Games::class);
    }

    public function post()
    {
        return $this->hasMany(Post::class, 'categories_id');
    }


}
