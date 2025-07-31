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

            $roles = $authUser->roles->pluck('name')->toArray();
            $token = $authUser->createToken('authToken')->plainTextToken;

            $frontendUrl = config('app.frontend_url');

            $profileCompleted = $authUser->profile_completed;

            EncryptCookies::except('auth_token');
            EncryptCookies::except('roles');
            EncryptCookies::except('is_completed');

            return redirect("{$frontendUrl}/api/login/google")
                ->withCookie(cookie('auth_token', $token, 0, '/', null, false, true))
                ->withCookie(cookie('roles', json_encode($roles, JSON_UNESCAPED_SLASHES), 0, '/', null, false, true))
                ->withCookie(cookie('is_completed', $profileCompleted ? 'true' : 'false', 0, '/', null, false, true)); // ✅ Set cookie

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
