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
        $wahanas = Wahana::orderBy('name', 'asc')->paginate(10); // Ganti 10 dengan jumlah item per halaman yang Anda inginkan
        return view('admin.wahana.index', compact('wahanas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.wahana.create');
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
            'video_embed_url' => 'nullable|url|max:500', // Validasi untuk URL video

            // 'is_new' tidak perlu validasi khusus jika menggunakan $request->boolean()
        ]);

        $wahana = new Wahana();
        $wahana->name = $request->name;
        $wahana->description = $request->description;
        $wahana->icon = $request->icon;
        $wahana->color = $request->color;
        $wahana->is_new = $request->boolean('is_new'); // Mengambil nilai boolean dari checkbox
        $wahana->video_embed_url = $request->video_embed_url; // Tambahkan baris ini

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // Buat nama file unik untuk menghindari penimpaan dan masalah karakter
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                        $file->move(Wahana::getUploadPath(), $filename);
            // Simpan path relatif ke database
            $wahana->image = Wahana::getRelativePath($filename);
        }

        $wahana->save();

        return redirect()->route('admin.wahana.index')->with('success', 'Wahana berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wahana $wahana)
    {
        return view('admin.wahana.edit', compact('wahana'));
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
            'video_embed_url' => 'nullable|url|max:500', // Validasi untuk URL video

        ]);

        $wahana->name = $request->name;
        $wahana->description = $request->description;
        $wahana->icon = $request->icon;
        $wahana->color = $request->color;
        $wahana->is_new = $request->boolean('is_new'); // Mengupdate nilai boolean dari checkbox
        $wahana->video_embed_url = $request->video_embed_url;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
             if ($wahana->image && file_exists(Wahana::getUploadPath() . '/' . basename($wahana->image))) {
                unlink(Wahana::getUploadPath() . '/' . basename($wahana->image));
            }
            $file = $request->file('image');
            // Buat nama file unik
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(Wahana::getUploadPath(), $filename);

            // Simpan path relatif ke database
            $wahana->image = Wahana::getRelativePath($filename);
        } else {
            // Jika tidak ada file baru, jangan ubah field image
            // $wahana->image tetap berisi nilai lama
        }

        $wahana->save();

        return redirect()->route('admin.wahana.index')->with('success', 'Wahana berhasil diperbarui!');
    }

    // Metode destroy() bisa Anda tambahkan jika belum ada, sesuai file admin.wahanas.index.blade.php
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wahana $wahana)
    {
        // Hapus gambar terkait jika ada
        if ($wahana->image && file_exists(Wahana::getUploadPath() . '/' . basename($wahana->image))) {
            unlink(Wahana::getUploadPath() . '/' . basename($wahana->image));
        }

        $wahana->delete();

        return redirect()->route('admin.wahana.index')->with('success', 'Wahana berhasil dihapus!');
    }
}