@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                <h3> {{ $post->title }} </h3>
                <p class="mt-2">By: <a class="text-decoration-none" href="blog?author={{ $post->user->username }}">{{ $post->user->name }}</a> in <a class="text-decoration-none" href="/blog?category={{ $post->category->slug }}">{{ $post->category->name }}</a></p>

                @if ($post->image)
                <div style="max-height: 300px; max-width: 1200px; overflow: hidden;">
                    <img src="{{ asset('storage') . '/' . $post->image }}" class="card-img-top" alt="...">
                </div>
                @else
                <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="" class="img-fluid">
                @endif
                

                <article class="my-4">
                {!! $post->content !!}
                </article>

                <a class="mb-5 btn btn-warning" href="/blog">back</a>

                @if (auth()->user())
                    
                <form action="/blog/{{ $post->slug }}/comment" method="post">
                
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="hidden" name="slug" value="{{ $post->slug }}">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-chat-left-dots"></i></span>
                        <textarea class="form-control" name="body" aria-label="With textarea"></textarea>
                        
                    <button class="btn-primary">Send</button>
                    </div>

            
                </form>  
                
                @else

                <p class="font-monospace">Please login for add a comment...</p>

                @endif

                <h5 class="mt-3">Comment :</h5>

                
                @if (!$post->comment->all())

                <p>No comments yet.</p>
                    
                @else
  
                @foreach ($post->comment as $comment)
                    
                <div class="card mt-4">
                    <h5 class="card-header">{{ $comment->user->name }}</h5>
                    <div class="card-body">
                     
                      <p class="card-text fs-3">{{ $comment->body }}<p>

                        <div class="card-header">
                            <b>Replies :</b> 
                          </div>
                          
                        <div class="card">
                            <div class="card-body">
                        @foreach ($comment->ReplyComment as $reply_comment)

                              <p><b>{{ $reply_comment->user->name }}</b> : {{ $reply_comment->body }}</p>

                        @endforeach
                            </div>
                        </div>
                    </div>
                    <form action="/post/reply_comment/{{ $comment->id }}" method="post">
                
                        @csrf
                        <input type="hidden" name="slug" value="{{ $post->slug }}">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-chat-left-dots"></i></span>
                            <textarea class="form-control" name="body" aria-label="With textarea"></textarea>
                            
                        <button class="btn-primary">Send</button>
                        </div>
    
                
                    </form>  
                    
                  </div>

                @endforeach

                                  
                @endif
            
        </div>
    </div>
</div>

    
@endsection