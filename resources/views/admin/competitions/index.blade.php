@extends('layouts.app') {{-- Atau layout admin Anda --}}

@section('title', 'Daftar Kompetisi (Admin)')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Kompetisi (Admin)</h1>
        <a href="{{ route('admin.competitions.create') }}" class="btn btn-primary">Tambah Kompetisi Baru</a>
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
                <th>Thumbnail</th>
                <th>Judul</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($competitions as $competition)
                <tr>
                    <td>{{ $competition->id }}</td>
                    <td>
                        @if($competition->thumbnail)
                            <img src="{{ asset('public/uploads/' . $competition->thumbnail) }}" alt="{{ $competition->title }}" width="100" style="object-fit: cover; height: 60px;">
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td>{{ $competition->title }}</td>
                    <td>{{ $competition->start_date ? $competition->start_date->format('d M Y') : '-' }}</td>
                    <td>{{ $competition->end_date ? $competition->end_date->format('d M Y') : '-' }}</td>
                    <td>
                        <a href="{{ route('admin.competitions.edit', $competition->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.competitions.destroy', $competition->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kompetisi ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada kompetisi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $competitions->links() }} {{-- Untuk pagination --}}
    </div>
</div>
@endsection