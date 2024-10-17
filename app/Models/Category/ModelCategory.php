<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'model_type',
        'model_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function category()
    {
        return $this->hasOne(Category::class , 'id' , 'category_id');
    }
}
