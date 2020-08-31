<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['src', 'type', 'id', 'prio'];

    /**
     * Get the Podcast
     */
    public function podcast()
    {
        return $this->belongsTo('App\Podcast'); //->pluck('src', 'type');
    }
}
