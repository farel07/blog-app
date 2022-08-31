@extends('dashboard/layouts/main')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Welcome, {{ auth()->user()->name }}</h1>
  </div>

  @error('profile')
          
  @enderror

  @error('name')
          <p class="text-danger">{{ $message }}</p>
  @enderror
  @error('email')
          <p class="text-danger">{{ $message }}</p>
  @enderror
  @error('username')
          <p class="text-danger">{{ $message }}</p>
  @enderror


  @if(session()->has('success'))

  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center">

  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {!! session('success') !!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

</div>

  @endif

  @if(session()->has('error'))

  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center">

  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {!! session('error') !!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

</div>

  @endif


  {{-- card profile --}}
  <div class="card position-relative top-50 start-50 translate-middle" style="width: 30rem">

    @if(auth()->user()->profile)
    <img style="width: 200px;" src="{{ asset('storage') . '/' . auth()->user()->profile }}" class="profile-pict rounded-circle border border-danger img-fluid rounded mx-auto d-block mt-3"  alt="...">       
    @else
    <img style="width: 200px;" src="{{ asset('storage/profile/profile.png') }}" class="rounded-circle border border-danger img-fluid rounded mx-auto d-block mt-3"  alt="...">
    @endif
    <a href="/dashboard/change_profile" class="text-decoration-none text-center" data-bs-toggle="modal" data-bs-target="#exampleModal" id="edit-picture-profile"><span data-feather="edit"></span> Change photo</a>

  
    <div class="card-body">
      <h5 class="card-title">My Profile <a class="text-decoration-none" id="edit-info" href="" data-bs-toggle="modal" data-bs-target="#exampleModal"><span data-feather="edit"></span></a></h5>
      <ul class="list-group">
        <li class="list-group-item"><span data-feather="mail"></span> Email : {{ auth()->user()->email }}</li>
        <li class="list-group-item"><span data-feather="user"></span> Username : {{ auth()->user()->username }}</li>
        <li class="list-group-item"><span data-feather="clock"></span> Created since : {{ auth()->user()->created_at->diffForHumans() }}</li>
      </ul>
    </div>
  </div>
  {{-- endcardprofile --}}





  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title form-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-update" action="dashboard/change_profile" method="post" enctype="multipart/form-data">
          @csrf

          <div class="edit-picture-profile">
          @if (auth()->user()->profile)
          <img src="{{ asset('storage' . '/' . auth()->user()->profile) }}" class="image-preview img-fluid mb-3 col-md-5 rounded mx-auto d-block">
          <button type="button" class="btn btn-danger mb-2 remove-img" onclick="remove_image()" style="">Remove</button>
          <input type="hidden" name="remove_profile" value="" id="remove_profile">
          @else
            <img src="{{ asset('storage/profile/profile.png') }}" class="image-preview profile-pict img-fluid mb-3 col-md-5 rounded mx-auto d-block">
          @endif
            

          <input class="form-control @error('profile') is-invalid @enderror mb-3" type="file" id="profile" name="profile">

        </div>

          <div class="edit-info" style="display: none;">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" name="name" class="form-control" id="name" value="{{ auth()->user()->name }}">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" value="{{ auth()->user()->username }}">
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Change <img class="emoji style-scope yt-formatted-string" data-emoji-id="UCAoy6rzhSf4ydcYjJw3WoVg/bFx9YY69IKiE_9EPvfeM8A4" src="https://yt3.ggpht.com/aYFvdU7tqshu2CUse_TB3C4feXSCYUE7FleeK64m7kwUAR0Bjpi0laTMD4ZTG3BtJ7smrp_2CQ=w24-h24-c-k-nd" alt="LSright"></button>
      </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        {{-- ijabo crop tool --}}
        <script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>
<script>

//   // function untuk image preview
//   function image_preview(){

// const image = document.querySelector('#profile');
// const image_preview = document.querySelector('.image-preview');
// // ubah style image menjadi block
// image_preview.style.display = 'block';

// const ofReader = new FileReader();
// ofReader.readAsDataURL(image.files[0]);

// ofReader.onload = function(oFREvent){
//   image_preview.src = oFREvent.target.result;
// }



function remove_image(){
  image_preview = document.querySelector('.image-preview');
  remove_profile = document.querySelector('#remove_profile');
  
  image_preview.src = 'http://127.0.0.1:8000/storage/profile/profile.png';
  remove_profile.value = 1;
}

// crop image
$('#profile').ijaboCropTool({

    processUrl:'{{ route("change_profile") }}',
    buttonsText:['SAVE','CANCEL'],
    withCSRF:['_token','{{ csrf_token() }}'],
    onSuccess:function(message, element, status){
        alert(message);
        document.location.href = 'http://127.0.0.1:8000/dashboard'
       },
    onError:function(message, element, status){
        alert('Maximum image size is 2mb');
       }

});

// edit info
$('#edit-info').on('click', function(){
    $('.form-update').attr('action', 'dashboard/edit_info');
    $('.edit-info').css('display', 'block')
    $('.edit-picture-profile').css('display', 'none ');
    $('.form-title').html('Edit Profile');
});
// edit profile
$('#edit-picture-profile').on('click', function(){
    $('.form-update').attr('action', 'dashboard/change_profile');
    $('.edit-info').css('display', 'none')
    $('.edit-picture-profile').css('display', 'block ');
    $('.form-title').html('Choose Profile Picture');
});

</script>
    
@endsection