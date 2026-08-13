<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<Branch> */
class BranchFactory extends Factory
{
    protected $model = Branch::class;

    public function definition(): array
    {
        $name = $this->faker->city();

        return [
            'code' => strtoupper(Str::slug(substr($name, 0, 3))).'-'.$this->faker->unique()->numerify('###'),
            'name' => 'Cabang '.$name,
            'address' => $this->faker->address(),
            'status' => Branch::STATUS_ACTIVE,
        ];
    }
}
