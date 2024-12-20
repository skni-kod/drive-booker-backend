<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'email|max:255|unique:users,email,' . $this->user->id,
            'phone_number' => 'string|regex:/^\+?\d{9,15}$/',
            'voivodship' => 'string|min:1|max:30',
            'city' => 'string|min:1|max:30',
            'zip_code' => 'string|regex:/^\d{2}-\d{3}$/',
            'street' => 'string|min:1|max:30',
            'house_number' => 'string|regex:/^\d+[a-zA-Z]?$/',
        ];
    }

    public function updateUser(): array
    {
        return $this->validated();
    }
}
