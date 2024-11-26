<?php

namespace App\Http\Controllers;


use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
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
                    'password' => bcrypt(Str::random(16))
                ],
            );

            $token = $authUser->createToken('authToken')->plainTextToken;

            $frontendUrl = config('app.frontend_url');
//            return redirect("{$frontendUrl}/login/callback")->withCookie(cookie('auth_token', $token, 60, '/', null, false, true));
            return redirect("{$frontendUrl}/login/callback?token={$token}");

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
