<?php

namespace App\Http\Controllers;

use App\Models\Wahana as WahanaModel; // Menggunakan alias untuk model agar tidak konflik dengan nama class
use Illuminate\Http\Request;

class WahanaController extends Controller
{
    /**
     * Display a listing of the wahanas for the public.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua wahana, mungkin dengan paginasi jika banyak
        // Anda bisa menyesuaikan query ini sesuai kebutuhan, misalnya hanya wahana yang aktif
        // atau urutkan berdasarkan kriteria tertentu.
        $wahanas = WahanaModel::orderBy('name', 'asc')->paginate(12); // Contoh: 12 wahana per halaman

        // Kembalikan view untuk menampilkan daftar wahana ke publik
        // View ini sudah Anda miliki: resources/views/wahana/index.blade.php
        return view('wahana.index', compact('wahanas'));
    }
}