@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <h3 class="mb-4">Login</h3>
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary w-100 mb-2">Login</button>
      </form>
      <div class="text-center mt-2">
        <span>Belum punya akun?</span>
        <a href="{{ route('register') }}" class="btn btn-link">Register</a>
      </div>
    </div>
  </div>
</div>
@endsection