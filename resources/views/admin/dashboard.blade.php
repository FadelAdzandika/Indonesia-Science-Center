@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-4">
  <h3 class="mb-4">Dashboard Admin</h3>
  
  <!-- Tombol untuk Menambah Event dan Kompetisi -->
  <div class="mb-4">
    <a href="{{ route('events.create') }}" class="btn btn-primary">Tambah Event</a>
    <a href="{{ route('competitions.create') }}" class="btn btn-primary">Tambah Kompetisi</a>
  </div>

  <h4>Daftar Event</h4>
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
          @if($event->image)
            <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" width="100">
          @else
            Tidak ada gambar
          @endif
        </td>
        <td>{{ $event->name }}</td>
        <td>{{ $event->date }}</td>
        <td>
          <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm">Edit</a>
          <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus event ini?')">Hapus</button>
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
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus kompetisi ini?')">Hapus</button>
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