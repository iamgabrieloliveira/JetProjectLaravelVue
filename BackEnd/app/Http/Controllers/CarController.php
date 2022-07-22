<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Load data to show in home
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $cars = Car::query()
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($cars as $car) {
            $car->user = $car->user()->first();
        }

        return response()->json(['cars' => $cars], 200);
    }

    public function search(Request $request): JsonResponse
    {
        $users = User::all();
        $cars = Car::query()
            ->where('brand', 'like', '%' . $request['search'] . '%')
            ->orWhere('model', 'like', '%' . $request['search'] . '%')
            ->get();

        return response()->json(['cars' => $cars, 'users' => $users], 200);
    }

    public function store(StoreCarRequest $request): JsonResponse
    {
        $image = $this->saveImage($request['image']);
        $car = new Car([
            'brand' => $request['brand'],
            'model' => $request['model'],
            'image' => $image,
            'user_id' => $request->user()->id,
            'year' => $request['year'],
            'price' => $request['price'],
            'currentFipePrice' => $request['currentFipePrice'],
            'carFuel' => $request['carFuel'],
            'hasInsurance' => $request['hasInsurance'] == "false" ? 0 : 1,
            'hasAirBag' => $request['hasAirBag'] == "false" ? 0 : 1,
            'licensePlate' => $request['licensePlate']
        ]);
        $car->save();

        return response()->json([$request->all()], 200);
    }

    public function destroy(Car $car): JsonResponse
    {
        $car->delete();
        return response()->json([$car], 200);
    }

    public function saveImage(object $image): string
    {
        $extension = $image->extension();
        $imageName = md5($image->getClientOriginalName() . strtotime('now')) . '.' . $extension;
        $image->move(public_path('/imgs'), $imageName);
        return $imageName;
    }

    public function update(Car $car): JsonResponse
    {
        $users = User::all();
        return response()->json(['car' => $car, 'users' => $users], 200);
    }

    public function postUpdate(Car $car, StoreCarRequest $request): JsonResponse
    {
        $car['brand'] = $request['brand'];
        $car['model'] = $request['model'];
        $car['year'] = $request['year'];
        $car['price'] = $request['price'];
        $car['image'] = $request['image'] ? $request['image'] : $car['image'];
        $car['carFuel'] = $request['carFuel'];
        $car['hasAirBag'] = $request['hasAirBag'] == "false" ? 0 : 1;
        $car['hasInsurance'] = $request['hasInsurance'] == "false" ? 0 : 1;
        $car['licensePlate'] = $request['licensePlate'];
        $car->save();

        return response()->json([$car], 200);
    }

    public function about(Car $car): JsonResponse
    {
        $users = User::all();
        return response()->json(['car' => $car, 'users' => $users], 200);
    }
}
