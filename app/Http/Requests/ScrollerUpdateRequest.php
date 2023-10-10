<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScrollerUpdateRequest extends FormRequest
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
            'id'=>['required','uuid'],

        ];
    }
    public function messages()
    {
        return [
            'id.required'=>'id required',
            'id.uuid'=>'id must be uuid'
        ];
    }
}
