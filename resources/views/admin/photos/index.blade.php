@extends('layouts.app') {{-- Atau layout admin Anda --}}

@section('title', 'Manajemen Foto Galeri')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Manajemen Foto Galeri</h1>
        <a href="{{ route('admin.photos.create') }}" class="btn btn-primary">Tambah Foto Baru</a>
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
                <th>Pratinjau</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($photos as $photo)
                <tr>
                    <td>{{ $photo->id }}</td>
                    <td>
                        @if ($photo->image_path)
                            {{-- Sesuaikan path jika Anda menggunakan disk 'public' dan storage:link --}}
                            {{-- <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->title ?? 'Foto' }}" width="100" class="img-thumbnail"> --}}
                            <img src="{{ asset('uploads/' . $photo->image_path) }}" alt="{{ $photo->title ?? 'Foto' }}" width="100" class="img-thumbnail">
                        @else
                            <span class="text-muted">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td>{{ $photo->title ?? '-' }}</td>
                    <td>{{ $photo->photoCategory->name ?? 'Tidak Dikategorikan' }}</td>
                    <td>{{ Str::limit($photo->description, 50) }}</td>
                    <td>
                        <a href="{{ route('admin.photos.edit', $photo->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.photos.destroy', $photo->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada foto.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $photos->links() }}
    </div>
</div>
@endsection