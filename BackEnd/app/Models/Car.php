<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\CarHistory;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Car extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'year',
        'price',
        'currentFipePrice',
        'image',
        'carFuel',
        'hasAirBag',
        'hasInsurance',
        'licensePlate',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function insertCarHistory(string $method): CarHistory
    {
        return CarHistory::firstOrCreate([
            'method' => $method,
            'car_id' => $this->id,
            'user_id' => auth()->id(),
            'car_model' => $this->model,
        ]);
    }
    public function history(): HasMany
    {
        return $this->hasMany(CarHistory::class);
    }
    use HasFactory;
}
