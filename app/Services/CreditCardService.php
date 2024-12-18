<?php

namespace App\Services;

use App\Models\CreditCard;
use App\Models\User;

class CreditCardService
{

    public function show(User $user): CreditCard
    {
        return $user->creditCard;
    }
    public function updateOrCreate(array $data, User $user): CreditCard
    {
        $creditCard = $user->creditCard();
        return $creditCard->updateOrCreate(['user_id' => $user->id], $data);
    }
}
