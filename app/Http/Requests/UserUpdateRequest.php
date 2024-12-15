<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'string|min:2|max:30|regex:/^[a-zA-ZÀ-ž\s\'-]+$/',
            'last_name' => 'string|min:2|max:30|regex:/^[a-zA-ZÀ-ž\s\'-]+$/',
            'email' => 'email|max:255',
            'phone_number' => 'string|regex:/^\+?\d{9,15}$/',
            'voivodship' => 'string|min:1|max:30',
            'city' => 'string|min:1|max:30',
            'zip_code' => 'string|regex:/^\d{2}-\d{3}$/',
            'street' => 'string|min:1|max:30',
            'house_number' => 'string|regex:/^\d+[a-zA-Z]?$/',

            'card_first_name' => 'string|min:2|max:30|regex:/^[a-zA-ZÀ-ž\s\'-]+$/',
            'card_last_name' => 'string|min:2|max:30|regex:/^[a-zA-ZÀ-ž\s\'-]+$/',
            'card_number' => 'string|regex:/^\d{16}$/',
            'card_expiry_date' => 'string|regex:/^\d{2}\/\d{2}$/',
            'card_cvv' => 'string|regex:/^\d{3,4}$/',
        ];
    }
}
