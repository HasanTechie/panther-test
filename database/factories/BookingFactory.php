<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //
        $startTime = $this->faker->dateTimeBetween('+10 day', '+30 days');
        $durationHours = $this->faker->randomElement([1, 2]);
        $endTime = Carbon::parse($startTime)->addHours($durationHours);
        $title = fake()->catchPhrase();

        return [
            //
            'title' => 'Meeting about ' . $title,
            'description' => 'Description about ' . $title,
            'user_id' => User::factory(),
            'client_id' => Client::factory(),
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }
}
