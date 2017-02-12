<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternalComment extends Model
{
    public $fillable = [
        'title', 'content', 'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
