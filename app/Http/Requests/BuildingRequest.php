<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuildingRequest extends FormRequest
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
            'name_ru'         => 'sometimes|required|string|max:190',
            'name_uk'         => 'sometimes|string|max:190',
            'points'          => 'array|min:4',
            'points.0.pointX' => 'required',
            'points.0.pointY' => 'required',
            'points.1.pointX' => 'required',
            'points.1.pointY' => 'required',
            'points.2.pointX' => 'required',
            'points.2.pointY' => 'required',
            'points.3.pointX' => 'required',
            'points.3.pointY' => 'required',
        ];
    }
}
