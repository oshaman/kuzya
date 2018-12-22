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
class AdvantageRequest extends FormRequest
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
            'name_ru'    => 'sometimes|required|string|max:150',
            'name_uk'    => 'nullable|string|max:150',

            'image'      => 'nullable|string|max:190',
            'image_dark' => 'nullable|string|max:190',
        ];

    }
}
