@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-6 text-white text-center">Create Apartment</h1>
    <form action="{{ route('apartments.store') }}" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto">

        @csrf
        <div class="mb-4">
            <label for="availability" class="block text-gray-400 text-sm font-semibold mb-2">Availability</label>
            <input type="text" name="availability" id="availability" class="w-full px-3 py-2 rounded-lg shadow-sm focus:ring-blue-300 focus:border-blue-300 bg-gray-100" required>
        </div>

        <div class="mb-4">
            <label for="rating" class="block text-gray-400 text-sm font-semibold mb-2">Rating</label>
            <input type="number" name="rating" id="rating" class="w-full px-3 py-2 rounded-lg shadow-sm focus:ring-blue-300 focus:border-blue-300 bg-gray-100" min="0" max="5" required>
        </div>

        <div class="mb-6">
            <label for="price" class="block text-gray-400 text-sm font-semibold mb-2">Price</label>
            <input type="number" name="price" id="price" class="w-full px-3 py-2 rounded-lg shadow-sm focus:ring-blue-300 focus:border-blue-300 bg-gray-100" required>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-400 text-sm font-semibold mb-2">Images (URLs)</label>
            <input type="text" name="image_urls[]" class="w-full px-3 py-2 rounded-lg shadow-sm focus:ring-blue-300 focus:border-blue-300 bg-gray-100" placeholder="Enter image URLs" required>
            <!-- Allow users to input multiple image URLs -->
            <div class="mt-2">
                <input type="text" name="image_urls[]" class="w-full px-3 py-2 rounded-lg shadow-sm focus:ring-blue-300 focus:border-blue-300 bg-gray-100" placeholder="Enter another image URL">
                <!-- You can add more input fields dynamically with JavaScript if needed -->
            </div>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring focus:ring-blue-300 block mx-auto">Create Apartment</button>
    </form>
</div>
@endsection