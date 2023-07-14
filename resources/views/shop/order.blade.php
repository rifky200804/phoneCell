@extends('layouts.app')

@section('title',config('app.name')." | Checkout")
@section('content')
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Waiting for payment</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Packed</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">in Delivery</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-4">Finished</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="tab-pane-1">
                            <h4 class="mb-3">Waiting for payment</h4>
                            <table class="table table-light table-borderless table-hover text-center mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Products</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    @foreach ($waiting as $item => $value)
                                    <tr>
                                        <td class="align-middle"><img src="{{asset('layouts/img/product-1.jpg')}}" alt="" style="width: 50px;">{{$value->name_product}}</td>
                                        <td class="align-middle">Rp. {{number_format($value->price,2,',','.')}}</td>
                                        <td class="align-middle">{{$value->quantity}}</td>
                                        <td class="align-middle">{{number_format(($value->price * $value->quantity),2,',','.')}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Packed</h4>
                            <table class="table table-light table-borderless table-hover text-center mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Products</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    @foreach ($packed as $item => $value)
                                    <tr>
                                        <td class="align-middle"><img src="{{asset('layouts/img/product-1.jpg')}}" alt="" style="width: 50px;">{{$value->name_product}}</td>
                                        <td class="align-middle">Rp. {{number_format($value->price,2,',','.')}}</td>
                                        <td class="align-middle">{{$value->quantity}}</td>
                                        <td class="align-middle">{{number_format(($value->price * $value->quantity),2,',','.')}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="mb-4">In Delivery</h4>
                                    <table class="table table-light table-borderless table-hover text-center mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Products</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            @foreach ($delivery as $item => $value)
                                            <tr>
                                                <td class="align-middle"><img src="{{asset('layouts/img/product-1.jpg')}}" alt="" style="width: 50px;">{{$value->name_product}}</td>
                                                <td class="align-middle">Rp. {{number_format($value->price,2,',','.')}}</td>
                                                <td class="align-middle">{{$value->quantity}}</td>
                                                <td class="align-middle">{{number_format(($value->price * $value->quantity),2,',','.')}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="mb-4">Finished"</h4>
                                    <table class="table table-light table-borderless table-hover text-center mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Products</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            @foreach ($waiting as $item => $value)
                                            <tr>
                                                <td class="align-middle"><img src="{{asset('layouts/img/product-1.jpg')}}" alt="" style="width: 50px;">{{$value->name_product}}</td>
                                                <td class="align-middle">Rp. {{number_format($value->price,2,',','.')}}</td>
                                                <td class="align-middle">{{$value->quantity}}</td>
                                                <td class="align-middle">{{number_format(($value->price * $value->quantity),2,',','.')}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection