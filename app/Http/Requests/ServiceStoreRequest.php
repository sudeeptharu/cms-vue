<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceStoreRequest extends FormRequest
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
            'title'=>['required'],
            'icon'=>['required'],
            'image'=>['required'],
            'excerpt'=>['required'],
            'description'=>['required']
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'title required',
            'icon.required'=>'icon required',
            'image.required'=>'image required',
            'excerpt.required'=>'excerpt required',
            'description.required'=>'description required'
        ];
    }
}
