@extends('admin.layouts.adminlte')
@section('title')Blog | Product Details @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h4>Product Details</h4>
                </div>                
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                        @if($product->images->isEmpty())                           
                            <img src="{{ asset('img/car1.jfif') }}" class="mb-4 rounded" width="500px"  alt="Product Image">
                        @else
                            @foreach ($product->images as $image)
                                <img src="{{ asset('img/products/'.$image->name) }}" class="mb-4 rounded"  width="500px" alt="Product Image">
                            @endforeach
                        @endif 
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-4">
                            @if($product->user->images()->exists())
                            <img src="{{ asset($product->user->images[0]->path) }}" alt="" width="60px" height="60px" class="img-circle elevation-2 mr-3">
                            @else
                            <img src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="" width="60px" height="60px" class="img-circle elevation-2 mr-3">
                            @endif
                            <h2>{{ $product->user->name }}</h2>
                        </div>
                        <h3 class="mb-3 d-block">{{ $product->title }}</h3>
                        <small class="mb-3 d-block"><h4>${{ $product->price }}</h4></small>
                        <div class="mb-3">
                            @foreach ($product->categories as $category)
                                <a href="#" class="btn btn-sm btn-success">{{ $category->name }}</a>
                            @endforeach
                        </div>
                        <p>{{ $product->description }}</p>
                        <p>{{ $product->description }}</p>
                        <a href="{{ route('admin.product.index') }}" class="btn btn-primary text-white text-decoration-none"><i class="fa-solid fa-arrow-left-long" style="margin-right:7px"></i>Back</a>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection