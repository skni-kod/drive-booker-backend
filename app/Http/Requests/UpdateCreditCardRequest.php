<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCreditCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'card_first_name' => 'string|min:2|max:30|regex:/^[a-zA-ZÀ-ž\s\'-]+$/',
            'card_last_name' => 'string|min:2|max:30|regex:/^[a-zA-ZÀ-ž\s\'-]+$/',
            'card_number' => 'string|regex:/^\d{16}$/',
            'card_expiry_date' => 'string|regex:/^\d{2}\/\d{2}$/',
            'card_cvv' => 'string|regex:/^\d{3,4}$/',
        ];
    }

    public function updateCard(): array
    {
        return $this->validated();
    }
}
