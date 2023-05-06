@extends('admin.layouts.adminlte')
@section('title') Blog | Product List @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <div><h4>Product List</h4></div>
                </div>
                
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                            <form action="{{ route('admin.product.import') }}" class="mt-2 d-flex align-items-start justify-content-start" style="margin-left: 15px" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 d-inline-block">
                                <input id="file" type="file" class="form-control pt-1 @error('file') is-invalid @enderror" name="file" value="aa" autocomplete="file">
                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <button class="btn btn-warning text-white" style="margin: 0 5px;">Import</button>
                            </form>
                        <form class="mt-2 d-flex align-items-start justify-content-end" style="margin-left: 15px">
                            <div class="mb-3 d-inline-block">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $request->title }}" autocomplete="title">
                            </div>
                            <button name="search" id="search" class="btn btn-primary" style="margin:0px 5px"><i class="fas fa-search fa-fw"></i>Search</button>
                            <button name="export" class="btn btn-success">Export</button>
                        </form>
                    </div>
                  <table class="table" id="product-table">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">User Name</th>
                          <th scope="col">Title</th>
                          <th scope="col">Category Name</th>
                          <th scope="col">Price</th>
                          <th scope="col">Updated At</th>
                          <th scope="col" style="width:200px;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($products as $product)
                            <tr style="vertical-align: middle;">
                                <td>{{ $request->page? (request()->page - 1) * 10 + $loop->iteration : $loop->iteration }}</td>
                                <td>                               
                                    {{ $product->user?->name }}
                                </td>
                                <td>{{ $product['title'] }}</td>
                                <td>  
                                    @foreach ($product->categories as $category)
                                        <span class="badge bg-success">{{ $category->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $product['price'] }}</td>
                                <td>{{ $product['updated_at'] }}</td>
                                <td>       
                                    <div class="d-flex">
                                        <form class="deleteForm{{$product->id}}" style="margin-right: 10px;" action="{{ route('admin.product.destroy',$product->id) }}"  method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger del-btn" style="width:100px" data-id="{{ $product->id }}">
                                                <a href="javascript:;" class="d-block del-product-btn text-decoration-none text-white ">
                                                    <i class="fa-solid fa-trash" style="margin-right: 10px"></i>Delete
                                                </a>
                                            </button>
                                        </form>
                                        <div class="col2">
                                        <a class="btn btn-secondary d-block text-decoration-none text-white" style="width:100px;" href="{{ route('admin.product.show',$product->id) }}"><i class="fa-solid fa-circle-info" style="margin-right: 10px;"></i>Detail</a>
                                        </div>
                                    </div>                        
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="7">There is no record</td>
                            </tr>
                        @endforelse
                      </tbody>
                    </table>
                    {{ $products->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


