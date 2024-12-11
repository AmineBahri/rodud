<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class AddOrderRequest extends FormRequest
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
            'location' => 'required|string|max:255',
            'size' => 'required|numeric|min:0.1',
            'weight' => 'required|numeric|min:0.1',
            'pickup_time' => 'required|date|after:now',
            'delivery_time' => 'required|date|after:pickup_time',
        ];
    }
}