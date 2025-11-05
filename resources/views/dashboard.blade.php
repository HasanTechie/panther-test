<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @php
                        $bookings = \App\Models\Booking::with(['client','user'])->get();
//                        dd($bookings);
                    @endphp

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="table-fixed">
                            <thead class="bg-gray-100 text-gray-900 uppercase text-xs font-semibold tracking-wider">
                            <tr>
                                <th class="">Id</th>
                                <th>Booking Title</th>
                                <th>User Name</th>
                                <th>Client Name</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($bookings as $booking)

                                <tr>
                                    <td>{{$booking->id}}</td>
                                    <td>{{$booking->title}}</td>
                                    <td>{{$booking->user->name}}</td>
                                    <td>{{$booking->client->name}}</td>
                                    <td>{{$booking->start_time}}</td>
                                    <td>{{$booking->end_time}}</td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
