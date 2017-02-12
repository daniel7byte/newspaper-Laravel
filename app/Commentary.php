<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentary extends Model
{
    public $fillable = [
        'content'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
