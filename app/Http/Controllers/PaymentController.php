<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        $priceId = $request->input('price_id');
        $frontendUrl = config('app.frontend_url');

        $checkout = $request->user()->checkout([$priceId => 1], [
            'success_url' => $frontendUrl . '/payment/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $frontendUrl . '/payment/cancel',
        ]);

        return response()->json([
            'checkout_url' => $checkout->url
        ]);
    }
}
