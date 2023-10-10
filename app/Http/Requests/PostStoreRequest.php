<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'title'=>'required',
            'subtitle'=>'required',
            'excerpt'=>'required',
            'description'=>'required',
            'draft'=>'required',
            'quote'=>'required',
            'image'=>'required'
        ];
    }
    public function messages()
    {
        return[
            'title.required'=>'enter title',
            'subtitle.required'=>'enter subtitle',
            'excerpt.required'=>'enter excerpt',
            'description.required'=>'enter description',
            'draft.required'=>'enter draft',
            'quote.required'=>'enter quote',
            'image.required'=>'select image'
        ];

    }
}
