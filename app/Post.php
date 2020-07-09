<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'body', 'categories_id', 'user_id'];

    public function category(){
        return $this -> belongsTo(Category::class);
    }

    public function comment()
    {
        return $this -> hasMany(Comment::class, 'posts_id');
    }

    public function user()
    {
        return $this -> belongsTo(User::class);
    }
}
