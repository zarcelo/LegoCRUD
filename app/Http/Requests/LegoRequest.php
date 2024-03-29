<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LegoRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'url' => 'required',
            'type' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo name es obligatorio',
            'description.required' => 'El campo description es obligatorio',
            'url.required' => 'El campo url es obligatorio',
            'type.required' => 'El campo type es obligatorio'
        ];
    }
}
