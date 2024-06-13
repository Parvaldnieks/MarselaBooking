@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-6 text-white text-center">Create Apartment</h1>
    <form action="{{ route('apartments.store') }}" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto">

        @csrf
        <div class="mb-4">
            <label for="availability" class="block text-gray-400 text-sm font-semibold mb-2">Availability</label>
            <input type="text" name="availability" id="availability" class="w-full px-3 py-2 rounded-lg shadow-sm focus:ring-blue-300 focus:border-blue-300 bg-gray-100" required>
            @error('availability')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="rating" class="block text-gray-400 text-sm font-semibold mb-2">Rating</label>
            <select name="rating" id="rating" class="w-full px-3 py-2 rounded-lg shadow-sm focus:ring-blue-300 focus:border-blue-300 bg-gray-100" required>
                <option value="">Select Rating</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ str_repeat('⭐', $i) }}</option>
                @endfor
            </select>
            @error('rating')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="price" class="block text-gray-400 text-sm font-semibold mb-2">Price</label>
            <input type="number" name="price" id="price" class="w-full px-3 py-2 rounded-lg shadow-sm focus:ring-blue-300 focus:border-blue-300 bg-gray-100" min="0" required>
            @error('price')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-400 text-sm font-semibold mb-2">Images (URLs)</label>
            <input type="text" name="image_urls[]" class="w-full px-3 py-2 rounded-lg shadow-sm focus:ring-blue-300 focus:border-blue-300 bg-gray-100" placeholder="Enter image URLs" required>
            @error('image_urls')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
            @error('image_urls.*')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
            <div id="additional-image-urls"></div>
            <button type="button" onclick="addImageUrlInput()" class="mt-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring focus:ring-gray-300">Add More URLs</button>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring focus:ring-blue-300 block mx-auto">Create Apartment</button>
    </form>
</div>

<script>
    function addImageUrlInput() {
        const div = document.createElement('div');
        div.innerHTML = `<input type="text" name="image_urls[]" class="w-full px-3 py-2 rounded-lg shadow-sm focus:ring-blue-300 focus:border-blue-300 bg-gray-100 mt-2" placeholder="Enter another image URL">`;
        document.getElementById('additional-image-urls').appendChild(div);
    }
</script>
@endsection