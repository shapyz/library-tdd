<?php

namespace App;

use App\Author;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * Guarded
     */
    protected $guarded = [];

    /**
     * 
     */
    public function path()
    {
        return ('/books/'.$this->id);
    }

    public function checkout($user)
    {
        $this->reservations()->create([
            'user_id'   =>  $user->id,
            'checked_out_at'  =>  now()
        ]);
    }

    function checkin($user)
    {
        $reservation = $this->reservations()->where('user_id',$user->id)
            ->whereNotNull('checked_out_at')
            ->whereNull('checked_in_at')
            ->first();

        throw_if(is_null($reservation),new \Exception());

        $reservation->update([
            'checked_in_at' =>  now()
        ]);

    }


    function setAuthorIdAttribute($author)
    {
        $this->attributes['author_id'] = (Author::firstOrCreate([
            'name' =>  $author,
        ]))->id;
    }

    function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
