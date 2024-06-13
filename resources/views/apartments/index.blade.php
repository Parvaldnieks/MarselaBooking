@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-6 text-center text-blue-600">Apartments</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($apartments as $apartment)
        <div class="bg-white rounded-lg overflow-hidden shadow-md">
            <div class="relative">
                <img id="mainImage_{{ $apartment->id }}" src="{{ $apartment->images[0] }}" alt="Apartment Image" class="w-full h-64 object-cover cursor-pointer"
                    onclick="showImage('{{ $apartment->id }}', '{{ $apartment->images[0] }}')">
            </div>
            <div class="p-4">
                <h2 class="text-xl font-semibold mb-2">{{ $apartment->availability }}</h2>
                <p class="text-gray-700 mb-2">Rating: 
                    @for ($i = 1; $i <= $apartment->rating; $i++)
                        ⭐
                    @endfor
                </p>
                <p class="text-gray-700 mb-4">Price: ${{ $apartment->price }}</p>
                <div class="flex flex-wrap gap-2">
                    @foreach ($apartment->images as $index => $image)
                    <img src="{{ $image }}" alt="Image {{ $index + 1 }}" class="w-16 h-16 object-cover rounded-md border-2 border-gray-200 hover:border-blue-500 cursor-pointer"
                        onclick="showImage('{{ $apartment->id }}', '{{ $image }}')">
                    @endforeach
                </div>
            </div>
            <div class="px-4 py-2 bg-gray-100">
                @if(auth()->check() && auth()->user()->is_admin)
                <a href="{{ route('apartments.edit', $apartment->id) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-3 rounded mr-2">
                    Edit
                </a>
                <form action="{{ route('apartments.destroy', $apartment->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-3 rounded">
                        Delete
                    </button>
                </form>
                @else
                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-3 rounded">
                        Book Now
                    </button>
                </form>


                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    function showImage(apartmentId, imageUrl) {
        document.getElementById('mainImage_' + apartmentId).src = imageUrl;
    }
</script>

@endsection