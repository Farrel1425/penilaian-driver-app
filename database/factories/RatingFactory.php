<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Driver;
use App\Models\Rating;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Rating> */
class RatingFactory extends Factory
{
    protected $model = Rating::class;

    public function definition(): array
    {
        $branch = Branch::factory();

        return [
            'branch_id' => $branch,
            'vehicle_id' => Vehicle::factory()->for($branch),
            'driver_id' => Driver::factory()->for($branch),
            'submitted_at' => now(),
        ];
    }
}
