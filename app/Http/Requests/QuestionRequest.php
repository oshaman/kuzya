<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'category_id' => 'required|numeric|between:1,100000',

            'question_ru' => 'nullable|string|max:150',
            'answer_ru' => 'nullable|string|max:2000',

            'question_uk' => 'nullable|string|max:150',
            'answer_uk' => 'nullable|string|max:2000',
        ];
    }
}
