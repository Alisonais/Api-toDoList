<?php

namespace App\Http\Requests;

use Arr;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description' => 'required | string',
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => "A descrição é obrigatória",
            'description.string' => "A descrição deve ser string",
        ];
    }
}
