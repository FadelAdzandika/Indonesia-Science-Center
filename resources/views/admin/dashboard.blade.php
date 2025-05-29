@extends('layouts.app')

@section('title', 'Dashboard Admin')

@push('styles')
<style>
    .admin-dashboard .card-link {
        text-decoration: none;
        color: inherit;
        display: block;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .admin-dashboard .card-link:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .admin-dashboard .card-icon {
        font-size: 2.5rem; /* Ukuran ikon lebih besar */
        margin-bottom: 0.5rem;
    }
    .admin-dashboard .card-title {
        font-weight: 500;
    }
    .admin-dashboard .quick-actions .btn {
        margin-bottom: 0.5rem; /* Jarak antar tombol */
    }
    .admin-dashboard .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: #333;
        border-bottom: 2px solid #eee;
        padding-bottom: 0.5rem;
    }
    .admin-dashboard .stat-card {
        border-left: 4px solid var(--bs-primary); /* Aksen warna */
    }
</style>
@endpush

@section('content')
<div class="container py-5 admin-dashboard">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold">Admin Dashboard</h1>
            <p class="text-muted">Selamat datang kembali, {{ Auth::user()->name }}!</p>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-danger">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
  
  {{-- Bagian Manajemen Konten --}}
    <div class="mb-5">
        <h2 class="section-title">Manajemen Konten</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div class="col">
                <a href="{{ route('admin.wahana.index') }}" class="card card-link h-100 text-center shadow-sm border-0">
                    <div class="card-body">
                        <div class="card-icon text-primary"><i class="bi bi-bounding-box-circles"></i></div>
                        <h5 class="card-title">Kelola Wahana</h5>
                        <p class="card-text small text-muted">Tambah, edit, atau hapus data wahana.</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('admin.events.index') }}" class="card card-link h-100 text-center shadow-sm border-0">
                    <div class="card-body">
                        <div class="card-icon text-success"><i class="bi bi-calendar-event"></i></div>
                        <h5 class="card-title">Kelola Event</h5>
                        <p class="card-text small text-muted">Atur event dan kegiatan yang akan datang.</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('admin.competitions.index') }}" class="card card-link h-100 text-center shadow-sm border-0">
                    <div class="card-body">
                        <div class="card-icon text-warning"><i class="bi bi-trophy"></i></div>
                        <h5 class="card-title">Kelola Kompetisi</h5>
                        <p class="card-text small text-muted">Manajemen data kompetisi.</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('admin.photo-categories.index') }}" class="card card-link h-100 text-center shadow-sm border-0">
                    <div class="card-body">
                        <div class="card-icon text-info"><i class="bi bi-images"></i></div>
                        <h5 class="card-title">Kategori Galeri</h5>
                        <p class="card-text small text-muted">Kelola kategori untuk galeri foto.</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('admin.photos.index') }}" class="card card-link h-100 text-center shadow-sm border-0">
                    <div class="card-body">
                        <div class="card-icon text-secondary"><i class="bi bi-camera"></i></div>
                        <h5 class="card-title">Foto Galeri</h5>
                        <p class="card-text small text-muted">Upload dan kelola foto dalam galeri.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

  <h4 class="mt-5">Wahana Terbaru</h4>
  @if(isset($latestWahanas) && $latestWahanas->isNotEmpty())
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Gambar</th>
          <th>Nama Wahana</th>
          <th>Deskripsi Singkat</th>
          <th>Tanggal Dibuat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($latestWahanas as $wahana)
        <tr>
          <td>
            @if($wahana->image)
              <img src="{{ asset('public/uploads/' . $wahana->image) }}" alt="{{ $wahana->name }}" width="100" style="object-fit: cover; height: 60px;">
            @else
              <span class="text-muted">N/A</span>
            @endif
          </td>
          <td>{{ $wahana->name }}</td>
          <td>{{ Str::limit($wahana->description, 50) }}</td> {{-- Menampilkan 50 karakter pertama deskripsi --}}
          <td>{{ $wahana->created_at->format('d M Y H:i') }}</td>
          <td>
            <a href="{{ route('admin.wahana.edit', $wahana->id) }}" class="btn btn-warning btn-sm">Edit</a>
            {{-- Tombol hapus bisa ditambahkan jika diperlukan, tapi biasanya dari halaman manajemen utama --}}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p>Tidak ada wahana yang ditandai sebagai "terbaru" saat ini.</p>
  @endif

  <h4 class="mt-5">Wahana Lama</h4>
  @if(isset($oldWahanas) && $oldWahanas->isNotEmpty())
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Gambar</th>
          <th>Nama Wahana</th>
          <th>Deskripsi Singkat</th>
          <th>Tanggal Dibuat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($oldWahanas as $wahana)
        <tr>
          <td>
            @if($wahana->image)
              <img src="{{ asset('public/uploads/' . $wahana->image) }}" alt="{{ $wahana->name }}" width="100" style="object-fit: cover; height: 60px;">
            @else
              <span class="text-muted">N/A</span>
            @endif
          </td>
          <td>{{ $wahana->name }}</td>
          <td>{{ Str::limit($wahana->description, 50) }}</td>
          <td>{{ $wahana->created_at->format('d M Y H:i') }}</td>
          <td>
            <a href="{{ route('admin.wahana.edit', $wahana->id) }}" class="btn btn-warning btn-sm">Edit</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p>Tidak ada wahana lama (yang tidak ditandai terbaru) saat ini.</p>
  @endif

  <h4 class="mt-5">Daftar Event</h4>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Gambar</th>
        <th>Nama Event</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($events as $event)
      <tr>
        <td>
          @if($event->thumbnail)
            <img src="{{ asset('public/uploads/' . $event->thumbnail) }}" alt="Event Thumbnail" width="100">
          @else
            Tidak ada gambar
          @endif
        </td>
        <td>{{ $event->title }}</td>
        <td>{{ $event->event_date ? $event->event_date->format('d M Y') : '-' }}</td>
        <td>
          <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning btn-sm">Edit</a>
          <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus event ini?')">Hapus</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="4" class="text-center">Belum ada event.</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <h4 class="mt-5">Daftar Kompetisi</h4>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Gambar</th>
        <th>Nama Kompetisi</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($competitions as $competition)
      <tr>
        <td>
          @if($competition->thumbnail)
            <img src="{{ asset('public/uploads/' . $competition->thumbnail) }}" alt="Competition Thumbnail" width="100">
          @else
            Tidak ada gambar
          @endif
        </td>
        <td>{{ $competition->title }}</td>
        <td>{{ $competition->start_date ? $competition->start_date->format('d M Y') : ($competition->date ? $competition->date->format('d M Y') : '-') }}</td>
        <td>
          <a href="{{ route('admin.competitions.edit', $competition) }}" class="btn btn-warning btn-sm">Edit</a>
          <form action="{{ route('admin.competitions.destroy', $competition) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus kompetisi ini?')">Hapus</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="4" class="text-center">Belum ada kompetisi.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection