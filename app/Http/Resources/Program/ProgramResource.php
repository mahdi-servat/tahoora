<?php

namespace App\Http\Resources\Program;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ,
            'title' => $this->title ,
            'description' => @$this->description ,
            'sort' => @$this->sort ,
            'program_url' => @$this->url ,
            'thump' => env('APP_URL') . '/' .@$this->thump,
        ];
    }
}
