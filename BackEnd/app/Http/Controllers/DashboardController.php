<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(): JsonResponse
    {
        $value = Car::query()
            ->sum('price');

        $cars = Car::all();
        $users = User::all();

        return response()->json([
            'total_price' => $value,
            'users' => $users,
            'cars' => $cars,
        ], 200);
    }
}
