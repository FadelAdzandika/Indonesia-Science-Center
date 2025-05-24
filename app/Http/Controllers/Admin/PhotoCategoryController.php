<?php

namespace App\Http\Controllers\Admin; // Pastikan namespace ini benar

use App\Models\PhotoCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Pastikan Anda meng-extend Controller yang benar
use Illuminate\Support\Str;

class PhotoCategoryController extends Controller // Pastikan nama class ini benar
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = PhotoCategory::latest()->paginate(10);
        return view('admin.photocategories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.photocategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:photo_categories,name',
            'description' => 'nullable|string',
        ]);

        PhotoCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // Otomatis membuat slug
            'description' => $request->description,
        ]);

        return redirect()->route('admin.photo-categories.index')->with('success', 'Kategori foto berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PhotoCategory $photoCategory)
    {
        return view('admin.photocategories.edit', compact('photoCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PhotoCategory $photoCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:photo_categories,name,' . $photoCategory->id,
            'description' => 'nullable|string',
        ]);

        $photoCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // Update slug juga
            'description' => $request->description,
        ]);

        return redirect()->route('admin.photo-categories.index')->with('success', 'Kategori foto berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhotoCategory $photoCategory)
    {
        // Pertimbangkan untuk menghapus foto-foto terkait atau file-nya jika diperlukan
        $photoCategory->delete();
        return redirect()->route('admin.photo-categories.index')->with('success', 'Kategori foto berhasil dihapus.');
    }
}