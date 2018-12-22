<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagesRequest extends FormRequest
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
            'name_ru'    => 'sometimes|required|string|max:190',
            'name_uk'    => 'sometimes|string|max:190',
            'slug'    => 'sometimes|string|max:190',
            'content_ru' => 'nullable|string',
            'content_uk' => 'nullable|string',

            'attr_ru'         => 'nullable|array|min:1',
            'attr_ru.slider'  => 'nullable|array|min:1',
            'attr_ru.slider.*.priority'  => 'nullable|numeric|between:1,100',
            'attr_ru.slider.*.active'  => 'nullable|boolean',
            'attr_ru.slider.*.image'  => 'nullable|string|max:256',
            'attr_ru.slider.*.title'  => 'nullable|string|max:256',
            'attr_ru.slider.*.address'  => 'nullable|string|max:256',

            'attr_uk'         => 'nullable|array|min:1',
            'attr_uk.slider'  => 'nullable|array|min:1',
            'attr_uk.slider.*.priority'  => 'nullable|numeric|between:1,100',
            'attr_uk.slider.*.active'  => 'nullable|boolean',
            'attr_uk.slider.*.image'  => 'nullable|string|max:256',
            'attr_uk.slider.*.title'  => 'nullable|string|max:256',
            'attr_uk.slider.*.address'  => 'nullable|string|max:256',
        ];
    }
}
