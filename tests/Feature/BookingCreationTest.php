<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingCreationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_it_can_create_a_booking(): void
    {

        $user = User::factory()->create();
        $client = Client::factory()->create();

        $bookingData = [
            'title' => 'Team Meeting',
            'description' => 'Weekly team sync',
            'start_time' => '2025-11-05 10:00:00',
            'end_time' => '2025-11-05 11:00:00',
            'user_id' => $user->id,
            'client_id' => $client->id,
        ];


        $booking = Booking::create($bookingData);


        $this->assertDatabaseHas('bookings', [
            'title' => 'Team Meeting',
            'user_id' => $user->id,
            'client_id' => $client->id,
        ]);
    }
}
