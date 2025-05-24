<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use App\Models\PhotoCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Ensure you are extending the base Controller
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::with('photoCategory')->latest()->paginate(10);
        return view('admin.photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = PhotoCategory::orderBy('name')->get();
        return view('admin.photos.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo_category_id' => 'required|exists:photo_categories,id',
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Assumes you have a disk 'public_uploads' configured in filesystems.php
            // that points to public_path('uploads')
            $imagePath = $request->file('image')->store('gallery_photos', 'public_uploads');
        }

        Photo::create([
            'photo_category_id' => $request->photo_category_id,
            'title' => $request->title,
            'image_path' => $imagePath,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.photos.index')->with('success', 'Foto berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        $categories = PhotoCategory::orderBy('name')->get();
        return view('admin.photos.edit', compact('photo', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        $request->validate([
            'photo_category_id' => 'required|exists:photo_categories,id',
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        $dataToUpdate = $request->only(['photo_category_id', 'title', 'description']);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada dan gambar baru diupload
            if ($photo->image_path && Storage::disk('public_uploads')->exists($photo->image_path)) {
                Storage::disk('public_uploads')->delete($photo->image_path);
            }
            // Simpan gambar baru dan tambahkan path ke data yang akan diupdate
            $dataToUpdate['image_path'] = $request->file('image')->store('gallery_photos', 'public_uploads');
        } else {
            // Jika tidak ada gambar baru, pertahankan path gambar lama
            $dataToUpdate['image_path'] = $photo->image_path;
        }

        $photo->update($dataToUpdate);

        return redirect()->route('admin.photos.index')->with('success', 'Foto berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        if ($photo->image_path && Storage::disk('public_uploads')->exists($photo->image_path)) {
            Storage::disk('public_uploads')->delete($photo->image_path);
        }
        $photo->delete();
        return redirect()->route('admin.photos.index')->with('success', 'Foto berhasil dihapus.');
    }
}