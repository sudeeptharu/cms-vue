<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkStoreRequest extends FormRequest
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
            'social'=>['required'],
            'icon'=>['required'],
            'url'=>['required']
        ];
    }
    public function messages()
    {
        return [
            'social.required'=>'must include social',
            'icon,required'=>'must include icon',
            'url.required'=>'must include url'
        ];
    }
}
