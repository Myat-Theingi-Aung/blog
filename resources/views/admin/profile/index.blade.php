@extends('admin.layouts.adminlte')
@section('title') Blog | User List @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header d-flex">
                    <div><h4>User List</h4></div>      
                    <a href="{{ route('admin.profile.create') }}" class="btn btn-primary ml-auto text-white text-decoration-none"><i class="fa-solid fa-plus" style="margin-right: 10px"></i>Create</a>                          
                </div>
                <div class="card-body">
                  <form action="" class="rgt d-flex align-items-start justify-content-end" style="float: right;">
                    <div class="mb-3 d-inline-block">
                      <input id="title" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $request->name }}" autocomplete="name">
                    </div>
                    <button id="search" class="btn btn-primary" style="margin-left: 5px"><i class="fas fa-search fa-fw"></i>Search</button>
                  </form> 
                    <table class="table" id="category-table">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Updated_at</th>
                            <th scope="col" style="width: 200px;">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($users as $user)
                          <tr class="user-row">
                            <td style="vertical-align: middle">{{ $request->page? (request()->page - 1) * 10 + $loop->iteration : $loop->iteration }}</td>
                            <td style="vertical-align: middle">{{ $user['name'] }}</td>
                            @if($user->images->count() > 0)
                              <td><img width="100px" class="rounded border" height="100px" src="{{ '../img/users/'.$user?->images[0]->name }}" alt="{{ $user->name }}"></td>
                            @else
                              <td><img src="{{ asset('img/user.png') }}" alt="User Photo" width="100px" height="100px"></td>
                            @endif
                            <td style="vertical-align: middle">{{ $user['email'] }}</td>
                            <td style="vertical-align: middle">{{ $user['phone'] }}</td>
                            <td style="vertical-align: middle">{{ $user['address'] }}</td>
                            <td style="vertical-align: middle">{{ $user['updated_at'] }}</td>
                            <td style="vertical-align: middle">
                              <div class="d-flex">
                                  <form class="deleteForm{{$user->id}}" style="margin-right: 10px;" action="{{ route('admin.profile.destroy',$user->id) }}"  method="post">
                                      @csrf
                                      @method('delete')
                                      <button class="btn btn-danger del-btn" style="width:100px" data-id="{{ $user->id }}">
                                        <a href="javascript:;" class="d-block del-user-btn text-decoration-none text-white ">
                                            <i class="fa-solid fa-trash" style="margin-right: 10px"></i>Delete
                                        </a>
                                    </button>
                                  </form>
                                  <div class="col2">
                                    <a class="btn btn-secondary d-block text-decoration-none text-white" style="width:100px" href="{{ route('admin.profile.edit',$user->id) }}"><i class="fa-solid fa-pen" style="margin-right: 10px"></i>Edit</a>
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
                      {{ $users->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection


