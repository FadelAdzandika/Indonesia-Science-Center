@extends('layouts.app') {{-- Atau layout admin Anda --}}

@section('title', 'Daftar Wahana (Admin)')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Wahana (Admin)</h1>
        <div>
            <a href="{{ route('admin.wahana.create') }}" class="btn btn-primary">Tambah Wahana Baru</a>
            {{-- <p class="text-muted small mt-1">Centang "Tandai sebagai Wahana Terbaru" pada form untuk menampilkannya di dashboard utama.</p> --}}
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Gambar</th>
                <th>Video</th>
                <th>Nama Wahana</th>
                <th>Status Terbaru</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($wahanas as $wahana)
                <tr>
                    <td>{{ $wahana->id }}</td>
                    <td>
                        @if($wahana->image)
                            <img src="{{ asset('storage/' . $wahana->image) }}" alt="{{ $wahana->name }}" width="100" style="object-fit: cover; height: 70px; border-radius: 4px;">
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td>
                        @if($wahana->video_embed_url)
                            <a href="{{ $wahana->video_embed_url }}" target="_blank" class="btn btn-sm btn-info" title="Lihat Video"><i class="bi bi-play-circle"></i></a>
                            {{-- Atau jika ingin langsung embed thumbnail kecil (hati-hati performa jika banyak video):
                            <div class="ratio ratio-16x9 mt-1" style="width: 100px;">
                                <iframe src="{{ $wahana->video_embed_url }}" title="Preview Video Wahana" frameborder="0" allowfullscreen></iframe>
                            </div>
                            --}}
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td>{{ $wahana->name }}</td>
                    <td>
                        @if($wahana->is_new)
                            <span class="badge bg-success">Ya</span>
                        @else
                            <span class="badge bg-secondary">Tidak</span>
                        @endif
                    </td>
                    <td>
                        {{-- <a href="{{ route('admin.wahana.show', $wahana->id) }}" class="btn btn-sm btn-info" title="Lihat"><i class="bi bi-eye"></i></a> --}}
                        <a href="{{ route('admin.wahana.edit', $wahana->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.wahana.destroy', $wahana->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus wahana ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada wahana.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $wahanas->links() }} {{-- Untuk pagination --}}
    </div>
</div>
@endsection