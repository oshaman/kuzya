<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechnicalRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title_ru' => 'sometimes|required|string|max:150',
            'content_ru' => 'sometimes|required|string',
            'image' => 'required|string|max:190',
            'background' => 'required|string|max:190',
            'active' => 'nullable|boolean',

            'title_uk'    => 'nullable|string|max:150',
            'content_uk' => 'nullable|string',
        ];
    }
}
