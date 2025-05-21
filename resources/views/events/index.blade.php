@extends('layouts.app')

@section('title', 'Daftar Event')

@section('content')
<div class="container py-4">
  <h3 class="mb-4">Daftar Event</h3>
  <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Tambah Event</a>
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
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
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
</div>
@endsection