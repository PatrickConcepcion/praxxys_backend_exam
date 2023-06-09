<?php

namespace App\Http\Requests\Validation;

use Illuminate\Foundation\Http\FormRequest;

class SecondValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'images' => ['required'],
            'images.*' => ['mimes:jpg,png,jpeg'],
        ];
    }

    public function messages(): array
    {
        return [
            'mimes' => 'The image field only accepts jpg, png and jpeg'
        ];
    }
}
