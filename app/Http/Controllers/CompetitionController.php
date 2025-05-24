<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan ini
use App\Models\Competition;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Periksa apakah rute yang sedang diakses memiliki prefix '/admin'
        if (request()->route()->getPrefix() === '/admin') {
            // Jika ya, ini adalah permintaan untuk daftar kompetisi di sisi admin
            $competitions = Competition::latest()->paginate(10);
            return view('admin.competitions.index', compact('competitions')); // Tampilkan view admin
        }
        // Jika tidak, ini adalah permintaan untuk daftar kompetisi di sisi publik
        $competitions = Competition::latest()->paginate(10);
        return view('competitions.index', compact('competitions')); // Tampilkan view publik
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Pastikan view ini ada: resources/views/admin/competitions/create.blade.php
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
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('competition_thumbnails', 'public');
            $data['thumbnail'] = $path;
        }

        Competition::create($data);

        return redirect()->route('admin.competitions.index')
                         ->with('success', 'Kompetisi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Competition $competition) // Menggunakan Route Model Binding
    {
        // Pastikan view ini ada: resources/views/competitions/show.blade.php (untuk publik)
        return view('competitions.show', compact('competition'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competition $competition) // Menggunakan Route Model Binding
    {
        // Pastikan view ini ada: resources/views/admin/competitions/edit.blade.php
        return view('admin.competitions.edit', compact('competition'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Competition $competition) // Menggunakan Route Model Binding
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($competition->thumbnail) {
                Storage::disk('public')->delete($competition->thumbnail);
            }
            $path = $request->file('thumbnail')->store('competition_thumbnails', 'public');
            $data['thumbnail'] = $path;
        }

        $competition->update($data);

        return redirect()->route('admin.competitions.index')
                         ->with('success', 'Kompetisi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competition $competition) // Menggunakan Route Model Binding
    {
        // Hapus thumbnail jika ada sebelum menghapus kompetisi
        if ($competition->thumbnail) {
            Storage::disk('public')->delete($competition->thumbnail);
        }
        $competition->delete();
        return redirect()->route('admin.competitions.index')
                         ->with('success', 'Kompetisi berhasil dihapus.');
    }
}
