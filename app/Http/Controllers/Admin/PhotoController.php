<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use App\Models\PhotoCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Ensure you are extending the base Controller

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

        $dataToCreate = $request->only(['photo_category_id', 'title', 'description']);
        if ($request->hasFile('image')) {
             $file = $request->file('image');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            
            $file->move(Photo::getUploadPath(), $filename);
            $dataToCreate['image_path'] = Photo::getRelativePath($filename);
        } else {
            $dataToCreate['image_path'] = null; // Atau sesuai dengan default field Anda
        }

        Photo::create($dataToCreate);


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
            if ($photo->image_path && file_exists(Photo::getUploadPath() . '/' . basename($photo->image_path))) {
                unlink(Photo::getUploadPath() . '/' . basename($photo->image_path));
            }
            $file = $request->file('image');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(Photo::getUploadPath(), $filename);
            // $dataToUpdate['image_path'] = $photo->image_path; // Tidak perlu jika $request->only() tidak menyertakannya
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
        if ($photo->image_path && file_exists(Photo::getUploadPath() . '/' . basename($photo->image_path))) {
            unlink(Photo::getUploadPath() . '/' . basename($photo->image_path));
        }
        $photo->delete();
        return redirect()->route('admin.photos.index')->with('success', 'Foto berhasil dihapus.');
    }
}