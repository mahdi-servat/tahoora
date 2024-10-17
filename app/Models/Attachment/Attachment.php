<?php

namespace App\Models\Attachment;

use App\Scopes\SortScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title2',
        'path',
        'mime_type',
        'attachment_type_id',
        'description',
        'sort',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function type()
    {
        return $this->hasOne(AttachmentType::class , 'id' , 'attachment_type_id');
    }

    protected static function booted()
    {
        static::addGlobalScope(new SortScope);
    }

}
