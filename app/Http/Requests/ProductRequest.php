<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'price' => 'required|regex:/[0-9]/|min:3|max:10',
            'image' => 'required|mimes:jpeg,png,jpg,jfif',
            'category-names' => 'required',
            'description' => 'required',
        ];
    }
}