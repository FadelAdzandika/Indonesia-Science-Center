<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competition;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $competitions = \App\Models\Competition::all();
        return view('competitions.index', compact('competitions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('competitions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'date' => 'required|date',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
    ]);

    // Simpan gambar jika ada
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('competitions', 'public');
    }

    // Simpan data ke database
    Competition::create([
        'name' => $request->name,
        'date' => $request->date,
        'image' => $imagePath,
    ]);

    return redirect()->route('competitions.index')->with('success', 'Kompetisi berhasil ditambahkan!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('competitions.show', compact('competition'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
