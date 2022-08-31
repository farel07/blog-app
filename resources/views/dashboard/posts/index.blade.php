
@extends('dashboard.layouts.main')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" id="head">My Posts</h1>
  </div>

  <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create new post!</a>

  @if(session()->has('success'))

  <div class="col-md-6">

  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {!! session('success') !!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

</div>

  @endif

  <div class="row mb-4">

    @foreach ($posts as $post)
        
    <div class="col-md-8">
        
        <div class="card mt-2">
            <div class="card-header">
              {{ $post->title }}
              <a href="/dashboard/posts/{{ $post->slug }}">
                <span data-feather="eye" class="align-text-bottom"></span>
              </a>
            </div>
            <div class="card-body">
            
                <p>{{ $post->excerpt }}</p>
                <p class="blockquote-footer mt-3">{{ $post->category->name }}</cite></p>
             
            </div>
          </div>

    </div>

    @endforeach

  </div>
    
@endsection




