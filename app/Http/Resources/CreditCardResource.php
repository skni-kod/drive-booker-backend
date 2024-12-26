<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreditCardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'card_first_name' => $this->card_first_name,
            'card_last_name' => $this->card_last_name,
            'card_number' => $this->maskCardNumber($this->card_number),
            'card_expiry_date' => $this->card_expiry_date,
            'card_cvv' => $this->maskCvv($this->card_cvv),
        ];
    }

    private function maskCardNumber(string $cardNumber): string
    {
        // ############1234
        return str_repeat('#', strlen($cardNumber) - 4).substr($cardNumber, -4);
    }

    private function maskCvv(string $cvv): string
    {
        return str_repeat('*', strlen($cvv));
    }
}
