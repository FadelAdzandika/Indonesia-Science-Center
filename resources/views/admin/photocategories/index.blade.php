@extends('layouts.app') {{-- Atau layout admin Anda jika berbeda --}}

@section('title', 'Kategori Galeri Foto')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Kategori Galeri Foto</h1>
        <a href="{{ route('admin.photo-categories.create') }}" class="btn btn-primary">Tambah Kategori Baru</a>
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
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Jumlah Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ Str::limit($category->description, 50) }}</td>
                    <td>{{ $category->photos_count ?? $category->photos->count() }}</td> {{-- Eager load photos_count for better performance --}}
                    <td>
                        <a href="{{ route('admin.photo-categories.edit', $category->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.photo-categories.destroy', $category->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Semua foto di dalamnya juga akan terhapus.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada kategori foto.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>
@endsection