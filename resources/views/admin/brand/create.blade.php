@extends('admin.layouts.app')

@section('title',config('app.name')." | Brand")

@section('content')
<div class="container">
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-4">
            <h6>Create Data Brand</h6>
            <form action="{{route('brand.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-4 col-md-4 col-sm-12 col-sm-12">
                        <label for="name">Name</label>
                    </div>
                    <div class="col-8 col-md-8 col-sm-12 col-sm-12">
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 col-md-4 col-sm-12 col-sm-12">
                        <label for="foto">foto</label>
                    </div>
                    <div class="col-8 col-md-8 col-sm-12 col-sm-12">
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-6 col-sm-12 d-flex justify-content-start">
                        <a href="{{route('brand.index')}}" class="btn btn-primary">Back</a>
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