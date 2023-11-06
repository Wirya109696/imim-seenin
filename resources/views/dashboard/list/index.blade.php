@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">List Information</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
      </div>
      <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
        <svg class="bi"><use xlink:href="#calendar3"/></svg>
        This week
      </button>
    </div>
  </div>

  @if (session()->has('success'))
  <div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
  </div>
  @endif

  <div class="table-responsive small col-lg-8">
    <a href="/dashboard/list/create" class="btn btn-success">Create New List</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($lists as $list )
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $list->title }}</td>
          <td>{{ $list->category->name }}</td>
          <td>
            <a href="/dashboard/list/{{ $list->slug }}" class="badge bg-info"><svg class="bi"><use xlink:href="#eye"/></svg></a>
            <a href="/dashboard/list/{{ $list->slug }}/edit" class="badge bg-warning"><svg class="bi"><use xlink:href="#pencil-square"/></svg></a>
            <form action="/dashboard/list/{{ $list->slug }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="badge bg-danger border-0" onclick="return confirm('Anda Yakin Ingin Menghapus ?')"><svg class="bi"><use xlink:href="#trash"/></svg></button>
            </form>
          </td>

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection


