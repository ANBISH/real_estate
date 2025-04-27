<?php

namespace App\Http\Requests\Property;

use Illuminate\Foundation\Http\FormRequest;

class PropertyUpdateRequest extends FormRequest
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
            'property_type_id' => 'sometimes|exists:property_types,id',
            'price' => 'sometimes|numeric',
            'currency_id' => 'sometimes|exists:currencies,id',
            'address' => 'sometimes|string|max:255',
            'latitude' => 'sometimes|numeric',
            'longitude' => 'sometimes|numeric',
            'size' => 'sometimes|numeric',
            'measurement' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            // 'status_id' => 'sometimes|exists:statuses,id',
        ];
    }
}
