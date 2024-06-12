@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-6 text-white">Apartments</h1>

    <div class="overflow-x-auto bg-white p-6 rounded-lg shadow-lg">
        <table class="table-auto w-full border border-gray-300 rounded-lg">
            <thead class="bg-gray-300">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Availability</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Rating</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach ($apartments as $apartment)
                <?php $imageSrc = '/images/' . $apartment->image; ?>
                <tr class="bg-gray-100 hover:bg-gray-200">
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $apartment->availability }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $apartment->rating }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $apartment->price }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="{{ $imageSrc }}" alt="Apartment Image" class="w-20 h-20 object-cover rounded">
                    </td>
                </tr>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
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
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection