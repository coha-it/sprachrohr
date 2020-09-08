<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Podcast extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $appends = ['comment_count'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Get the Authors
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    /**
     * Get the Comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get proved comments
     */
    public function provedComments()
    {
        return $this->comments()->where('proved', true);
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


    /**
     * Get Comment-Count Attribute
     */
    public function getCommentCountAttribute() {
        return $this->provedComments()->count();
    }
}
