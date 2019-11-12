<?php

namespace App;

use App\Author;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * Fillables
     */
    protected $guarded = [];

    /**
     * 
     */
    public function path()
    {
        return ('/books/'.$this->id);
    }

    function setAuthorIdAttribute($author)
    {
        $this->attributes['author_id'] = (Author::firstOrCreate([
            'name' =>  $author,
        ]))->id;
    }
}
