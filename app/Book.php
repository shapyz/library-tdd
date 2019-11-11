<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * Fillables
     */
    protected $fillable = [
            'title',
            'author'
    ];
}
