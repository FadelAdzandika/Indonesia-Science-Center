<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Str; // Tambahkan ini
use Illuminate\Support\Facades\Storage; // Tambahkan ini
use Illuminate\Support\Facades\Route; // Tambahkan ini
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Periksa apakah rute yang sedang diakses memiliki prefix '/admin'
        if (request()->route()->getPrefix() === '/admin') {
            // Jika ya, ini adalah permintaan untuk daftar event di sisi admin
            $events = Event::latest()->paginate(10);
            return view('admin.events.index', compact('events'));
        }
        // Jika tidak, ini adalah permintaan untuk daftar event di sisi publik
        $events = Event::latest()->paginate(10);
        return view('events.index', compact('events')); // Tampilkan view publik
    }

    /**
     * Show the form for creating a new resource.
     * (Biasanya untuk admin)
     */
    public function create()
    {
        // Pastikan view ini ada: resources/views/admin/events/create.blade.php
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     * (Biasanya untuk admin)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Contoh validasi thumbnail
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('event_thumbnails', 'public');
            $data['thumbnail'] = $path;
        }

        Event::create($data);

        return redirect()->route('admin.events.index') // Asumsi ada route admin.events.index
                         ->with('success', 'Event berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // Membedakan view berdasarkan rute yang diakses
        if (Str::startsWith(Route::currentRouteName(), 'admin.')) {
            return view('admin.events.show', compact('event')); // View detail untuk admin
        }
        // Untuk rute publik 'events.show'
        return view('events.show', compact('event')); // View detail untuk publik
    }

    /**
     * Show the form for editing the specified resource.
     * (Biasanya untuk admin)
     */
    public function edit(Event $event)
    {
        // Pastikan view ini ada: resources/views/admin/events/edit.blade.php
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     * (Biasanya untuk admin)
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($event->thumbnail) {
                Storage::disk('public')->delete($event->thumbnail);
            }
            $path = $request->file('thumbnail')->store('event_thumbnails', 'public');
            $data['thumbnail'] = $path;
        }

        $event->update($data);

        return redirect()->route('admin.events.index') // Asumsi ada route admin.events.index
                         ->with('success', 'Event berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * (Biasanya untuk admin)
     */
    public function destroy(Event $event)
    {
        // Hapus thumbnail jika ada sebelum menghapus event
        if ($event->thumbnail) {
            Storage::disk('public')->delete($event->thumbnail);
        }
        $event->delete();
        return redirect()->route('admin.events.index') // Asumsi ada route admin.events.index
                         ->with('success', 'Event berhasil dihapus.');
    }
}
