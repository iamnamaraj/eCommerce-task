<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeProductRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required|numeric|gt:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable',
            'attributes' => 'required|array',
            'attributes.*.size_id' => 'required|exists:sizes,id',
            'attributes.*.color_id' => 'required|exists:colors,id',
            'attributes.*.quantity' => 'required|numeric|gt:0',
            'attributes.*.images' => 'required|array',
            'attributes.*.images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
