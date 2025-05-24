<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Competition;
use App\Models\Wahana;


class DashboardController extends Controller
{
    public function index()
    {
        $events = Event::latest()->take(5)->get();
        $competitions = Competition::latest()->take(5)->get();
        // Ambil wahana yang ditandai sebagai terbaru
        $latestWahanas = Wahana::where('is_new', true)->latest()->take(5)->get(); // Ambil 5 wahana terbaru yang is_new
        // Ambil wahana yang tidak ditandai sebagai terbaru (wahana lama)
        $oldWahanas = Wahana::where('is_new', false)->latest()->take(5)->get(); // Ambil 5 wahana lama

        return view('admin.dashboard', compact('events', 'competitions', 'latestWahanas', 'oldWahanas'));
    }
}