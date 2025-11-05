<x-app-layout>
    <div style="margin-top: 2em;" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    @if ($errors->any())
            <div class="mb-4 p-4 border border-red-300 bg-red-50 text-red-700 rounded">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @if (session('success'))
            <div class="mb-4 p-4 border border-green-300 bg-green-50 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif
        <div class="bg-white p-6 rounded-2xl shadow">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">Create New Booking</h1>
            <form action="{{ route('bookings.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="mb-2">
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
                <div class="mb-2">
                    <label for="description" class="block text-gray-700 font-medium">Description</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        placeholder="Enter booking description"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                    >{{ old('description') }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="block text-gray-700 font-medium">Client</label>
                    <select name="client_id" class="w-full border-gray-300 rounded-lg p-2">
                        <option value="">Select a client</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                    @error('client_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-2">
                    <label class="block text-gray-700 font-medium">User</label>
                    <select name="user_id" class="w-full border-gray-300 rounded-lg p-2">
                        <option value="">Select a user</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-2">
                    <label class="block text-gray-700 font-medium">Start Time</label>
                    <input type="datetime-local" name="start_time" class="w-full border-gray-300 rounded-lg p-2">
                    @error('start_time') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-2">
                    <label class="block text-gray-700 font-medium">End Time</label>
                    <input type="datetime-local" name="end_time" class="w-full border-gray-300 rounded-lg p-2">
                    @error('end_time') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <br/>
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                    Save Booking
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
