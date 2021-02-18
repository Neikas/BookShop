<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'genre' => 'required|max:255',
            'description' => 'required|max:2000',
            'price' => 'required|numeric',
            'picutre' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'discount' => 'max:100|numeric|min:0'
        ];
    }
}
