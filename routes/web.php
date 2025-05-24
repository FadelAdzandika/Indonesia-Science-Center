<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\Admin\WahanaController; // Controller untuk publik
use App\Http\Controllers\Admin\PhotoCategoryController; // Tambahkan ini
use App\Http\Controllers\Admin\PhotoController; // Tambahkan ini untuk PhotoController
use App\Http\Controllers\PageController; // Tambahkan ini
use App\Models\Event;
use App\Models\Competition;
use App\Models\Wahana as WahanaModel; // Alias untuk menghindari konflik nama dengan controller
use App\Models\Photo as PhotoModel; // Tambahkan ini
use Illuminate\Support\Facades\Route;

// Mengubah 'route::get' menjadi 'Route::get' dan mengambil data untuk dashboard
Route::get('/', function () {
    $latestWahanas = WahanaModel::where('is_new', true)->latest()->take(4)->get(); // Wahana yang ditandai terbaru
    $allWahanas = WahanaModel::orderBy('name', 'asc')->get(); // Semua wahana, diurutkan berdasarkan nama
    $events = Event::latest()->take(2)->get(); // Ambil 2 event terbaru
    $competitions = Competition::latest()->take(2)->get(); // Ambil 2 kompetisi terbaru

    // Ambil beberapa foto terbaru dari semua kategori untuk teaser di dashboard
    $teaserPhotos = PhotoModel::with('photoCategory')->latest()->take(8)->get(); // Ambil 8 foto terbaru

    return view('dashboard', compact('latestWahanas', 'allWahanas', 'events', 'competitions', 'teaserPhotos'));
})->name('home');

// Login & Register
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Dashboard Admin (hanya untuk admin yang sudah login)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // menjadi admin.dashboard
    Route::resource('events', EventController::class); // Cukup 'events', karena sudah di dalam grup 'admin'
    Route::resource('competitions', CompetitionController::class); // Path ke controller ini mungkin App\Http\Controllers\Admin\CompetitionController
    Route::resource('wahanas', \App\Http\Controllers\Admin\WahanaController::class); // Pastikan path ke Admin WahanaController benar
    Route::resource('photos', PhotoController::class); // Tambahkan ini untuk manajemen foto
    Route::resource('photo-categories', PhotoCategoryController::class); // Untuk kategori galeri foto
});

Route::get('/wahana', [WahanaController::class, 'index'])->name('wahana.index'); // Menggunakan controller publik untuk daftar wahana

Route::get('/pesan-kunjungan', function () {
    return view('kunjungan.create'); // Pastikan file view 'kunjungan.create.blade.php' ada
})->name('kunjungan.create');

// Route untuk Science Camp
Route::get('/science-camp', [PageController::class, 'scienceCamp'])->name('science-camp.index');

// Route untuk halaman Program Sains
Route::get('/program-sains', [PageController::class, 'programSains'])->name('program-sains.index');

// Route untuk halaman Galeri Foto ISC Utama
Route::get('/galeri-foto-isc', [PageController::class, 'galleryIndex'])->name('gallery.isc.index');

// Rute publik untuk halaman daftar dan detail Event & Kompetisi
Route::resource('events', EventController::class)->only(['index', 'show']);
Route::resource('competitions', CompetitionController::class)->only(['index', 'show']);
