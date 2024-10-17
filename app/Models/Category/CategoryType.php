<?php

namespace App\Models\Category;

use App\Scopes\LocalizationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    use HasFactory;

    protected $table = 'category_types';
    protected $fillable = [
        'title',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
