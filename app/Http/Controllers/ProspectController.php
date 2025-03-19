<?php

namespace App\Http\Controllers;

use App\Models\Prospect; 
use Illuminate\Http\Request;

class ProspectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prospects = Prospect::all(); 
        return view('prospects.index', compact('prospects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prospects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email_address' => 'required|email',
            'phone_number' => 'required|string|max:20',
            'description' => 'nullable|string',
        ]);

        Prospect::create($validated);

        return redirect()->route('prospects.index')->with('success', 'Prospect created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prospect = Prospect::findOrFail($id); 
        return view('prospects.show', compact('prospect'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $prospect = Prospect::findOrFail($id);
        return view('prospects.edit', compact('prospect'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email_address' => 'required|email',
            'phone_number' => 'required|string|max:20',
            'description' => 'nullable|string',
        ]);

        $prospect = Prospect::findOrFail($id);
        $prospect->update($validated);

        return redirect()->route('prospects.index')->with('success', 'Prospect updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $prospect = Prospect::findOrFail($id);
        $prospect->delete();

        return redirect()->route('prospects.index')->with('success', 'Prospect deleted successfully!');
    }
}
