<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarHistory;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Load data to show in dashboard page
     *
     * @return JsonResponse
     */

    public function index(): JsonResponse
    {
        $value = Car::query()->sum('price');

        $cars = Car::query()->orderBy('model')->get();
        $users = User::all();
        $carHistory = CarHistory::query()
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($carHistory as $history) {
            $history->user = $history->user()->first();
        }

        return response()->json([
            'total_price' => $value,
            'users' => $users,
            'cars' => $cars,
            'car_history' => $carHistory,
        ], 200);
    }

    /**
     * Handle car according to request parameters
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function orderCar(Request $request): JsonResponse
    {
        if ($request['order'] == 'highprice') {
            $cars = Car::query()->orderBy('price', 'desc')->get();
        } else {
            $cars = Car::query()->orderBy($request['order'])->get();
        }
        return response()->json([$cars], 200);
    }

    /**
     * Order history according to request parameters
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function orderHistory(Request $request): JsonResponse
    {
        if ($request['order'] !== 'all') {
            $carHistory = CarHistory::query()
                ->where('method', '=', $request['order'])
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $carHistory = CarHistory::query()
                ->orderBy('created_at', 'desc')
                ->get();
        }

        foreach ($carHistory as $history) {
            $history->user = $history->user()->first();
        }
        return response()->json([$carHistory], 200);
    }
}
