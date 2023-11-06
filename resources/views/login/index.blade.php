@extends('layouts.main')

@section('container')
<div class="row justify-content-center">
    <div class="col-md-5">
        @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>
        @endif

        @if (session()->has('loginError'))
        <div class="alert alert-danger" role="alert">
            {{ session('loginError') }}
          </div>
        @endif

        <main class="form-signin w-100 m-auto">
            <h1 class="h3 mb-3 fw-normal text-center" style="font-family: Helvetica, sans-serif;"><b>Login IMIP-Info</b></h1>
            <form action="/login" method="post">
                @csrf
              <img class="mb-4" src="img/logo.png" alt="" >
              <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid
                @enderror" name="email" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                <label for="email">Email address</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
              </div>
              <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
              <p class="mt-2 mb-3 text-body-secondary text-center">&copy; 2023</p>
            </form>
            <small class="d-block text-center mt-0">
                Not Register Yet ? <a href="/register">Register Now !</a>
            </small>
          </main>
    </div>
</div>
@endsection
