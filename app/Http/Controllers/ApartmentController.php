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
    ]);

    try {
        Apartment::create($request->all());
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
        ]);

        try {
            $apartment->update($request->all());
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