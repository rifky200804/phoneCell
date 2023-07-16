@extends('admin.layouts.app')

@section('title',config('app.name'). " | Order")
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded h-100 p-4">
        <h6>Data Order {{(isset($_GET['status'])) ? $_GET['status'] : 'waiting for payment' ;}}</h6>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr style="text-align: center">
                        <th scope="col">#</th>
                        <th scope="col">Name Customer</th>
                        <th scope="col">totalPrice</th>
                        <th scope="col">totalItems</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;    
                        $status = [
                            'waiting for payment',
                            'packed',
                            'in delivery',
                            'finished'
                        ];
                    @endphp
                    @foreach ($data as $item => $value)
                    <tr style="text-align: center">
                        <th scope="row">{{$no}}</th>
                        <td>{{$value->name_customer}}</td>
                        <td>{{$value->total_price}}</td>
                        <td>{{$value->total_product}}</td>
                        <td>
                            <form action="{{route('order.update')}}" method="post" >
                                @csrf
                                {{-- {{dd($status[0]['status'])}} --}}
                                <input type="hidden" name="processCode" value="{{$value->processCode}}">
                                @if($value->status != 'finished')
                                    @php $index = array_search($value->status, $status); @endphp
                                    <button type="submit" name="status" value="{{$status[$index+1]}}" class="btn btn-primary">Process to {{$status[$index+1]}}</button>  
                                @else
                                {{$value->status}}
                                @endif
                            </form>
                        </td>
                    </tr>
                    @php $no++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection