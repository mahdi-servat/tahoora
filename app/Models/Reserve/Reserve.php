<?php

namespace App\Models\Reserve;

use App\Models\Artist\Artist;
use App\Models\Museum\Museum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'artist_id',
        'museum_id',
        'price',
        'date',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function artist()
    {
        return $this->hasOne(Artist::class, 'id', 'artist_id');
    }

    public function museum()
    {
        return $this->hasOne(Museum::class, 'id', 'museum_id');
    }
}
