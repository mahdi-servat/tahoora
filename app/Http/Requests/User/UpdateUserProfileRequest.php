<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required' ,
            'last_name' => 'required' ,
            'email' => 'required' ,
            'username' => 'required' ,
            'password' => 'required' ,
            'confirmed_password' => 'required' ,
        ];
    }
}
