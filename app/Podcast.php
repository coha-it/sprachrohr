<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Podcast extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    // protected $appends = ['type'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Get the Sources
     */
    public function sources()
    {
        return $this->hasMany('App\Source')->orderBy('prio');
    }

    /**
     * Get the Sources
     */
    public function audios()
    {
        return $this->sources();
    }

    public function getTypeAttribute() {
        return 'audio';
    }
}
