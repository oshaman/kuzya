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
class StockRequest extends FormRequest
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
            'content_ru' => 'sometimes|required|string',
            'image'      => 'required|string|max:190',
            'date_in'    => 'nullable|date',

            'approved' => 'boolean|nullable',
            'priority' => 'nullable|numeric|between:1,100',

            'name_uk' => 'nullable|string|max:150',
            'content_uk' => 'nullable|string',
        ];

    }
}
