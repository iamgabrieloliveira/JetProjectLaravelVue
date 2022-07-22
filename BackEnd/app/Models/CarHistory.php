<?php

namespace App\Models;

use App\Models\User;
use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'method',
        'user_id',
        'car_id',
        'car_model'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
