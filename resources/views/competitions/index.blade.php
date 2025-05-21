@extends('layouts.app')

@section('title', 'Daftar Kompetisi')

@section('content')
<div class="container py-4">
  <h3 class="mb-4">Daftar Kompetisi</h3>
  <a href="{{ route('competitions.create') }}" class="btn btn-primary mb-3">Tambah Kompetisi</a>
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
          @if($competition->image)
            <img src="{{ asset('storage/' . $competition->image) }}" alt="Competition Image" width="100">
          @else
            Tidak ada gambar
          @endif
        </td>
        <td>{{ $competition->name }}</td>
        <td>{{ $competition->date }}</td>
        <td>
          <a href="{{ route('competitions.edit', $competition) }}" class="btn btn-warning btn-sm">Edit</a>
          <form action="{{ route('competitions.destroy', $competition) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
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