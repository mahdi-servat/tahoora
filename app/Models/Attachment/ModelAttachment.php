<?php

namespace App\Models\Attachment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'attachment_id',
        'model_type',
        'model_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function attachment()
    {
        return $this->hasOne(Attachment::class , 'id' , 'attachment_id');
    }

    public function model()
    {
        return $this->morphTo();
    }
}
