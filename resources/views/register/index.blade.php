@extends('layouts.main')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-4">
        
<main class="form-register w-100 m-auto">

    <h1 class="h3 mb-3 mt-3 fw-normal text-center">Please Register</h1>

    <form action="/register" method="post">

      @csrf
  
      <div class="form-floating">
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  placeholder="name" value="{{ old('name') }}">
        <label for="name">Name</label>
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-floating">
        <input type="text" class="form-control @error('username') is-invalid @enderror"" id="username" name="username" placeholder="username" value="{{ old('username') }}">
        <label for="username">Username</label>
        @error('username')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-floating">
        <input type="email" class="form-control @error('email') is-invalid @enderror"" name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}">
        <label for="email">Email address</label>
        @error('email')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-floating">
        <input type="password" class="form-control @error('password') is-invalid @enderror"" name="password" id="password" placeholder="Password">
        <label for="password">Password</label>
        @error('password')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <button class="w-100 btn btn-md btn-warning mt-3" type="submit">Register</button>
    </form>
    <small class="d-flex mt-2"><p>Already have account? <a href="/login">login now</a></p></small>
  </main>

</div>
</div>
    
@endsection