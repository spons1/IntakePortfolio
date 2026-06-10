<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumReview extends Model
{
    protected $table = 'album_reviews'; 

    protected $fillable = [
        'user_id',
        'album_id',
        'title',
        'message',
        'stars',  
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
