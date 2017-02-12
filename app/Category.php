<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable = [
        'title', 'description', 'image'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
