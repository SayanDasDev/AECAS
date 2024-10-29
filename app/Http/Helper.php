<?php

namespace App\Http;

class Helper
{
    /**
     * Calculate the energy based on various parameters.
     *
     * @param  float  $land_amount  The amount of land involved in the operation.
     * @param  float  $weight  The weight involved in the operation.
     * @param  float  $time_of_operation  The time duration of the operation in hours.
     * @param  float  $frequency  The frequency of the operation.
     * @param  float  $lifespan  The lifespan of the operation in hours.
     * @param  float  $MU_count  The MU count involved in the operation.
     * @param  float  $fuel_consumption_rate  The rate of fuel consumption in liters per hour.
     * @return float  The calculated energy.
     */
    public static function calculateEnergy(
        float $land_amount,
        float $weight,
        float $time_of_operation,
        float $frequency,
        float $lifespan,
        float $MU_count,
        float $fuel_consumption_rate
    ): float
    {
        return $land_amount * $weight * $time_of_operation * $frequency * $lifespan * $MU_count * $fuel_consumption_rate;
    }



}
