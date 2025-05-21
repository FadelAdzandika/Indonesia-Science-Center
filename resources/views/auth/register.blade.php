@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <h3 class="mb-4">Register</h3>

      {{-- Pesan Error --}}
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
          <label>Nama</label>
          <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Konfirmasi Password</label>
          <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button class="btn btn-success w-100">Register</button>
      </form>
    </div>
  </div>
</div>
@endsection