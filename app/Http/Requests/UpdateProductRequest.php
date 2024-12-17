<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug' . $this->product->id,
            'images' => 'nullable|array', // Allow multiple images
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Each image validation
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The product name is required.',
            'name.max' => 'The product name must not exceed 255 characters.',
            'slug.required' => 'The product slug is required.',
            'slug.unique' => 'The product slug must be unique.',
            'slug.max' => 'The product slug must not exceed 255 characters.',
            'images.array' => 'The images field must be an array.',
            'images.*.image' => 'Each file must be a valid image.',
            'images.*.mimes' => 'Images must be in jpeg, png, jpg, or gif format.',
            'images.*.max' => 'Each image must not exceed 2MB.',
            'description.max' => 'The description must not exceed 1000 characters.',
            'price.required' => 'The product price is required.',
            'price.numeric' => 'The product price must be a valid number.',
            'price.min' => 'The product price must be at least 0.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'The selected category is invalid.',
        ];
    }
}
