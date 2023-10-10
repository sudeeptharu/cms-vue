<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuUpdateRequest extends FormRequest
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
            'title'=>['required'],
            'order'=>['required'],
            'url'=>['required'],
            'is_published'=>['required'],
            'opens_in_new_tab'=>['required'],
            'parent_id'=>['required']
        ];
    }
}
