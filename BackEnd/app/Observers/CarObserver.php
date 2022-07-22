<?php

namespace App\Observers;

use App\Models\Car;

class CarObserver
{
    /**
     * Handle the Car "created" event.
     *
     * @param Car $car
     * @return void
     */
    public function created(Car $car): void
    {
        $car->insertCarHistory('Create');
    }

    /**
     * Handle the Car "updated" event.
     *
     * @param Car $car
     * @return void
     */
    public function updated(Car $car): void
    {
        $car->insertCarHistory('Update');
    }

    /**
     * Handle the Car "deleted" event.
     *
     * @param Car $car
     * @return void
     */
    public function deleted(Car $car): void
    {
        $car->insertCarHistory('Delete');
    }

    /**
     * Handle the Car "restored" event.
     *
     * @param Car $car
     * @return void
     */
    public function restored(Car $car): void
    {
        //
    }

    /**
     * Handle the Car "force deleted" event.
     *
     * @param Car $car
     * @return void
     */
    public function forceDeleted(Car $car): void
    {
        //
    }
}
