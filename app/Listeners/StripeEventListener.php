<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Events\WebhookReceived;

class StripeEventListener
{
    /**
     * Handle stripe payment event.
     */
    public function handle(WebhookReceived $event): void
    {
        if ($event->payload['type'] === 'checkout.session.completed') {
            $session = $event->payload['data']['object'];

            $user = User::where('stripe_id', $session['customer'])->first();

            if ($user) {
                $user->update(['has_course_access' => true]);
                Log::info("Użytkownik {$user->email} właśnie kupił kurs!");
            }
        }
    }
}
