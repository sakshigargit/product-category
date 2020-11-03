<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|min:3|max:255',
            'slug'          => 'required|min:3|max:255|unique:products' . ($this->id ? ',slug,' . $this->id : ''),
            'description'   => 'min:10|max:500',
            'category_id'   => 'required|exists:categories,id',
            'price'         => 'required|between:0,99999999.99',
            'image'         => 'mimes:jpeg,jpg,png,PNG,JPG,JPEG|max:2048' , ($this->id ? '|required' : ''),
            'qty'           => 'required|numeric|min:1',
            'is_active'     => 'required|boolean'
        ];
    }
}
