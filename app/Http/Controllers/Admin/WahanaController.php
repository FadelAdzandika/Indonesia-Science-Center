<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wahana; // Pastikan model Wahana di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WahanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wahanas = Wahana::orderBy('name', 'asc')->get(); // Ambil semua wahana, urutkan berdasarkan nama
        return view('wahana.index', compact('wahanas')); // Mengarah ke view publik wahana.index
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.wahanas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:70', // Misal: text-primary, atau hex #RRGGBB
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'is_new' tidak perlu validasi khusus jika menggunakan $request->boolean()
        ]);

        $wahana = new Wahana();
        $wahana->name = $request->name;
        $wahana->description = $request->description;
        $wahana->icon = $request->icon;
        $wahana->color = $request->color;
        $wahana->is_new = $request->boolean('is_new'); // Mengambil nilai boolean dari checkbox

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('wahanas', 'public'); // Simpan gambar di storage/app/public/wahanas
            $wahana->image = $imagePath;
        }

        $wahana->save();

        return redirect()->route('admin.wahanas.index')->with('success', 'Wahana berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wahana $wahana)
    {
        return view('admin.wahanas.edit', compact('wahana'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wahana $wahana)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:70',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $wahana->name = $request->name;
        $wahana->description = $request->description;
        $wahana->icon = $request->icon;
        $wahana->color = $request->color;
        $wahana->is_new = $request->boolean('is_new'); // Mengupdate nilai boolean dari checkbox

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($wahana->image) {
                Storage::disk('public')->delete($wahana->image);
            }
            $imagePath = $request->file('image')->store('wahanas', 'public');
            $wahana->image = $imagePath;
        }

        $wahana->save();

        return redirect()->route('admin.dashboard')->with('success', 'Wahana berhasil diperbarui!');
    }

    // Metode destroy() bisa Anda tambahkan jika belum ada, sesuai file admin.wahanas.index.blade.php
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wahana $wahana)
    {
        // Hapus gambar terkait jika ada
        if ($wahana->image) {
            Storage::disk('public')->delete($wahana->image);
        }

        $wahana->delete();

        return redirect()->route('admin.wahanas.index')->with('success', 'Wahana berhasil dihapus!');
    }
}