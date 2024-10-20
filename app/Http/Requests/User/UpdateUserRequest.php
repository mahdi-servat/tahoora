<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole("admin") || auth()->user()->can('user-management');
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
            'password' => 'required' ,
            'confirmed_password' => 'required' ,
        ];
    }
}
