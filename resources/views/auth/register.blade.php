<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('login/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{asset('login/css/owl.carousel.min.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('login/css/bootstrap.min.css')}}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{asset('login/css/style.css')}}">

    <title>Register</title>
  </head>
  <body>
  
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    @include('sweetalert::alert')
  <div class="d-md-flex half">
    <div class="bg" style="background-image: url('{{asset('login/images/bg_1.jpg')}}');"></div>
    <div class="contents">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="form-block mx-auto">
              <div class="text-center mb-5">
              <h3>Register to <strong>PhoneCell</strong></h3>
              <!-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> -->
              </div>
              <form action="{{route('postRegister')}}" method="post">
                @csrf
                <div class="form-group first">
                  <label for="full_name">Full Name</label>
                  <input type="text" name="full_name" class="form-control" placeholder="Your Name" id="full_name">
                </div>
                <div class="form-group first">
                  <label for="email">Email</label>
                  <input type="text" name="email" class="form-control" placeholder="your-email@gmail.com" id="email">
                </div>
                <div class="form-group last mb-3">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" placeholder="Your Password" name="password" id="password">
                </div>
                
                <div class="d-sm-flex mb-5 align-items-center">
                  <label class="control control--checkbox mb-3 mb-sm-0"><span class="caption">Remember me</span>
                    <input type="checkbox" checked="checked"/>
                    <div class="control__indicator"></div>
                  </label>
                  <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
                </div>
                
                <button type="submit" class="btn btn-block btn-primary">Register</button>
              </form>
              <a href="{{route('login','user')}}" class="text-primary">
                already have an account
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    
  </div>
  <script src="{{asset('login/js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{asset('login/js/popper.min.js')}}"></script>
  <script src="{{asset('login/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('login/js/main.js')}}"></script>
  </body>
</html>