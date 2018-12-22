<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'name_ru'   => 'sometimes|required|string|max:150',
            'name_uk'   => 'nullable|max:150',
            'static_id' => 'nullable|exists:static_pages,id',
            'parent_id' => 'nullable|exists:menus,id',
            'approved' => 'boolean|nullable',
            'priority' => 'nullable|numeric|between:1,100'
        ];
    }
}
