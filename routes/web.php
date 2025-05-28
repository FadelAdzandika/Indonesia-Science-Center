<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\EventController; // Ini akan jadi controller publik untuk Event
use App\Http\Controllers\Admin\EventController as AdminEventController; // Controller Admin untuk Event
use App\Http\Controllers\CompetitionController; // Ini akan jadi controller publik untuk Kompetisi
use App\Http\Controllers\Admin\CompetitionController as AdminCompetitionController; // Controller Admin untuk Kompetisi
use App\Http\Controllers\Admin\WahanaController as AdminWahanaController; // Mengganti nama alias untuk kejelasan, ini adalah controller Admin
use App\Http\Controllers\WahanaController; // Asumsikan ini adalah WahanaController untuk publik // Controller untuk publik
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
     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('events', AdminEventController::class);
    Route::resource('competitions', AdminCompetitionController::class);
    Route::resource('wahana', AdminWahanaController::class); // Ganti 'wahanas' jadi 'wahana' agar konsisten
    Route::resource('photos', PhotoController::class);
    Route::resource('photo-categories', PhotoCategoryController::class);
});
Route::get('/wahana', [WahanaController::class, 'index'])->name('wahana.index');
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
