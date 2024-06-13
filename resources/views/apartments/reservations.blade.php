@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-6 text-center text-blue-600">Your Reservations</h1>

    @if ($reservations->isEmpty())
        <p class="text-center text-gray-600">You have no reservations yet.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($reservations as $reservation)
                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">{{ $reservation->apartment->availability }}</h2>
                        <p class="text-gray-700 mb-2">Reservation Date: {{ $reservation->reservation_date }}</p>
                        <!-- Add more details as needed -->
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection