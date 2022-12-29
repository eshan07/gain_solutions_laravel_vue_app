<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->method() == 'POST'){
            return [
                'category_id' => ['required','integer','exists:categories,id'],
                'name' => ['required', 'string', 'min:5', "max:150", "unique:products,name"
                ],
                'bn_name' => ['nullable', 'string', "min:5", "max:150", "unique:products,bn_name"],
                'feature_image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', "max:2048"],
                'current_stock' => ['required', 'integer'],
                'description' => ['required', 'string', "max:2000"],
                'specification' => ['nullable', 'string', "max:2000"],
                'delivery_info' => ['nullable', 'string',"max:2000"],
                'faqs' => ['nullable', 'string', "max:2000"],
                'short_note' => ['required', 'string', "max:1000"],
                'images' => ['required'],
                'images.*' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', "max:1024"],
                'slug' => ['string', 'unique:products,slug'],
                'unit' => ['required', 'string'],
                'price' => ['required','numeric','between:0,9999999999.99'],
            ];
        }else{
            return [
                'category_id' => ['required','integer','exists:categories,id'],
                'name' => ['required', 'string', 'min:5', "max:150", "unique:products,name,". ($this->name) . ',name'],
                'slug' => 'required|max:50|min:3|regex:/^[a-z][a-z0-9_-]/|unique:products,slug,' . ($this->slug) . ',slug',
                'bn_name' => ['nullable', 'string', "min:5", "max:150", "unique:products,bn_name"],
                'short_note' => ['required', 'string', "max:1000"],
                'description' => ['required', 'string', "max:2000"],
                'specification' => ['nullable', 'string', "max:2000"],
                'delivery_info' => ['nullable', 'string',"max:2000"],
                'feature_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', "max:2048"],
                'images' => ['nullable'],
                'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', "max:1024"],
            ];
        }
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name' => ucwords(strtolower(utf8_encode($this->name))),
            'slug' => Str::slug($this->name),
        ]);
    }
}
