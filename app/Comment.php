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
    protected $visible = ['id', 'public_name', 'proved', 'text', 'seconds', 'created_at', 'user'];
    protected $fillable = ['public_name', 'text', 'seconds', 'user_id'];
    protected $appends = ['user'];

    /**
     * Get the Podcast
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserAttribute()
    {
        $user = $this->user()->get()->first();

        if ($this->public_name) {
            return $user;
        }
        return $user->makeHidden(['id', 'name', 'photo_url']);
    }

}
