<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|min:3|max:50|unique:categories' . ($this->id ? ',name,' . $this->id : ''),
            'slug' => 'required|min:3|max:50|unique:categories' . ($this->id ? ',slug,' . $this->id : ''),
        ];
    }
}
