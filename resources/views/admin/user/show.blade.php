@extends('admin.layouts.app')

@section('title',config('app.name')." | User")
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded h-100 p-4">

        <div class="row">
            <div class="col-4 col-4 col-md-4 col-xs-12">
                <label for="">Full Name</label>
            </div>
            <div class="col-8 col-md-8 col-xs-12">
                <h6 for="">: {{$data->full_name}}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-4 col-4 col-md-4 col-sm-12">
                <label for="">Email</label>
            </div>
            <div class="col-8 col-md-8 col-sm-12">
                <h6 for="">: {{$data->email}}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-4 col-4 col-md-4 col-sm-12">
                <label for="">Place Of Date</label>
            </div>
            <div class="col-8 col-md-8 col-sm-12">
                <h6 for="">: {{$data->place_of_date}}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-4 col-4 col-md-4 col-sm-12">
                <label for="">Birth Of Date</label>
            </div>
            <div class="col-8 col-md-8 col-sm-12">
                <h6 for="">: {{$data->birth_of_date}}</h6>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-4 col-4 col-md-4 col-sm-12">
                <label for="">Address</label>
            </div>
            <div class="col-8 col-md-8 col-sm-12">
                <h6 for="">: {{$data->address}}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-12 col-md-12 col-sm-12 d-flex justify-content-end">
                <a href="{{url('/admin/user?page=1&role='.$role)}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</div>

@endsection