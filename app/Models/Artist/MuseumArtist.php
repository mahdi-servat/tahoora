<?php

namespace App\Models\Artist;

use App\Models\Museum\Museum;
use Illuminate\Database\Eloquent\Model;

class MuseumArtist extends Model
{
    public $timestamps = false;
    protected $table = 'museum_doctors';
    protected $fillable = [
        'museum_id',
        'artist_id',
    ];

    public function museum()
    {
        return $this->hasOne(Museum::class, 'id', 'museum_id');
    }

    public function artist()
    {
        return $this->hasOne(Artist::class, 'id', 'artist_id');
    }
}
