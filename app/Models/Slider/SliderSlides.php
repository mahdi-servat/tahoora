<?php

namespace App\Models\Slider;

use Illuminate\Database\Eloquent\Model;

class SliderSlides extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'slider_id',
        'attachment_id',
        'sort',
        'title',
        'sub_title',
        'button_text',
        'button_url',
        'description',
    ];
}
