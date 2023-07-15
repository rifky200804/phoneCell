@extends('layouts.app')

@section('tilte',config('app.name')." | My Profile")
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{route('welcome')}}">Home</a>
                <span class="breadcrumb-item active">My Profile</span>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">My Profile</span></h2>
    <div class="row px-xl-5">
        <div class="col-lg-12 mb-5">
            <div class="contact-form bg-light p-30">
                <div id="success"></div>
                <form action="{{route('myProfile.update',$data->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="control-group">
                        <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Your full_name" required="required" data-validation-required-message="Please enter your Full Name" value="{{$data->full_name}}">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="email" class="form-control" id="email" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email" value="{{$data->email}}" disabled>
                        <input type="hidden" name="email" value="{{$data->email}}">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="text" class="form-control" name="place_of_birth" id="subject" placeholder="Place Of Birth" required="required" data-validation-required-message="Please enter a subject" aria-invalid="false" value="{{$data->place_of_birth}}">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="date" class="form-control" name="date_of_birth" id="subject" required="required" data-validation-required-message="Please enter a subject" aria-invalid="false" value="{{$data->date_of_birth}}">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <textarea class="form-control" rows="8" name="address" id="address" placeholder="Your Address" required="required" data-validation-required-message="Please enter your Address">{{$data->address}}</textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                    {{-- <div class="control-group">
                        <label for="">Upload Your Photo Profile</label>
                        <input type="file" class="form-control" name="date_of_birth" id="subject" aria-invalid="false">
                        <p class="help-block text-danger"></p>
                    </div> --}}
                    <div>
                        <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection