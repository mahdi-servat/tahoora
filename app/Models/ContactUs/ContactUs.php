<?php

namespace App\Models\ContactUs;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ContactUs extends Model
{
    use HasFactory;

    protected $table = 'contact_uses';
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'category',
        'description',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
