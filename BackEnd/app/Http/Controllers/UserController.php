<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(UserLoginRequest $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
            return response()->json([Auth::user()], 200);
        }else{
            return response()->json(['message' => 'Email and password invalids!'], 402);
        }
    }
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
    public function logout(): JsonResponse
    {
        auth()->logout();
        return response()->json(['Logout successfully!'], 200);
    }
}
