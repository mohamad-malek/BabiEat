<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCprofileRequest extends FormRequest
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
            'date_of_birth'=>'sometimes|nullable|date|before:today',
            'gender'=>'required|string',
            'bio'=>'nullable|string',
            'image'=>'required|image|mimes:png,jpg,jpeg|max:2048'

        ];
    }
}
