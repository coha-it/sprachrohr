<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'p_tags';

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['id', 'name'];

    /**
     * Get the Podcast
     */
    public function podcast()
    {
        return $this->belongsTo('App\Podcast'); //->pluck('src', 'type');
    }
}