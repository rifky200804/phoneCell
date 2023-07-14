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
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact Us</span></h2>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
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
                    <div class="control-group">
                        <label for="">Upload Your Photo Profile</label>
                        <input type="file" class="form-control" name="date_of_birth" id="subject" aria-invalid="false">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div>
                        <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5 mb-5">
            <div class="bg-light p-30 mb-30">
                <img src="{{asset('user.jpg')}}" width="100%" height="100%" alt="">
                {{-- <iframe style="width: 100%; height: 250px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> --}}
            </div>
            {{-- <div class="bg-light p-30 mb-3">
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div> --}}
        </div>
    </div>
</div>
@endsection