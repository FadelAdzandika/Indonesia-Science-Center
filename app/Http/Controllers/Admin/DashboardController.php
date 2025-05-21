<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Competition;


class DashboardController extends Controller
{
    public function index()
    {
        $events = Event::all();
        $competitions = Competition::all();
        return view('admin.dashboard', compact('events', 'competitions'));
    }
}