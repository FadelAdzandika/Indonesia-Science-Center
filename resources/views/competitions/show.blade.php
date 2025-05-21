@extends('layouts.app')

@section('title', $competition->name)

@section('content')
<div class="container py-4">
  <h3 class="mb-4">{{ $competition->name }}</h3>
  @if($competition->image)
    <div class="mb-3">
      <img src="{{ asset('storage/' . $competition->image) }}" alt="Competition Image" class="img-fluid">
    </div>
  @endif
  <p><strong>Tanggal:</strong> {{ $competition->date }}</p>
  <a href="{{ route('competitions.index') }}" class="btn btn-secondary">Kembali ke Daftar Kompetisi</a>
</div>
@endsection