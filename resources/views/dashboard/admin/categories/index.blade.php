@extends('dashboard.layouts.main')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Manage Post Categories</h1>
  </div>

  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add new post category
  </button>

  @if ($errors->any())
  <div class="col-sm-4 mt-3">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

  @if(session()->has('success'))

  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center mt-3">

  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {!! session('success') !!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

</div>

@endif

<div class="col-md-8 mt-3">
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Category Name</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>

        @foreach ($categories as $category)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $category->name }}</td>
            <td>
                <a href="categories/{{ $category->id  }}/edit" id="edit"><span data-feather="edit-2"></span></a>
                <a href=""><span data-feather="trash-2"></span></a>
            </td>
          </tr>

        @endforeach
    </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new post category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/dashboard/categories" class="form-modal" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category name</label>
                <input type="text" name="name" class="form-control" id="name">
              </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" readonly id="slug">
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
                      
        </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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