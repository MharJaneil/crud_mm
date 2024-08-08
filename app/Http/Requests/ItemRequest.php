<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemRequest extends FormRequest
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
            'name' => 'string|required|max:255',
            'description' => 'string|max:255',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|integer|min:1',
            'category_id' => 'required|exists:category,_id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price field only accept numbers',
            'price.min' => 'The price field requires a minimum value of 1',
            'quantity.required' => 'The quantity field is required',
            'quantity.integer' => 'The quantity field only accept whole numbers',
            'quantity.min' => 'The quantity field requires a minimum value of 1',
            'category_id.required' => 'The category field is required',
            'category_id.exists' => 'The category field only accept existing category',
        ];
    }
}
