<?php

namespace App\Http\Requests\Page\Web;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'language_id' => 'required',
            'title' => 'required',
            'url' => 'required',
            'status_id' => 'required',
            'content' => 'required',
        ];
    }
}
