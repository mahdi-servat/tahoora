<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole("admin") || auth()->user()->can('news-management');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'language_id' => 'required',
            'title' => 'required',
            'thumpUrl' => 'required',
            'description' => 'required',
            'content' => 'required',
            'date' => 'required',
        ];
    }
}
