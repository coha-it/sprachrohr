<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'p_sources';

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
