<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $competitions = Competition::latest()->paginate(10);
        // Ensure you have a view file at: resources/views/admin/competitions/index.blade.php
        return view('admin.competitions.index', compact('competitions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ensure you have a view file at: resources/views/admin/competitions/create.blade.php
        return view('admin.competitions.create');
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
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $data = $request->only(['title', 'description', 'start_date', 'end_date']);

        if ($request->hasFile('thumbnail')) {
            // Assumes 'public' disk is configured for storage/app/public
            // and you've run `php artisan storage:link`
            $data['thumbnail'] = $request->file('thumbnail')->store('competitions', 'public_uploads');
        }

        Competition::create($data);

        return redirect()->route('admin.competitions.index')->with('success', 'Kompetisi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competition $competition)
    {
        // Ensure you have a view file at: resources/views/admin/competitions/edit.blade.php
        return view('admin.competitions.edit', compact('competition'));
    }

    public function update(Request $request, Competition $competition)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $data = $request->only(['title', 'description', 'start_date', 'end_date']);

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if it exists
            if ($competition->thumbnail) {
                Storage::disk('public_uploads')->delete($competition->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('competitions', 'public_uploads');
        }

        $competition->update($data);

        return redirect()->route('admin.competitions.index')->with('success', 'Kompetisi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competition $competition)
    {
        // Delete thumbnail if it exists
        if ($competition->thumbnail) {
            Storage::disk('public_uploads')->delete($competition->thumbnail);
        }
        $competition->delete();

        return redirect()->route('admin.competitions.index')->with('success', 'Kompetisi berhasil dihapus.');
    }
}