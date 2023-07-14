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
                            @foreach($processCodeWaiting as $data => $item)
                            {{-- {{dd($item->shipping)}} --}}
                            <table class="table table-light table-borderless table-hover text-center mb-4">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Products</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Shipping</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    <?php $quantity = 0 ?>
                                    <?php foreach($waiting as $waitingItem => $value) : ?>
                                    @if ($item->processCode == $value->processCode)
                                    <tr>
                                        <td class="align-middle"><img src="{{asset('layouts/img/product-1.jpg')}}" alt="" style="width: 50px;">{{$value->name_product}}</td>
                                        <td class="align-middle">Rp. {{number_format($value->price,2,',','.')}}</td>
                                        <td class="align-middle">{{$value->quantity}}</td>
                                        <td class="align-middle">Rp. {{number_format((($value->quantity * 30000)),2,',','.')}}</td>
                                        <td class="align-middle">{{number_format(($value->price * $value->quantity + ($value->quantity * 30000)),2,',','.')}}</td>
                                    </tr>
                                    <?php $quantity += $value->quantity ?>
                                    @endif
                                    <?php endforeach; ?>
                                </tbody>
                            {{-- {{dd($item->shipping)}} --}}

                                <tfoot class="">
                                    <tr>
                                        <th colspan="">Total</th>
                                        <th></th>
                                        <th>{{$quantity}}</th>
                                        <th>Rp. {{number_format($item->shipping,2,',','.')}}</th>
                                        <th>Rp. {{number_format(($item->subTotal + $item->shipping),2,',','.')}}</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <hr>
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Packed</h4>
                            @foreach($processCodePacked as $data => $item)
                            <table class="table table-light table-borderless table-hover text-center mb-4">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Products</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Shipping</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    <?php $quantity = 0 ?>
                                    <?php foreach($packed as $packedItem => $value) : ?>
                                    @if ($item->processCode == $value->processCode)
                                    <tr>
                                        <td class="align-middle"><img src="{{asset('layouts/img/product-1.jpg')}}" alt="" style="width: 50px;">{{$value->name_product}}</td>
                                        <td class="align-middle">Rp. {{number_format($value->price,2,',','.')}}</td>
                                        <td class="align-middle">{{$value->quantity}}</td>
                                        <td class="align-middle">Rp. {{number_format((($value->quantity * 30000)),2,',','.')}}</td>
                                        <td class="align-middle">{{number_format(($value->price * $value->quantity + ($value->quantity * 30000)),2,',','.')}}</td>
                                    </tr>
                                    <?php $quantity += $value->quantity ?>
                                    @endif
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot class="">
                                    <tr>
                                        <th colspan="">Total</th>
                                        <th></th>
                                        <th>{{$quantity}}</th>
                                        <th>Rp. {{number_format($item->subTotal,2,',','.')}}</th>
                                        <th>Rp. {{number_format(($item->subTotal + $item->shipping),2,',','.')}}</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <hr>
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="mb-3">In Delivery</h4>
                                    @foreach($processCodeDelivery as $data => $item)
                                    <table class="table table-light table-borderless table-hover text-center mb-4">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Products</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Shipping</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            <?php $quantity = 0 ?>
                                            <?php foreach($delivery as $deliveryItem => $value) : ?>
                                            <tr>
                                                <td class="align-middle"><img src="{{asset('layouts/img/product-1.jpg')}}" alt="" style="width: 50px;">{{$value->name_product}}</td>
                                                <td class="align-middle">Rp. {{number_format($value->price,2,',','.')}}</td>
                                                <td class="align-middle">{{$value->quantity}}</td>
                                                <td class="align-middle">Rp. {{number_format((($value->quantity * 30000)),2,',','.')}}</td>
                                                <td class="align-middle">{{number_format(($value->price * $value->quantity + ($value->quantity * 30000)),2,',','.')}}</td>
                                            </tr>
                                            <?php $quantity += $value->quantity ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot class="">
                                            <tr>
                                                <th colspan="">Total</th>
                                                <th></th>
                                                <th>{{$quantity}}</th>
                                                <th>Rp. {{number_format($item->shipping,2,',','.')}}</th>
                                                <th>Rp. {{number_format(($item->subTotal + $item->shipping),2,',','.')}}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="mb-4">Finished</h4>
                                    @foreach($processCodeFinished as $data => $item)
                                    <table class="table table-light table-borderless table-hover text-center mb-4">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Products</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Shipping</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            <?php $quantity = 0 ?>
                                            <?php foreach($finished as $finishedItem => $value) : ?>
                                            <tr>
                                                <td class="align-middle"><img src="{{asset('layouts/img/product-1.jpg')}}" alt="" style="width: 50px;">{{$value->name_product}}</td>
                                                <td class="align-middle">Rp. {{number_format($value->price,2,',','.')}}</td>
                                                <td class="align-middle">{{$value->quantity}}</td>
                                                <td class="align-middle">Rp. {{number_format((($value->quantity * 30000)),2,',','.')}}</td>
                                                <td class="align-middle">{{number_format(($value->price * $value->quantity + ($value->quantity * 30000)),2,',','.')}}</td>
                                            </tr>
                                            <?php $quantity += $value->quantity ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot class="">
                                            <tr>
                                                <th colspan="">Total</th>
                                                <th></th>
                                                <th>{{$quantity}}</th>
                                                <th>Rp. {{number_format($item->shipping,2,',','.')}}</th>
                                                <th>Rp. {{number_format(($item->subTotal + $item->shipping),2,',','.')}}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection