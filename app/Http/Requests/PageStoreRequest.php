<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageStoreRequest extends FormRequest
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
            'subtitle'=>['required'],
            'excerpt'=>['required'],
            'description'=>['required'],
            'quote'=>['required'],
            'image'=>['required'],
            'draft'=>['required'],
            'slug'=>['required']
        ];
    }
    public function messages()
    {
        return[
            'title.required'=>'title required',
            'subtitle.required'=>'subtitle required',
            'excerpt.required'=>'excerpt required',
            'description.required'=>'description required',
            'quote.required'=>'quote required',
            'image.required'=>'image required',
            'draft.required'=>'draft required',
        ];
    }
}
