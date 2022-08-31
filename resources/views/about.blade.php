@extends('layouts/main')

@section('content')

    <p>Halaman About</p>
    <p>Saya adalah {{ $name }}</p>
    <p>Email : {{ $email }}</p>

@endsection