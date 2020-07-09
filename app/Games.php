<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    //
    protected $fillable = ['title', 'slug'];

    public function category()
    {
        return $this->hasMany(Category::class);
    }

    
}
