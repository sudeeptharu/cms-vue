<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderStoreRequest extends FormRequest
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
            'order'=>['required'],
            'image'=>['required'],
            'url'=>['required'],
            'is_published'=>['required'],
            'title'=>['required'],
            'description'=>['required'],
        ];
    }
    public function messages()
    {
        return [
            'order.required'=>'order required',
            'image.required'=>'image required',
            'url.required'=>'url required',
            'title.required'=>'title required',
            'description.required'=>'description required'
        ];
    }
}
