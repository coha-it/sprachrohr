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
     * Get the Author
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the Comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the Sources
     */
    public function sources()
    {
        return $this->hasMany(Source::class)->orderBy('prio');
    }

    /**
     * Get the Audios
     */
    public function audios()
    {
        return $this->sources();
    }

    /**
     * Many to Many Relation to Tags
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getTypeAttribute() {
        return 'audio';
    }
}
