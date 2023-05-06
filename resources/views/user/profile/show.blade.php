@extends('user.layouts.app')
@section('title') Blog | Profile @endsection
@section('content')
<div class="container" style="margin-top: 80px">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <img class="card-img-top" src="{{ asset('img/view.jpg') }}" class="img-fluid" alt="Card image cap">
                <div class="card-body">
                    @if($image == '')
                    <img style="margin-top: -70px;" width="100px" height="100px" class="user-profile-img rounded-circle mb-4  mx-auto d-block" src="{{ asset('img/user.png') }}" style="margin-right: 10px" alt="User Photo">
                    @else
                    <img style="margin-top: -70px;" width="100px" height="100px" class="user-profile-img rounded-circle mb-4  mx-auto d-block" src="{{ asset($image) }}" style="margin-right: 10px" alt="User Photo">
                    @endif
                    <h3 class="text-center text-capitalize">{{ $user->name }}</h3>
                    <p class="text-center text-black-50">{{ $user->email }}</p>
                    <p class="text-center text-black-50">{{ $user->phone }}</p>
                    <p class="text-center text-black-50">{{ $user->address }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('home') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left-long" style="margin-right:7px"></i>Back</a>
                        @if (Auth::id() == $user->id)
                            <a href="{{ route('profile.edit',$user->id) }}" class="btn btn-secondary"><i class="fa-solid fa-pen" style="margin-right: 10px"></i>Edit</a>   
                        @else
                            <a href="{{ route('profile.index',$user->id) }}" class="btn btn-secondary"><i class="fa-solid fa-circle-info" style="margin-right: 10px"></i>Details</a>   
                        @endif
                    </div>
                </div>
            </div>
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
@endpush