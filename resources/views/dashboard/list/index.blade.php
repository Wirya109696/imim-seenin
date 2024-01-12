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
    <div class="card-header">
        <a href="/dashboard/list/create" class="btn btn-dark">Create New List</a>
        {{-- <button onclick="exportData()">Export Data</button> --}}

        {{-- <form action="{{ url('/import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".xlsx, .xls">
            <button type="submit">Import Data</button>
        </form> --}}

        <script>

        </script>
        <a href="{{ route('export') }}" class="btn btn-success">Export</a>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Import
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
               <!-- Form untuk upload file -->
               <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                  @csrf
                  <div class="form-group">
                      <label for="file">Pilih File Excel</label>
                      <input type="file" name="file" class="form-control" required="required">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                  </div>
              </div>
            </form>
            </div>
          </div>
        </div>
    </div>

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

  <h2 class="ui header">Daftar List Info</h2>

@endsection

