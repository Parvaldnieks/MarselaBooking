@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-6 text-white">Edit Apartment</h1>
    <form action="{{ route('apartments.update', $apartment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="availability" class="block text-sm font-medium text-gray-400">Availability</label>
            <input type="text" name="availability" id="availability" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md bg-gray-200 text-gray-700" value="{{ $apartment->availability }}" required>
        </div>
        <div class="mb-4">
            <label for="rating" class="block text-sm font-medium text-gray-400">Rating</label>
            <input type="number" name="rating" id="rating" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md bg-gray-200 text-gray-700" min="0" max="5" value="{{ $apartment->rating }}" required>
        </div>
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-400">Price</label>
            <input type="number" name="price" id="price" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md bg-gray-200 text-gray-700" value="{{ $apartment->price }}" required>
        </div>
        <button type="submit" class="inline-block bg-blue-300 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded">Update Apartment</button>
    </form>
</div>
@endsection
