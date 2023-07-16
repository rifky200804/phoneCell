@extends('layouts.app')

@section('title',config('app.name'))
@section('content')
<div class="container-fluid mb-3">
    <div class="row px-xl-5">
        <div class="col-lg-12">
            <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#header-carousel" data-slide-to="0" class=""></li>
                    <li data-target="#header-carousel" data-slide-to="1" class="active"></li>
                    <li data-target="#header-carousel" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item position-relative" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="{{asset('welcome/handphone1.jpeg')}}" style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item position-relative active" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="{{asset('welcome/handphone2.jpeg')}}" style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item position-relative" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="{{asset('welcome/handphone3.jpeg')}}" style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- categories --}}
<div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
    <div class="row px-xl-5 pb-3">
        @foreach($categoryTotal as $item)
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="/shop?category={{$item->name_category}}">
                <div class="cat-item d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="@if(isset($item->foto)) {{asset('/images_product/'.$item->foto)}} @else {{asset('logo.jpg')}} @endif" alt="">
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
                    <img class="img-fluid w-100" src="@if(isset($value->foto)) {{asset('/images_product/'.$value->foto)}} @else {{asset('logo.jpg')}} @endif" alt="" width="100px" height="100px">
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
                        {{-- <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small>(99)</small> --}}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
{{-- end products --}}
@endsection