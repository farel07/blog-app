@extends('dashboard.layouts.main')

@section('content')

<div class="row">
    <div class="col-md-8">

        <div class="card my-3">
          @if ($post->image)

          <div style="max-height: 300px; overflow: hidden;">
          <img src="{{ asset('storage') . '/' . $post->image }}" class="card-img-top" alt="...">
          </div>
              
          @else

          <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="card-img-top" alt="...">

          @endif
            
            <div class="card-body">
              <h4 class="card-title">{{ $post->title }}</h4>
              <p class="card-text mt-3">{!! $post->content !!}</p>
              <p class="card-text"><small class="text-muted">{{  $post->created_at->diffForHumans() }} in <a href="/blog?category={{ $post->category->slug }}">{{ $post->category->name }}</a></small></p>
            </div>
          </div>

    </div>
    <div class="col-4">
        <div class="post-action my-3">
        <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left" class="align-text-bottom"></span> back</a><br>
        <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning mt-3"><span data-feather="edit-3" class="align-text-bottom"></span> edit</a><br>

          <form action="/dashboard/posts/{{ $post->slug }}" method="post">
            {{-- untuk menjalankan method destroy diperlukan request method delete --}}
            @method('delete')
            @csrf
            <button class="btn btn-danger mt-3 border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-octagon" class="align-text-bottom"></span></i> delete</button>
          </form>

    </div>
    </div>
</div>
    
@endsection