@extends('layouts/main')

@section('content')

<h3 class="mb-4">Category List:</h3>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form action="/blog" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Input keyword..." name="keyword">
                <button class="btn btn-outline-warning" type="submit" id="button-addon2">Search</button>
              </div>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        @foreach ($categories as $category)
        <div class="col-md-4 mb-3">
            <a href="/blog?category={{ $category->slug }}">
            <div class="card bg-dark text-white">
                <img src="https://source.unsplash.com/500x400?{{ $category->name }}" class="card-img" alt="{{ $category->name }}">
                <div class="card-img-overlay p-0">
                  <h5 class="card-title p-3 text-center" style="background-color:rgba(0, 0, 0, 0.7) ">{{ $category->name }}</h5>
                </div>
              </div>
            </a>
        </div>
        @endforeach
    </div>
</div>


    

    
@endsection