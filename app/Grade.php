<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public $fillable = [
        'title', 'description', 'image'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
