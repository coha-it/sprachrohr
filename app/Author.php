<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Many to Many Relation to Tags
     */
    public function podcasts()
    {
        return $this->hasMany(Podcast::class);
    }

}
