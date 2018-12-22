<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


/**
 * Class TariffRequest
 *
 * validator model Tariff
 *
 * @package App\Http\Requests
 */
class TariffRequest extends FormRequest
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
            'approved' => 'nullable|boolean',
            'priority' => 'nullable|numeric|between:1,100',

            'name_ru'              => 'sometimes|required|string|max:150',
            'apartment_ru'         => 'string|max:190',
            'house_ru'             => 'string|max:190',
            'attr_ru.desc'         => 'required|array|min:1',
            'attr_ru.desc.*.name'  => 'required|string|min:1|max:150',
            'attr_ru.desc.*.value' => 'nullable|string|max:150',
            'attr_ru.desc.*.priority' => 'nullable|numeric|max:100',
            'image'                => 'required|string|max:190',
            'price_ru'             => 'between:0,1000',
            'village_price_ru'     => 'between:0,1000',

            'house_uk'             => 'nullable|string|max:190',
            'attr_uk.desc'         => 'nullable|array|min:1',
            'attr_uk.desc.*.name'  => 'nullable|string|min:1|max:150',
            'attr_uk.desc.*.value' => 'nullable|string|max:150',
            'name_uk'              => 'nullable|string|max:150',
            'apartment_uk'         => 'nullable|string|max:190',
            'price_uk'             => 'nullable|between:0,1000',
            'village_price_uk'     => 'nullable|between:0,1000',

        ];

    }
}
