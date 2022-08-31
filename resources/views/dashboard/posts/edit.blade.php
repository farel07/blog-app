@extends('dashboard.layouts.main')

@section('content')


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" id="head">Update Post</h1>
  </div>

  <div class="col-md-8">

    <form method="post" action="/dashboard/posts/{{ $post->slug }}" enctype="multipart/form-data">
      @method('put')
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}">
          @error('title')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
        </div>

        <input type="hidden" name="oldImage" value="{{ $post->image }}">

        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $post->slug) }}">
          @error('content')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
        <select class="form-select" name="category_id">
            <option value="" selected>Choose category...</option>
            @foreach ($categories as $category)

            @if (old('category_id', $post->category_id) == $category->id)
                
            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>

            @else
            
            <option value="{{ $category->id }}">{{ $category->name }}</option>

            @endif

            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="image" class="form-label">Image</label>

          @if ($post->image)
            <img src="{{ asset('storage' . '/' . $post->image) }}" class="image-preview img-fluid mb-3 col-md-5 d-block">
            <input type="hidden" name="removeImage" value="" id="removeImage">
            <button type="button" class="btn btn-danger mb-3 remove-img" onclick="remove_image()" style="">Remove Image</button>
          @else  
            <img class="image-preview img-fluid mb-3 col-md-5">
          @endif
   
          <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="image_preview()">
          @error('image')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <input id="content" type="hidden" name="content" value="{{ old('content', $post->content) }}">
            @error('content')
              <p class="text-danger">{{ $message }}</p>
            @enderror
            <trix-editor input="content"></trix-editor>
        </div>

        <button type="submit" class="btn btn-primary mb-5">Update Post</button>
      </form>

  </div>

  <script>

    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function(){
        // fungsi fetch untuk megambil data dari ?
        fetch('/dashboard/posts/create_slug?title=' + title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });

    document.addEventListener('trix-file-accept', function(e){
      e.preventDefault();
    })

      // function untuk image preview
      function image_preview(){

      const image = document.querySelector('#image');
      const image_preview = document.querySelector('.image-preview');
      // ubah style image menjadi block
      image_preview.style.display = 'block';

      const ofReader = new FileReader();
      ofReader.readAsDataURL(image.files[0]);

      ofReader.onload = function(oFREvent){
        const buttonRemove = document.querySelector('.remove-img');
        image_preview.src = oFREvent.target.result;
        buttonRemove.style.display = 'none';
      }
      }

      function remove_image(){
        if(confirm('are you sure?')){
          const image_preview = document.querySelector('.image-preview');
          const removeImage = document.querySelector('#removeImage');

          image_preview.removeAttribute('src');
          removeImage.value = 1;
          
        }
      }

  </script>
    
@endsection