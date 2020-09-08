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
    protected $table = 'tags';

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['id', 'name', 'icon'];

    /**
     * Get the Podcast
     */
    public function podcasts()
    {
        return $this->belongsToMany(Podcast::class);
    }
}
