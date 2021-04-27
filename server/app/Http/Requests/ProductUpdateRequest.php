<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductUpdateRequest
 * @package App\Http\Requests
 */
class ProductUpdateRequest extends FormRequest
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
            'name' => 'required|min:5',
            'description' => 'min:10',
            'price' => 'min:1|integer',
            'weight' => 'integer',
            'color' => 'string'
        ];
    }


    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',
            'min' => ':attribute должен быть минимум :size.',
            'exists' => 'Указанное значение :attribute не существует',
        ];
    }

    /**
     * @return string[]
     */
    public function attributes()
    {
        return [
            'name' => 'Название товара',
            'description' => 'Описание',
            'weight' => 'Вес',
            'color' => 'Цвет'
        ];
    }
}
