<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{

    protected $table = 'artist';

    protected $fillable = [
        'name',
        'starting_year',
        'description',
        'image_path',
    ];

    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
