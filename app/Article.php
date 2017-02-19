<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $fillable = [
        'title', 'description', 'image', 'active', 'category_ref', 'grade_ref', 'institution_ref'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentaries()
    {
        return $this->hasMany(Commentary::class);
    }
}
