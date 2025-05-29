@extends('layouts.app')

@section('title', 'Daftar Event')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Daftar Event
        @if(request()->route()->getPrefix() === '/admin')
            (Admin)
        @endif
    </h3>
    @if(request()->route()->getPrefix() === '/admin')
      <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Tambah Event Baru</a>
    @endif
  </div>
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
        <td><a href="{{ route('admin.events.show', $event->id) }}">{{ $event->title }}</a></td>
        <td>{{ $event->event_date ? $event->event_date->format('d M Y') : '-' }}</td>
        <td class="text-nowrap">
          {{-- <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-info btn-sm">Lihat</a> --}}
          @if(request()->route()->getPrefix() === '/admin')
            <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
            </form>
          @endif
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="4" class="text-center">Belum ada event yang tersedia.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection