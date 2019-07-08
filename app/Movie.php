<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $guarded = ['id'];

    const STORE_RULES = [
        'title' => 'required | string',
        'director' => 'required | string',
        'duration' => 'required|integer|between:1,500',
        'releaseDate' => 'required | date',
        'imageUrl' => 'url',
    ];
}
