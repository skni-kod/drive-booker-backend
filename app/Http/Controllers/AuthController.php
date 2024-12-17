<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        try {
            $user = User::create([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'password' => Hash::make($fields['password']),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Registration successful.',
                'user' => $user,
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            Log::error('User creation failed: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Registration failed. Please try again.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {

        $credentials = $request->validated();

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {

            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'user' => $user,
            'access_token' => $token,
            'message' => 'Login successful',
        ], Response::HTTP_OK);
    }

    public function user(): UserResource
    {
        return new UserResource(auth()->user());
    }

    public function update(UserUpdateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = auth()->user();

        try {
            $user->update($data);
        }
        catch (Exception $e)
        {
            return response()->json(['message' => "Failed to update user's profile!"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json(['success' => true], Response::HTTP_OK);
    }
}
