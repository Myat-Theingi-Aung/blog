@extends('user.layouts.app')

@section('title') Blog | User Profile @endsection
@section('content')
<div class='top'></div>
<div class="container" style="margin-top: 70px">
    <div class="row mb-4 justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="align-items-center">
                        @if($user[0]->images[0]->name != null)
                        <img width="40px" height="40px" class="rounded-circle" style="margin-right: 10px" src="{{ asset($user[0]->images[0]->path) }}" alt="User Photo">
                        @else
                        <img width="40px" height="40px" class="rounded-circle" style="margin-right: 10px" src="{{ asset('img/user.png') }}" alt="User Photo">                                   
                        @endif
                        <span class="mb-0" style="font-size: 22px;font-weight:600;">{{ $user[0]->name }}</span>
                    </div>
                  <a href="{{ route('product.create') }}" class="btn btn-primary ml-auto d-block text-white text-decoration-none"><i class="fa-solid fa-plus" style="margin-right: 10px"></i>Create</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($products as $product)
        <div class="col-9">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-7 mt-2">
                            <div class="align-items-start">
                                <h3>{{ $product->title }}</h3>
                                <p class="" style="font-weight: bolder">$ {{ $product->price }}</p>
                                <p class="text-black-50 mb-4" style="height: 60px">{{ Str::words($product->description, 13) }}</p>
                            </div>
                            <div class="d-flex align-items-end">
                                <a href="{{ route('product.show',$product->id) }}" style="margin-right: 5px;" class="btn btn-primary ml-auto"><i class="fa-solid fa-circle-info" style="margin-right:3px"></i>See More</a>
                                @if($user[0]->id === Auth::id())
                                    <form class="" style="margin-right: 5px;" action="{{ route('product.destroy',$product->id) }}"  method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger"><i class="fa-solid fa-trash"  style="margin-right:3px"></i>Delete</button>
                                    </form>
                                    <a href="{{ route('product.edit',$product->id) }}" class="btn btn-secondary"><i class="fa-solid fa-pen"  style="margin-right:3px"></i>Edit</a>                            
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 mt-2">
                            @if($product->images->isEmpty())                           
                                <img src="{{ asset('img/car1.jfif') }}" class="mb-4 rounded" width="202px" height="200px"  alt="Product Image">
                            @else
                                @foreach ($product->images as $image)
                                    <img src="{{ asset('img/products/'.$image->name) }}" class="mb-4 rounded"  width="270px" height="200px" alt="Product Image">
                                @endforeach
                            @endif 
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        @endforeach
        
    </div>
    <div class='scrolltop'>
        <div class='scroll icon bounce'>
            <i class="fa-solid fa-arrow-up" aria-hidden="true"></i>
        </div>
    </div>
@endsection
@push('js')
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Sweet Alert 2 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50 ) {
                $('.scrolltop:hidden').stop(true, true).fadeIn();
            } else {
                $('.scrolltop').stop(true, true).fadeOut();
            }
        });
    $(function(){$(".scroll").click(function(){$("html,body").animate({scrollTop:$(".top").offset().top},"1000");return false})})
    </script>
@endpush