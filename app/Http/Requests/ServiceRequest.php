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
class ServiceRequest extends FormRequest
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

            'name_ru'  => 'sometimes|required|string|max:150',
            'price_ru' => 'string',
            'note_ru'  => 'nullable|string|max:150',

            'name_uk'  => 'nullable|string|max:150',
            'price_uk' => 'nullable|string',
            'note_uk'  => 'nullable|string|max:150',

        ];

    }
}
