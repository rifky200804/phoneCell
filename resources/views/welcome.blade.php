@extends('layouts.app')

@section('title',config('app.name'))
@section('content')
{{-- categories --}}
<div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
    <div class="row px-xl-5 pb-3">
        @foreach($categoryTotal as $item)
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="">
                <div class="cat-item d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="{{asset('layouts/img/cat-2.jpg')}}" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>{{$item->name_category}}</h6>
                        <small class="text-body">{{$item->total_product}} Products</small>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
{{-- end categories --}}

{{-- products --}}
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">New Products</span></h2>
    <div class="row px-xl-5">
        @foreach($products as $item => $value)
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="{{asset('layouts/img/product-1.jpg')}}" alt="">
                    <div class="product-action">
                        <form action="{{url('/cart/'.$value->id)}}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-outline-dark btn-square">
                                <i class="fa fa-shopping-cart"></i>
                            </button>
                        </form>
                        <a class="btn btn-outline-dark btn-square" href="{{route('shop.show',$value->id)}}"><i class="fa fa-search"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">{{$value->name}}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>Rp. {{number_format($value->price,2,',','.');}}</h5><h6 class="text-muted ml-2"></h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small>(99)</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
{{-- end products --}}
@endsection