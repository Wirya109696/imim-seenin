@extends('layouts.main')

@section('container')
<h1 class="mb-2 text-center">{{ $title }}</h1>

<div class="row justify-content-center mb-0.7">
    <div class="col-md-6">
        <form action="/list">
            @if (request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            @if (request('author'))
            <input type="hidden" name="author" value="{{ request('author') }}">
            @endif
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}" aria-describedby="button-addon2">
                <button class="btn btn-dark" type="submit">Search</button>
              </div>
        </form>
    </div>
</div>

@if ($list->count())
<div class="card mb-3">
    @if ($list[0]->image)
    <div style="max-height:350px; overflow:hidden">
        <img src="{{ asset('storage/' . $list[0]->image) }}" alt="{{ $list[0]->category->name }}" class="img-fluid">
    </div>
    @else
    <img src="https://source.unsplash.com/1200x400?{{ $list[0]->category->name }}" class="card-img-top" alt="{{ $list[0]->category->name }}">
    @endif
    <div class="card-body text-center">
      <h3 class="card-title"><a href="/list/{{ $list[0]->slug}}" class="text-decoration-none text-dark">{{ $list[0]->title }}</a></h3>
      <p><small class="text-body-secondary">
        By. <a href="/list?author={{ $list[0]->author->username }}">{{ $list[0]->author->name }}</a>
         in <a href="/list?category={{ $list[0]->category->slug }}" class="text-decoration-none">{{ $list[0]->category->name }}</a>
         {{ $list[0]->created_at->diffForHumans() }}
      </small>
    </p>
      <p class="card-text">{{ $list[0]->excerpt }}</p>
      <a href="/list/{{ $list[0]->slug}}" class="text-decoration-none btn btn-outline-primary">Read Me ..</a>
    </div>
  </div>


<div class="container">
    <div class="row">

        @foreach ($list->skip(1) as $lists)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="position-absolute bg-dark\ px-3 py-2 text-white" style="background-color: rgba(
                    0, 0, 0, 0.5)"><a href="/list?category={{ $lists->category->slug }}" class="text-decoration-none text-white">{{ $lists->category->name }}</a></div>
                @if ($lists->image)
                    <img src="{{ asset('storage/' . $lists->image) }}" alt="{{ $lists->category->name }}" class="img-fluid">
                @else
                <img src="https://source.unsplash.com/500x400?{{ $lists->category->name }}" class="card-img-top" alt="{{ $lists->category->name }}">
                @endif
                <div class="card-body">
                  <h5 class="card-title"><a href="/list/{{ $lists->slug}}" class="text-decoration-none text-dark">{{ $lists->title }}</a></h5>
                  <p>
                    <small class="text-muted">
                    By. <a href="/list?author={{ $lists->author->username }}" class="text-decoration-none">{{ $lists->author->name }}</a>
                     {{ $lists->created_at->diffForHumans() }}
                  </small>
                </p>
                  <p class="card-text">{{$lists->excerpt}}</p>
                  <a href="/list/{{ $lists->slug}}" class="btn btn-primary">Read More ..</a>
                </div>
              </div>
        </div>
        @endforeach
    </div>
</div>
@else
<p class="text-center fs-4">No List Found.</p>
@endif

<div class="d-flex justify-content-end">
    {{ $list->links() }}
</div>


@endsection
