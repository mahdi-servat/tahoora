<?php

namespace App\Models\MetaTag;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelMetaTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'meta_tag_id',
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
}
