@extends('user.layouts.app')

@section('title') Blog | Home @endsection
@section('content')
<div class="container" style="margin-top: 65px">
    @if($products->count() > 0)
        <div class="row mb-4">
            <div class="col-md-12">
                <form class="search-form">
                    <input type="text" id="title" placeholder="Search..." value="{{ $request->title }}" name="title" class="textbox">
                    <input title="Search" name="search" value="" id="search" type="submit" class="button">
                </form>
            </div>
        </div>
    @endif
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card hover-shadow">
                    <div class="card-body">
                        <div class="">
                            <a href="{{ route('profile.show',$product->user_id) }}" class="d-flex align-items-center text-decoration-none text-black">
                                @if($product->user_id == $product->user->id )
                                    @if($product->user->images()->exists())
                                    <img src="{{ asset($product->user->images[0]->path) }}" width="40px" height="40px" class="home-profile-img rounded-circle border" alt="User Photo">
                                    @else
                                    <img src="{{ asset('img/user.png') }}" width="40px" height="40px" class="home-profile-img rounded-circle border" alt="User Photo">
                                    @endif
                                @endif
                                <h4 class="mt-2 ms-2">{{ $product->user->name }}</h4>
                            </a>
                        </div>
                        <hr>
                        <h3>{{ $product->title }}</h3>
                        <p class="" style="font-weight: bolder">$ {{ $product->price }}</p>
                        
                        @if($product->images->isEmpty())                           
                            <img src="{{ asset('img/car1.jfif') }}" class="mb-4 rounded" width="382px" height="250px"  alt="Product Image">
                        @else
                            @foreach ($product->images as $image)
                                <img src="{{ asset('img/products/'.$image?->name) }}" class="mb-4 rounded"  width="382px" height="250px" alt="Product Image">
                            @endforeach
                        @endif 
                        <p class="text-black-50 mb-4" style="height: 50px">{{ Str::words($product->description, 13) }}</p>
                        <div class="d-flex justify-content-between">
                            @guest
                                <a href="{{ route('product.show',$product->id) }}" class="btn btn-primary ml-auto"><i class="fa-solid fa-circle-info" style="margin-right: 10px"></i>See More</a>
                            @else
                                <a href="{{ route('product.show',$product->id) }}" class="btn btn-primary ml-auto"><i class="fa-solid fa-circle-info" style="margin-right: 10px"></i>See More</a>
                                @can('update-product',$product)
                                    <div class="d-flex">
                                        <a href="{{ route('product.edit',$product->id) }}" class="btn btn-secondary" style="margin-right: 5px"><i class="fa-solid fa-pen" style="margin-right: 10px"></i>Edit</a>
                                        <form class="deleteForm{{$product->id}}" style="margin-right: 10px;" action="{{ route('product.destroy',$product->id) }}"  method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger del-btn" style="width:100px" data-id="{{ $product->id }}">
                                                <a href="javascript:;" class="d-block del-product-btn text-decoration-none text-white ">
                                                    <i class="fa-solid fa-trash" style="margin-right: 10px"></i>Delete
                                                </a>
                                            </button>
                                        </form>
                                    </div>
                                @endcan
                            @endguest
                        </div>
                    </div>
                </div>   
            </div>
        @endforeach
        <div class="d-flex justify-content-end">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
@push('js')
    <!-- Sweet Alert 2 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/user.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
