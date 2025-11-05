<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingApiRetrievalByWeekTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_it_can_retrieve_booking_by_week(): void
    {
        $response = $this->getJson('/api/bookings?week=2025-11-05');

        $response->assertStatus(200);
    }
}
