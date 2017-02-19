<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    public $fillable = [
        'title', 'description', 'image'
    ];
}
