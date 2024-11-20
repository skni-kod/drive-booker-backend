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
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback(): JsonResponse
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

            return response()->json(
                [
                    'success' => true,
                    'user' => $user,
                    'access_token' => $token,
                    'message' => 'Successfully logged in'
                ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
