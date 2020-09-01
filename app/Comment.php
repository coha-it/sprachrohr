<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['id', 'anonym', 'text', 'seconds', 'created_at', 'user'];
    protected $appends = ['user'];

    /**
     * Get the Podcast
     */
    public function user()
    {
        return $this->belongsTo(User::class); //->pluck('src', 'type');
    }

    public function getUserAttribute()
    {
        if ($this->anonym) {
            return null;
        }
        return $this->user()->get()->first();
    }
}
