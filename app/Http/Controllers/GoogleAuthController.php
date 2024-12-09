<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->stateless()
            ->redirectUrl(config('services.google.redirect'))
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();

            $authUser = User::firstOrCreate(
                ['email' => $user->getEmail()],
                [
                    'name' => $user->getName(),
                    'password' => bcrypt(Str::random(16)),
                ],
            );

            $token = $authUser->createToken('authToken')->plainTextToken;

            $frontendUrl = config('app.frontend_url');

            EncryptCookies::except('auth_token');
            return redirect("{$frontendUrl}/api/login/google")->withCookie(cookie('auth_token', $token, 1, '/', null, false, true));

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
