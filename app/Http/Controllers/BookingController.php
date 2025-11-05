<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'week' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Request something like api/bookings?week=2025-11-05',
            ]);

        }

        $date = Carbon::parse($request->week);
        $startOfWeek = $date->startOfWeek()->toDateTimeString(); // Monday
        $endOfWeek = $date->endOfWeek()->toDateTimeString();   // Sunday

        $bookings = Booking::with(['user', 'client'])
            ->whereBetween('start_time', [$startOfWeek, $endOfWeek])
            ->get();

        return response()->json($bookings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $clients = Client::all();
        $users = User::latest()->get();

        // Return the form view
        return view('bookings.create', compact('clients', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'user_id' => 'required|exists:users,id',
            'client_id' => 'required|exists:clients,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check for overlapping bookings for the same user
        $overlapping = Booking::where('user_id', $request->user_id)
            ->where(function ($query) use ($request) {
                $query->where('start_time', '<', $request->end_time)
                    ->where('end_time', '>', $request->start_time);
            })
            ->exists();

        if ($overlapping) {
            return redirect()
                ->back()
                ->withErrors(['booking' => 'The user has an overlapping booking'])
                ->withInput();
        }

        $booking = Booking::create($request->all());

        return redirect()->back()->with('success', 'Booking created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Booking $booking)
    {
        $booking->delete();

        return redirect()->route('dashboard')->with('success', 'Booking deleted successfully.');
    }

}
