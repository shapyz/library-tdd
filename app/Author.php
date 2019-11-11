<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    /** @var mixed $dates. */
    protected $dates = [
        'dob'
    ];

    /** 
     * @var array $guarded 
     */
    protected $guarded = [];

    function setDobAttribute($dob)
    {
        $this->attributes['dob'] = Carbon::parse($dob);
    }
}
