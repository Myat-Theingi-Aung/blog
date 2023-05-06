@extends('admin.layouts.adminlte')
@section('title') Blog | Create Category @endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div><h4>Create Category</h4></div>
                    <a href="{{ route('admin.category.index') }}" class="btn btn-primary ml-auto d-block text-white text-decoration-none"><i class="fa-solid fa-arrow-left-long" style="margin-right:7px"></i>Back</a>
                  </div>

                <div class="card-body">
                    <form action="{{ route('admin.category.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input id="phone" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection