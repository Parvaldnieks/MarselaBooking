@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-6 text-white">Create Apartment</h1>
    <form action="{{ route('apartments.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="availability" class="block text-gray-400 text-sm font-semibold mb-2">Availability</label>
            <input type="text" name="availability" id="availability" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline bg-gray-200" required>
        </div>
        <div class="mb-4">
            <label for="rating" class="block text-gray-400 text-sm font-semibold mb-2">Rating</label>
            <input type="number" name="rating" id="rating" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline bg-gray-200" min="0" max="5" required>
        </div>
        <div class="mb-6">
            <label for="price" class="block text-gray-400 text-sm font-semibold mb-2">Price</label>
            <input type="number" name="price" id="price" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline bg-gray-200" required>
        </div>
        <button type="submit" class="bg-blue-300 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create Apartment</button>
    </form>
</div>
@endsection