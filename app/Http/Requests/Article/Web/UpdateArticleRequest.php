<?php

namespace App\Http\Requests\Article\Web;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'language_id' => 'required',
            'title' => 'required',
            'status_id' => 'required',
            'thump' => 'required',
            'content' => 'required',
        ];
    }
}
