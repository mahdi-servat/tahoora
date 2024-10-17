<?php

namespace App\Models\Category;

use App\Scopes\LocalizationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title2',
        'language_id',
        'parent_id',
        'category_type_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function type()
    {
        return $this->hasOne(CategoryType::class, 'id', 'category_type_id');
    }

    public static function booted()
    {
        static::addGlobalScope(new LocalizationScope);
    }
}
