@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-6 text-white text-center">Edit Apartment</h1>
    <form action="{{ route('apartments.update', $apartment->id) }}" method="POST" class="max-w-md mx-auto">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="availability" class="block text-sm font-medium text-gray-400">Availability</label>
            <input type="text" name="availability" id="availability" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full px-4 py-2 rounded-md shadow-sm bg-gray-200 text-gray-700" value="{{ old('availability', $apartment->availability) }}" required>
            @error('availability')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="rating" class="block text-gray-400 text-sm font-semibold mb-2">Rating</label>
            <select name="rating" id="rating" class="w-full px-3 py-2 rounded-lg shadow-sm focus:ring-blue-300 focus:border-blue-300 bg-gray-100" required>
                <option value="">Select Rating</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" @if (old('rating', $apartment->rating) == $i) selected @endif>{{ str_repeat('⭐', $i) }}</option>
                @endfor
            </select>
            @error('rating')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="price" class="block text-gray-400 text-sm font-semibold mb-2">Price</label>
            <input type="number" name="price" id="price" class="w-full px-3 py-2 rounded-lg shadow-sm focus:ring-blue-300 focus:border-blue-300 bg-gray-100" min="0" value="{{ old('price', $apartment->price) }}" required>
            @error('price')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-400 text-sm font-semibold mb-2">Images (URLs)</label>
            @foreach ($apartment->images as $index => $image)
                <input type="text" name="image_urls[]" class="w-full px-3 py-2 rounded-lg shadow-sm focus:ring-blue-300 focus:border-blue-300 bg-gray-100 mb-2" value="{{ old('image_urls.' . $index, $image) }}" placeholder="Enter image URL" required>
            @endforeach
            @error('image_urls')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
            @error('image_urls.*')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
            <div id="additional-image-urls"></div>
            <button type="button" onclick="addImageUrlInput()" class="mt-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring focus:ring-gray-300">Add More URLs</button>
        </div>

        <div class="flex justify-center">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring focus:ring-blue-300">Update Apartment</button>
        </div>
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