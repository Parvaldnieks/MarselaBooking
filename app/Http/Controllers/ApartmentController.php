<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

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
            'availability' => 'required|string',
            'rating' => 'nullable|integer|between:0,5',
            'price' => 'required|integer',
            'image_urls.*' => 'required|url', // Validate each image URL
        ]);

        try {
            // Create the apartment
            $apartment = Apartment::create([
                'availability' => $request->availability,
                'rating' => $request->rating,
                'price' => $request->price,
            ]);

            // Store image URLs
            foreach ($request->image_urls as $imageUrl) {
                $apartment->images()->create(['image_path' => $imageUrl]);
            }

            return redirect()->route('apartments.index')->with('success', 'Apartment created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create apartment.'])->withInput();
        }
    }

    public function edit(Apartment $apartment)
    {
        return view('apartments.edit', compact('apartment'));
    }

    public function update(Request $request, Apartment $apartment)
    {
        $request->validate([
            'availability' => 'required|string',
            'rating' => 'nullable|integer|between:0,5',
            'price' => 'required|integer',
            'image_urls.*' => 'nullable|url', // Validate each image URL
        ]);

        try {
            // Update the apartment attributes
            $apartment->update([
                'availability' => $request->availability,
                'rating' => $request->rating,
                'price' => $request->price,
            ]);

            // If new image URLs are provided, update them
            if ($request->has('image_urls')) {
                $apartment->images()->delete(); // Delete existing images
                foreach ($request->image_urls as $imageUrl) {
                    $apartment->images()->create(['image_path' => $imageUrl]);
                }
            }

            return redirect()->route('apartments.index')->with('success', 'Apartment updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update apartment.'])->withInput();
        }
    }

    public function destroy(Apartment $apartment)
    {
        $apartment->delete();
        return redirect()->route('apartments.index')->with('success', 'Apartment deleted successfully.');
    }
}