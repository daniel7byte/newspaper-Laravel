<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $fillable = [
        'title', 'description', 'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function commentaries()
    {
        return $this->hasMany(Commentary::class);
    }
}
