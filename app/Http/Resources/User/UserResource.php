<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'first_name' => @$this->first_name,
            'last_name' => @$this->last_name,
            'avatar' => !empty($this->avatar) ? env('APP_URL') . '/' . $this->avatar : null,
            'comments' => [],
            'likes' => [],
            'reserved' => [],
            'token'=>$this->token

        ];
    }
}
