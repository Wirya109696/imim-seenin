@extends('layouts.main')

@section('container')
<link rel="stylesheet" href="css/style.css">
    <h1>NONTON ANIME GRATIS</h1>
    <h3>{{ $name }}</h3>
    <p>{{ $email }}</p>
    <img src="img/{{ $image }}" alt="{{ $name }}" width="500">

    <script src="js/script.js"></script>
@endsection
