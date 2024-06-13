<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::all();
        return view('apartments.index', compact('apartments'));
    }

    public function show(Apartment $apartment)
    {
        return view('apartments.show', compact('apartment'));
    }

    public function create()
    {
        return view('apartments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'availability' => 'required|integer|min:1|max:10',
            'rating' => 'required|integer|min:1|max:5',
            'price' => 'required|integer|min:1',
            'image_urls' => 'required|array|min:1|max:10',
            'image_urls.*' => ['required', 'url', 'regex:/\.(jpeg|jpg|png|gif)$/i'],
        ]);

        try {
            $apartment = new Apartment([
                'availability' => $request->availability,
                'rating' => $request->rating,
                'price' => $request->price,
                'images' => $request->image_urls,
            ]);
            $apartment->save();

            Log::info('Apartment created.', ['apartment' => $apartment]);

            return redirect()->route('apartments.index')->with('success', 'Apartment created successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create apartment', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Failed to create apartment.'])->withInput();
        }
    }

    public function reservations()
    {
        // Fetch reservations for the authenticated user
        $reservations = Reservation::where('user_id', auth()->id())->get();
        
        // Return the view with reservations data
        return view('reservations', compact('reservations'));
    }

    public function storeReservation(Request $request)
    {
        $request->validate([
            'apartment_id' => 'required|exists:apartments,id',
            'reservation_date' => 'required|date',
        ]);

        try {
            // Create a new reservation
            $reservation = new Reservation([
                'apartment_id' => $request->apartment_id,
                'user_id' => auth()->id(),  // Assuming you're using Laravel's auth system
                'reservation_date' => $request->reservation_date,
            ]);
            $reservation->save();

            // Update availability of the apartment
            $apartment = Apartment::findOrFail($request->apartment_id);
            $apartment->availability -= 1; // Decrease availability by 1
            $apartment->save();

            return redirect()->back()->with('success', 'Reservation created successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create reservation', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Failed to create reservation.'])->withInput();
        }
    }

    public function edit(Apartment $apartment)
    {
        return view('apartments.edit', compact('apartment'));
    }

    public function update(Request $request, Apartment $apartment)
{
    $request->validate([
        'availability' => 'required|integer|min:1|max:10',
        'rating' => 'required|integer|min:1|max:5',
        'price' => 'required|integer|min:1',
        'image_urls' => 'required|array|min:1|max:10',
        'image_urls.*' => ['required', 'url', 'regex:/\.(jpeg|jpg|png|gif)$/i'],
    ]);

    try {
        $apartment->update([
            'availability' => $request->availability,
            'rating' => $request->rating,
            'price' => $request->price,
            'images' => $request->image_urls,
        ]);

        return redirect()->route('apartments.index')->with('success', 'Apartment updated successfully.');
    } catch (\Exception $e) {
        Log::error('Failed to update apartment', ['error' => $e->getMessage()]);
        return redirect()->back()->withErrors(['error' => 'Failed to update apartment.'])->withInput();
    }
}

    public function destroy(Apartment $apartment)
    {
        try {
            $apartment->delete();
            return redirect()->route('apartments.index')->with('success', 'Apartment deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete apartment', ['error' => $e->getMessage()]);
            return redirect()->route('apartments.index')->withErrors(['error' => 'Failed to delete apartment.']);
        }
    }
}