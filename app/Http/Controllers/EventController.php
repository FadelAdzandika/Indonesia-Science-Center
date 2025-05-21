<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = \App\Models\Event::all();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
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
        $imagePath = $request->file('image')->store('events', 'public');
    }

    // Simpan data ke database
    Event::create([
        'name' => $request->name,
        'date' => $request->date,
        'image' => $imagePath,
    ]);

    return redirect()->route('events.index')->with('success', 'Event berhasil ditambahkan!');
}

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
        'name'  => 'required|string|max:255',
        'date'  => 'required|date',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

        $data = $request->only(['name', 'date']);

        // Jika ada file gambar baru, upload dan update
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($event->image) {
                Storage::delete('public/' . $event->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public');
        }
        $event->update($data);

        return redirect()->route('events.show', $event)->with('success', 'Event berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
