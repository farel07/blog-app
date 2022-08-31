@extends('layouts/main')

@section('content')

<h1 class="mb-5">{!! $header !!}</h1>


  <div class="row">
      <div class="col-md-8">
          <form action="/blog" method="get">
          <div class="input-group mb-3">
            {{-- @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif --}}
            @if (request('author'))
                <input type="hidden" name="author" value="{{ request('author') }}">
            @endif
              <input type="text" class="form-control" placeholder="Input keyword..." name="keyword" value="{{ request('keyword') }}">
              
              <select class="form-select form-select-sm" name="category">
                <option selected value="">Choose category...</option>
                @foreach ($categories as $category)

                @if ($category->slug == request('category'))

                <option selected value="{{ $category->slug }}">{{ $category->name }}</option>

                @else

                <option value="{{ $category->slug }}">{{ $category->name }}</option>

                @endif

                @endforeach
              </select>

              <button class="btn btn-outline-warning" type="submit" id="button-addon2">Search</button>
            </div>
          </form>
      </div>
  </div>

@if ($posts->count())
  

<div class="card mb-3">

  @if ($posts[0]->image)
  <div style="max-height: 400px; max-width: 1200px; overflow: hidden;">
    <img src="{{ asset('storage') . '/' . $posts[0]->image }}" class="card-img-top" alt="...">
  </div>
  @else
    <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="card-img-top" alt="...">
  @endif
    
    <div class="card-body text-center">
      <h5 class="card-title"><a class="text-decoration-none" href="/blog/{{ $posts[0]->slug }}">{{ $posts[0]->title }}</a></h5>
      <p class="card-text">{{ $posts[0]->excerpt }}</p>
      <p class="card-text"><small class="text-muted">By. <a class="text-decoration-none" href="/blog?author={{ $posts[0]->user->username }}">{{ $posts[0]->user->name }}</a> in <a class="text-decoration-none" href="/blog?category={{ $posts[0]->category->slug }}">{{ $posts[0]->category->name }}</a> {{ $posts[0]->created_at->diffForHumans() }}</small></p>
      <a class="text-decoration-none btn btn-warning" href="/blog/{{ $posts[0]->slug }}">Read more..</a>
    </div>
  </div>



<div class="container">
    <div class="row">
        @foreach ($posts->skip(1) as $post)
        <div class="col-md-4 mb-3">
            <div class="card">
              @if ($post->image)
              <div style="max-height: 500; max-width: 400; overflow: hidden;">
                <img src="{{ asset('storage') . '/' . $post->image }}" class="card-img-top" alt="...">
              </div>
              @else
                <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" class="card-img-top" alt="...">
              @endif
                <div class="card-body">
                  <h5 class="card-title"><a class="text-decoration-none" href="/blog/{{ $post->slug }}">{{ $post->title }}</a></h5>
                  <p class="card-text">{{ $post->excerpt }}</p>
                  <p class="card-text"><small class="text-muted">By. <a class="text-decoration-none" href="/blog?author={{ $post->user->username }}">{{ $post->user->name }}</a> in <a class="text-decoration-none" href="/blog?category={{ $post->category->slug }}">{{ $post->category->name }}</a> {{ $post->created_at->diffForHumans() }}</small></p>
                  <a href="/blog/{{ $post->slug }}" class="btn btn-warning">Read more</a>
                </div>
              </div>
        </div>        
        @endforeach
    </div>
</div>



@else
    
  <p>No post found.</p>

@endif

{{ $posts->links() }}

   
@endsection