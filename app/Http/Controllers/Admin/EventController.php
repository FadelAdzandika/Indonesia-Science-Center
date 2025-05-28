<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::latest()->paginate(10);
        // Ensure you have a view file at: resources/views/admin/events/index.blade.php
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ensure you have a view file at: resources/views/admin/events/create.blade.php
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'event_date' => 'nullable|date',
        ]);

        $data = $request->only(['title', 'description', 'event_date']);

        if ($request->hasFile('thumbnail')) {
            // Assumes 'public' disk is configured for storage/app/public
            // and you've run `php artisan storage:link`
            $data['thumbnail'] = $request->file('thumbnail')->store('events', 'public_uploads');
        }

        Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        // Ensure you have a view file at: resources/views/admin/events/edit.blade.php
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'event_date' => 'nullable|date',
        ]);

        $data = $request->only(['title', 'description', 'event_date']);

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if it exists
            if ($event->thumbnail) {
                Storage::disk('public_uploads')->delete($event->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('events', 'public_uploads');
        }

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // Delete thumbnail if it exists
        if ($event->thumbnail) {
            Storage::disk('public_uploads')->delete($event->thumbnail);
        }
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus.');
    }
}