@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-6 text-white">Apartments</h1>
    @if(auth()->check() && auth()->user()->is_admin)
    @endif
    <div class="overflow-x-auto">
        <table class="table-auto w-full border border-gray-200 rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Availability</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Rating</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($apartments as $apartment)
                    <tr class="bg-white">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $apartment->availability }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $apartment->rating }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $apartment->price }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if(auth()->check() && auth()->user()->is_admin)
                                <a href="{{ route('apartments.edit', $apartment->id) }}" class="bg-yellow-300 hover:bg-yellow-400 text-white font-bold py-1 px-2 rounded">Edit</a>
                                <form action="{{ route('apartments.destroy', $apartment->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-300 hover:bg-red-400 text-white font-bold py-1 px-2 rounded">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection