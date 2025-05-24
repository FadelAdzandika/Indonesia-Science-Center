<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhotoCategory; // Tambahkan ini
use App\Models\Photo;       // Tambahkan ini
use Illuminate\Support\Facades\File; // Import File facade

class PageController extends Controller
{
    public function scienceCamp()
    {
        $imagePath = public_path('images/science');
        $images = [];
        if (File::isDirectory($imagePath)) {
            $files = File::files($imagePath);
            foreach ($files as $file) {
                // Get only the filename and ensure it's a publicly accessible path
                $images[] = 'images/science/' . $file->getFilename();
            }
        }
        return view('science-camp.index', compact('images'));
    }

    public function programSains()
    {
        return view('program-sains.index'); // Assuming you have this view
    }

    public function galleryIndex()
    {
        // Ambil semua kategori beserta foto-fotonya (eager loading)
        // Urutkan berdasarkan nama kategori
        $categoriesWithPhotos = PhotoCategory::with(['photos' => function ($query) {
            $query->latest()->take(12); // Ambil 12 foto terbaru per kategori untuk tampilan awal, bisa disesuaikan
        }])->orderBy('name', 'asc')->get();
        return view('gallery.index', compact('categoriesWithPhotos'));
    }
}
