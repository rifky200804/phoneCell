@extends('admin.layouts.app')

@section('title',config('app.name')." | User")

@section('content')
<div class="container">
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-4">
            <h6>Edit Data User</h6>
            <form action="{{route('myProfile.update',$data->id)}}" method="post">
                @csrf
                @method('put')
                <div class="row mb-3">
                    <div class="col-4 col-md-4 col-sm-12 col-sm-12">
                        <label for="full_name">Full Name</label>
                    </div>
                    <div class="col-8 col-md-8 col-sm-12 col-sm-12">
                        <input type="text" name="full_name" id="full_name" class="form-control" value="{{$data->full_name}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 col-md-4 col-sm-12 col-sm-12">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-8 col-md-8 col-sm-12 col-sm-12">
                        <input type="email" name="email" id="email" class="form-control" value="{{$data->email}}">
                    </div>
                </div>
                {{-- <div class="row mb-3">
                    <div class="col-4 col-md-4 col-sm-12 col-sm-12">
                        <label for="email">Password</label>
                    </div>
                    <div class="col-8 col-md-8 col-sm-12 col-sm-12">
                        <input type="password" name="password" id="password" class="form-control" value="{{$data->full_name}}">
                    </div>
                </div> --}}
                <div class="row mb-3">
                    <div class="col-4 col-md-4 col-sm-12 col-sm-12">
                        <label for="">Role</label>
                    </div>
                    <div class="col-8 col-md-8 col-sm-12 col-sm-12">
                        <select class="form-select mb-3" aria-label="Default select example" name="role">
                            <option disabled>--Select Role--</option>
                            <option value="admin" @if($role == 'admin') selected @endif>Admin</option>
                            <option value="pelanggan"  @if($role == 'pelanggan') selected @endif>Pelanggan</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-6 col-sm-12 d-flex justify-content-start">
                        <a href="{{route('user.index')}}" class="btn btn-primary">Back</a>
                    </div>
                    <div class="col-6 col-md-6 col-sm-12 d-flex justify-content-end">
                        <button type="submit"  class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>    
        </div>
    </div>
</div>
@endsection