<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\Rating;
use App\Models\RatingAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<RatingAnswer> */
class RatingAnswerFactory extends Factory
{
    protected $model = RatingAnswer::class;

    public function definition(): array
    {
        return [
            'rating_id' => Rating::factory(),
            'question_id' => Question::factory(),
            'answer_value' => [$this->faker->numberBetween(1, 5)],
            'answer_text' => null,
        ];
    }
}
