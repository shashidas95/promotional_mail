<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'shippingAddress' => 'required|string|max:255',
            'email' => 'required|email|unique:customerprofiles,email',
        ];
    }
}
