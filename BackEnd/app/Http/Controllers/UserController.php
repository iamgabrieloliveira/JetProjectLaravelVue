<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @param UserLoginRequest $request
     * @return JsonResponse
     */

    public function login(UserLoginRequest $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return response()->json(['message' => 'Login successfully!'], 200);
        } else {
            return response()->json(['message' => 'Email and password invalids!'], 402);
        }
    }

    /**
     * @param UserRegisterRequest $request
     * @return JsonResponse
     */

    public function register(UserRegisterRequest $request): JsonResponse
    {
        $user = new User([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $user->save();

        return response()->json(['message' => 'User created successfully!'], 200);
    }

    /**
     * @return JsonResponse
     */

    public function logout(): JsonResponse
    {
        auth()->logout();
        return response()->json(['message' => 'Logout successfully!'], 200);
    }
}
