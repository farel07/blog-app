@extends('layouts.main')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-4">
        
<main class="form-signin w-100 m-auto">

  @if (session()->has('success'))

  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
      
  @endif

  @if (session()->has('login_error'))

  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('login_error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
      
  @endif

    <h1 class="h3 mb-3 mt-3 fw-normal text-center">Please Login</h1>

    <form action="/login" method="post">

      @csrf
  
      <div class="form-floating">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}">
        <label for="floatingInput">Email address</label>
        @error('email')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
        @error('password')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <button class="w-100 btn btn-md btn-warning" type="submit">Login</button>
    </form>
    <small class="d-flex mt-2"><p>Don't have account? <a href="/register">register now</a></p></small>
  </main>

</div>
</div>
    
@endsection