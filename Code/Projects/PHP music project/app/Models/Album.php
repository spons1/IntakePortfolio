<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'album';

    protected $fillable = [
        'titel',
        'release_datum',
        'genre',
        'artist_id',
        'user_id',
        'cover_path'
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(AlbumReview::class, 'album_id');
    }
}


