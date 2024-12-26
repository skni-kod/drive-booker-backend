<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCreditCardRequest;
use App\Http\Resources\CreditCardResource;
use App\Models\User;
use App\Services\CreditCardService;

class CreditCardController extends Controller
{
    public function __construct(protected CreditCardService $creditCardService) {}

    public function show(User $user): CreditCardResource
    {
        return new CreditCardResource($this->creditCardService->show($user));
    }

    public function update(UpdateCreditCardRequest $request, User $user): CreditCardResource
    {
        return new CreditCardResource($this->creditCardService->updateOrCreate($request->updateCard(), $user));
    }
}
