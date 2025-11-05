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

                    <div class="w-full px-4">
                        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                            <table class="min-w-full table-auto border-collapse">
                                <thead class="bg-gray-100 text-gray-900 uppercase text-xs font-semibold tracking-wider">
                                <tr>
                                    <th class="px-4 py-3 text-left border-b">ID</th>
                                    <th class="px-4 py-3 text-left border-b">Booking Title</th>
                                    <th class="px-4 py-3 text-left border-b">User Name</th>
                                    <th class="px-4 py-3 text-left border-b">Client Name</th>
                                    <th class="px-4 py-3 text-left border-b">Start Time</th>
                                    <th class="px-4 py-3 text-left border-b">End Time</th>
                                </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200 text-sm">
                                @forelse($bookings as $booking)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-2">{{ $booking->id }}</td>

                                        <td class="px-4 py-2 truncate max-w-[180px]" title="{{ $booking->title }}">
                                            {{ Str::limit($booking->title, 40) }}
                                        </td>

                                        <td class="px-4 py-2">{{ $booking->user->name }}</td>
                                        <td class="px-4 py-2">{{ $booking->client->name }}</td>
                                        <td class="px-4 py-2">{{ $booking->start_time }}</td>
                                        <td class="px-4 py-2">{{ $booking->end_time }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-gray-500">
                                            No bookings found.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
