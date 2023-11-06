@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-2">
        <div class="col-lg-13">
            <h1 class="mb-3">{{$lists->title}}</h1>
            <p>By. <a href="/list?author={{ $lists->author->username }}"
                class="text-decoration-none">{{ $lists->author->name }}</a>
                Genre : <a href="/list?category={{ $lists->category->slug }}">{{ $lists->category->name }}</a>
        </p>

    @if ($lists->image)
    <div style="max-height:350px; overflow:hidden">
        <img src="{{ asset('storage/' . $lists->image) }}" alt="{{ $lists->category->name }}" class="img-fluid">
    </div>
    @else
    <img src="https://source.unsplash.com/1200x400?{{ $lists->category->name }}" alt="{{ $lists->category->name }}" class="img-fluid">
    @endif




    <article class="my-3 fs-0.5">
        {!! $lists->body !!}
    </article>


    <a href="/dashboard/list" class="d-block mt-3">Back To List</a>
        </div>
    </div>
</div>
@endsection
