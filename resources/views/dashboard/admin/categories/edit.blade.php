@extends('dashboard/layouts/main')

@section('content')
    
    <div class="contanier mt-3">
        <div class="col-8">
            <form action="/dashboard/categories/{{ $category->id }}" class="form-modal" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="name" class="form-label">Category name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}">
                  </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" readonly id="slug" value="{{ $category->slug }}">
                </div>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update</button>        
            </form>
        </div>
    </div>

    <script>

    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function(){
        // fungsi fetch untuk megambil data dari ?
        fetch('/dashboard/categories/create_slug?name=' + name.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });

    </script>

@endsection
