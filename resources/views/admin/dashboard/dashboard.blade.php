@extends('admin.layouts.adminlte')
@section('title') Blog | Admin Dashboard @endsection
@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3 class="counter-up">{{ $users }}</h3>

              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-user"></i>
            </div>
            <a href="{{ route('admin.profile.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3 class="counter-up">{{ $products }}</h3>

              <p>Total Products</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-box-open"></i>
            </div>
            <a href="{{ route('admin.product.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3 class="counter-up">{{ $categories }}</h3>

              <p>Total Categories</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-tags"></i>
            </div>
            <a href="{{ route('admin.category.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3 class="counter-up">{{ $images }}</h3>

              <p>Total Images</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-image"></i>
            </div>
            <a href="{{ route('admin.profile.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
</div>
@endsection
@push('js')
<script>
    $('.counter-up').counterUp({
        delay: 10,
        time: 1000,
    });
</script> 
@endpush