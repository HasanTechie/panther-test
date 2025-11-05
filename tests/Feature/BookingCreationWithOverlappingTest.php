<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingCreationWithOverlappingTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_it_cant_create_a_booking(): void
    {
        $user = User::factory()->create();
        $client = Client::factory()->create();

        Booking::create([
            'title' => 'Morning Meeting',
            'start_time' => '2025-11-05 10:00:00',
            'end_time' => '2025-11-05 11:00:00',
            'user_id' => $user->id,
            'client_id' => $client->id,
        ]);

        $overlappingBooking = [
            'title' => 'Conflict Meeting',
            'start_time' => '2025-11-05 10:30:00',
            'end_time' => '2025-11-05 11:30:00',
            'user_id' => $user->id,
            'client_id' => $client->id,
        ];

        $response = $this->actingAs($user)
            ->postJson(route('bookings.store'), $overlappingBooking);

        $response->assertStatus(409)
            ->assertJsonFragment(['message' => 'Overlapping booking detected']);
    }
}
