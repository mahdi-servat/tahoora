<?php

namespace App\Http\Requests\Media\Web;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMediaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole("admin") || auth()->user()->can('media-management');
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
//            'thump' => 'required',
            'title' => 'required',
            'date' => 'required',
            'status_id' => 'required',
//            'atch_image' => 'array|required',
//            'atch_image.*' => 'required',
        ];
    }
}
