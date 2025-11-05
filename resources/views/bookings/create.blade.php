<x-app-layout>
    <div class="flex justify-center">

        <div class="bg-white p-6 rounded-2xl shadow">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">Create New Booking</h1>

            <form action="{{ route('bookings.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="title" class="block text-gray-700 font-medium">Title</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title') }}"
                        placeholder="Enter booking title"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                        required
                    >
                    @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Client</label>
                    <select name="client_id" class="w-full border-gray-300 rounded-lg p-2">
                        <option value="">Select a client</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                    @error('client_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">User</label>
                    <select name="user_id" class="w-full border-gray-300 rounded-lg p-2">
                        <option value="">Select a user</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Start Time</label>
                    <input type="datetime-local" name="start_time" class="w-full border-gray-300 rounded-lg p-2">
                    @error('start_time') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">End Time</label>
                    <input type="datetime-local" name="end_time" class="w-full border-gray-300 rounded-lg p-2">
                    @error('end_time') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="bg-blue-600 text-black px-5 py-2 rounded-lg hover:bg-blue-700">
                    Save Booking
                </button>
            </form>
        </div>
    </div>

</x-app-layout>
