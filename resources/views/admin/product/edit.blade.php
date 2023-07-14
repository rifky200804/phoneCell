@extends('admin.layouts.app')

@section('title',config('app.name')." | Product")

@section('content')
<div class="container">
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-4">
            <h6>Edit Data Product</h6>
            <form action="{{route('product.update',$user->id)}}" method="post">
                @csrf
                @method('put')
                <div class="row mb-3">
                    <div class="col-4 col-md-4 col-sm-12 col-sm-12">
                        <label for="name">Name Product</label>
                    </div>
                    <div class="col-8 col-md-8 col-sm-12 col-sm-12">
                        <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 col-md-4 col-sm-12 col-sm-12">
                        <label for="price">Price</label>
                    </div>
                    <div class="col-8 col-md-8 col-sm-12 col-sm-12">
                        <input type="number" name="price" id="price" class="form-control" value="{{$user->price}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 col-md-4 col-sm-12 col-sm-12">
                        <label for="stok">Stok</label>
                    </div>
                    <div class="col-8 col-md-8 col-sm-12 col-sm-12">
                        <input type="number" name="stok" id="stok" class="form-control" value="{{$user->stok}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 col-md-4 col-sm-12 col-sm-12">
                        <label for="description">Description</label>
                    </div>
                    <div class="col-8 col-md-8 col-sm-12 col-sm-12">
                        <input type="text" name="description" id="description" class="form-control" value="{{$user->description}}">
                    </div>
                </div>
                {{-- <div class="row mb-3">
                    <div class="col-4 col-md-4 col-sm-12 col-sm-12">
                        <label for="foto">Foto</label>
                    </div>
                    <div class="col-8 col-md-8 col-sm-12 col-sm-12">
                        <input type="file" name="foto" id="foto" class="form-control" value="{{$user->}}">
                    </div>
                </div> --}}
                <div class="row mb-3">
                    <div class="col-4 col-md-4 col-sm-12 col-sm-12">
                        <label for="brand_id">Brand</label>
                    </div>
                    <div class="col-8 col-md-8 col-sm-12 col-sm-12">
                        <select class="form-select mb-3" aria-label="Default select example" name="brand">
                            <option selected="" disabled="">--Select Brand--</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 col-md-4 col-sm-12 col-sm-12">
                        <label for="categories_id">Categories</label>
                    </div>
                    <div class="col-8 col-md-8 col-sm-12 col-sm-12">
                        <select class="form-select mb-3" aria-label="Default select example" name="category">
                            <option selected="" disabled="">--Select Category--</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-6 col-sm-12 d-flex justify-content-start">
                        <a href="{{route('product.index')}}" class="btn btn-primary">Back</a>
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