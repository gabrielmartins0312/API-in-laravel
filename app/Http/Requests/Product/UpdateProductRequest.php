<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'quantity'    => 'sometimes|required|integer|min:0',
            'price'       => 'sometimes|required|numeric|min:0',
        ];
    }
}

