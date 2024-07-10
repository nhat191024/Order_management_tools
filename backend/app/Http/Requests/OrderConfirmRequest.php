<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderConfirmRequest extends FormRequest
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
                'table_id' => 'required|string|exists:tables,id',
                'branch_id' => 'required|integer|exists:branches,id',
                'dishes' => 'required|array',
                'dishes.*.dish_id' => 'required|integer|exists:dishes,id',
                'dishes.*.price' => 'required|integer|min:0',
                'dishes.*.quantity' => 'required|integer|min:1',
                'dishes.*.note' => 'nullable|string'
        ];
    }
}
