<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($user): JsonResponse
    {
        return response()->json([$user->cars()], 200);
    }
}
