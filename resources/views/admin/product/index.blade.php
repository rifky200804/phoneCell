@extends('admin.layouts.app')

@section('title',config('app.name')." | User")
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-4">
            <h6>Data Product</h6>
            <a href="{{route('product.create')}}">Create Product</a>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr style="text-align: center">
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;    
                        @endphp
                        @foreach ($data as $item => $value)
                        <tr style="text-align: center">
                            <th scope="row">{{$no}}</th>
                            <td>{{$value->name}}</td>
                            <td>{{$value->name_category}}</td>
                            <td>{{$value->name_brand}}</td>
                            <td>
                                <a href="{{route('product.showAdmin',$value->id)}}" class="btn btn-info rounded-pill">Show</a>
                                <a href="{{route('product.edit',$value->id)}}" class="btn btn-warning rounded-pill">Edit</a>
                                <a href="{{route('product.destroy',$value->id)}}" class="btn btn-danger rounded-pill">Delete</a>
                            </td>
                        </tr>
                        @php $no++; @endphp
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-6 d-flex justify-content-start">
                        Page {{$page}} from {{$totalPage}} With {{$totalData}} Data
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        @if($page != 1)
                        <a href="{{url('/admin/product?page=1')}}" class="btn btn-secondary" style="margin-right:5px";><<</a>
                        <a href="{{url('/admin/product?page='.($page-1) )}}" class="btn btn-secondary" style="margin-right:5px";><</a>
                        @endif
                        <div class="btn-group me-2" role="group" aria-label="">
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
                            
                            <a href="{{url('/admin/product?page='.$i)}}" class="btn  @if($i == $page) btn-primary @else btn-secondary @endif">{{$i}}</a>

                            @endfor
                            @if($page != $totalPage)
                            <a href="{{url('/admin/product?page='.($page+1) )}}" class="btn btn-secondary" style="margin-left:5px";>></a>
                            <a href="{{url('/admin/product?page='.$totalPage)}}" class="btn btn-secondary" style="margin-left:5px";>>></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection