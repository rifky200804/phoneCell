@extends('layouts.app')

@section('title',config('app.name')." | Cart")
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{route('welcome')}}">Home</a>
                <a class="breadcrumb-item text-dark" href="{{route('shop.index')}}">Shop</a>
                <span class="breadcrumb-item active">Shopping Cart</span>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Save</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @php
                        $subTotal = 0;
                        $totalBarang = 0;
                    @endphp
                    @foreach ($data as $item => $value)
                    <tr>
                        <form action="{{route('cart.update',$value->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <td class="align-middle"><img src="@if(isset($value->foto)) {{asset('/images_product/'.$value->foto)}} @else {{asset('logo.jpg')}} @endif" alt="" style="width: 50px;">{{$value->name_product}}</td>
                        <td class="align-middle">Rp. {{number_format($value->price,2,',','.')}}</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" name="quantity" value="{{$value->quantity}}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        @php $totalPrice = ($value->price * $value->quantity); @endphp
                        <td class="align-middle">Rp. {{number_format(($totalPrice),2,',','.')}}</td>
                        <td class="align-middle"><button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-check"></i></button></td>
                        <td class="align-middle"><a class="btn btn-sm btn-danger" href="{{route('cart.destroy',$value->id)}}"><i class="fa fa-times"></i></a></td>
                        </form>
                    </tr>
                    @php $subTotal += $totalPrice; $totalBarang+=$value->quantity; @endphp

                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <form class="mb-30" action="">
                <div class="input-group">
                    <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Apply Coupon</button>
                    </div>
                </div>
            </form>
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6>Rp. {{number_format ($subTotal,2,',','.')}}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        @php $shipping = ($totalBarang * 30000);  @endphp
                        <h6 class="font-weight-medium">Rp. {{number_format ($shipping,2,',','.')}}</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        @php $total = $subTotal + $shipping; @endphp
                        <h5>Total</h5>
                        <h5>Rp. {{number_format($total,2,',','.')}}</h5>
                    </div>
                    <form action="{{route('checkout.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="shipping" value="{{$shipping}}">
                        <input type="hidden" name="subTotal" value="{{$subTotal}}">
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Procesed To Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  

@endsection