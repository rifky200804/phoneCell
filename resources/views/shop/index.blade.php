@extends('layouts.app')

@section('title',config('app.name')." | Shop")
@section('content')

@if(isset($_GET['brand']) &&$_GET['brand']!= '')
    @php
        // dd($dataBrand);
        $strBrand = implode(',',$checkedBrand);
    @endphp
@endif
 <!-- Shop Start -->
 <div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form method="GET">
                    @if(isset($_GET['categories']) && $_GET['categories'] != "")
                        <input type="hidden" name="categories" value="{{$_GET['categories']}}">
                    @endif
                    @if(isset($_GET['brand']) && $_GET['brand'] != "")
                        <input type="hidden" name="brand" value="{{$strBrand}}">
                    @endif
                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" name="price" value="0-1jt" class="custom-control-input" id="price-1" @if(isset($_GET['price']) && $_GET['price'] == '0-1jt') checked  @endif>
                        <label class="custom-control-label" for="price-1">Rp. 0 - Rp. 1.000.000,00</label>
                        <span class="badge border font-weight-normal">0-1jt</span>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" name="price" value="1jt-3jt" class="custom-control-input" id="price-2" @if(isset($_GET['price']) && $_GET['price'] == '1jt-3jt') checked  @endif>
                        <label class="custom-control-label" for="price-2">Rp. 1.000.000,00 - Rp. 3.000.000,00</label>
                        <span class="badge border font-weight-normal">1jt-3jt</span>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" name="price" value="3jt-5jt" class="custom-control-input" id="price-3" @if(isset($_GET['price']) && $_GET['price'] == '3jt-5jt') checked  @endif>
                        <label class="custom-control-label" for="price-3">Rp. 3.000.000,00 - Rp. 5.000.000,00</label>
                        <span class="badge border font-weight-normal">3jt-5jt</span>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" name="price" value="5jt-10jt" class="custom-control-input" id="price-4" @if(isset($_GET['price']) && $_GET['price'] == '5jt-10jt') checked  @endif>
                        <label class="custom-control-label" for="price-4">Rp. 5.000.000,00 - Rp. 10.000.000,00</label>
                        <span class="badge border font-weight-normal">5jt-10jt</span>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" name="price" value=">10jt" class="custom-control-input" id="price-5" @if(isset($_GET['price']) && $_GET['price'] == '>10jt') checked  @endif>
                        <label class="custom-control-label" for="price-5">> Rp.10.000.000,00</label>
                        <span class="badge border font-weight-normal">> 10jt</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
            <!-- Price End -->
            
            <!-- Color Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Brand</span></h5>
            <div class="bg-light p-4 mb-30">
                <form method="GET">
                    @if(isset($_GET['price']) && $_GET['price'] != "")
                        <input type="hidden" name="price" value="{{$_GET['price']}}">
                    @endif

                    @if(isset($_GET['categories']) && $_GET['categories'] != "")
                        <input type="hidden" name="categories" value="{{$_GET['categories']}}">
                    @endif
                    @foreach($brands as $item => $value)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" name="brand[]" @if(in_array($value->name,$checkedBrand)) checked @endif value="{{$value->name}}" id="{{$value->name}}_{{$value->id}}">
                        <label class="custom-control-label" for="{{$value->name}}_{{$value->id}}">{{$value->name}}</label>
                        <span class="badge border font-weight-normal">{{$value->name}}</span>
                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
            <!-- Color End -->

            <!-- Size Start -->

            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            {{-- <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                            <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button> --}}
                        </div>
                        <div class="ml-2">
                            <div class="btn-group ml-2">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{url('/shop?'."size=10")}} @if(isset($_GET['categories'])) {{'&categories='.$_GET['categories']}} @endif @if(isset($_GET['brand'])) {{'&brand='.$strBrand}} @endif @if(isset($_GET['price'])) {{'&price='.$_GET['price']}} @endif">10</a>
                                    <a class="dropdown-item" href="{{url('/shop?'."size=20")}} @if(isset($_GET['categories'])) {{'&categories='.$_GET['categories']}} @endif @if(isset($_GET['brand'])) {{'&brand='.$strBrand}} @endif @if(isset($_GET['price'])) {{'&price='.$_GET['price']}} @endif">20</a>
                                    <a class="dropdown-item" href="{{url('/shop?'."size=30")}} @if(isset($_GET['categories'])) {{'&categories='.$_GET['categories']}} @endif @if(isset($_GET['brand'])) {{'&brand='.$strBrand}} @endif @if(isset($_GET['price'])) {{'&price='.$_GET['price']}} @endif">30</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($data as $item => $value)
                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="@if(isset($value->foto)) {{asset('/images_product/'.$value->foto)}} @else {{asset('logo.jpg')}} @endif" alt="">
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
                                <h5>Rp. {{number_format($value->price,2,',','.')}}</h5><h6 class="text-muted ml-2"><del></del></h6>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-12">
                    <nav>
                      <ul class="pagination justify-content-center">
                        <li class="page-item @if($page == 1) disabled @endif">
                            <a class="page-link" href="/shop?page={{($page-1)}} @if(isset($_GET['categories'])) {{'&categories='.$_GET['categories']}} @endif @if(isset($_GET['brand'])) {{'&brand='.$strBrand}} @endif @if(isset($_GET['price'])) {{'&price='.$_GET['price']}} @endif">
                                <span>Previous</span>
                            </a>
                        </li>
                        @php
                            if($page > 5){
                                    $checkNumberPage = ceil($page / 5);
                                    $endPage = $checkNumberPage * 5;
                                    $startPage = $endPage - 4;
                                    $number = $startPage;
                                    if($totalPage < $endPage){
                                        $max = $totalPage;
                                    }else{
                                        $max = $endPage;    
                                    }
                                
                            }else{
                                $number = 1;
                                $max = 5; 
                                if($max > $totalPage){
                                    $max = $totalPage;
                                }
                            }
                        @endphp
                         @for($i = $number;$i <= $max;$i++)
                            
                         <li class="page-item @if($page==$i) active @endif">
                            <a class="page-link" href="/shop?page={{$i}} @if(isset($_GET['categories'])) {{'&categories='.$_GET['categories']}} @endif @if(isset($_GET['brand'])) {{'&brand='.$strBrand}} @endif @if(isset($_GET['price'])) {{'&price='.$_GET['price']}} @endif">{{$i}}
                            </a>
                        </li>

                         @endfor
                        <li class="page-item  @if($page >= $totalPage) disabled @endif">
                            <a class="page-link" href="'/shop?page={{($page+1)}} @if(isset($_GET['categories'])) {{'&categories='.$_GET['categories']}} @endif @if(isset($_GET['brand'])) {{'&brand='.$strBrand}} @endif @if(isset($_GET['price'])) {{'&price='.$_GET['price']}} @endif">
                                Next
                            </a>
                        </li>
                      </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
@endsection