<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2">Phone</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Cell</span>
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for products">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-6 text-right">
            <p class="m-0">Customer Service</p>
            <h5 class="m-0">+012 345 6789</h5>
        </div>
    </div>
</div>
<!-- Topbar End -->

@php
    $categories = DB::table('categories')->get();
@endphp
<!-- Navbar Start -->
<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                <div class="navbar-nav w-100">
                    @foreach($categories as $item => $value)
                    <a href="{{url('/shop?categories='.$value->name)}}" class="nav-item nav-link">{{$value->name}}</a>
                    @endforeach
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                    <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{route('welcome')}}" class="nav-item nav-link @if(Request::url() == route('welcome')) active @endif">Home</a>
                        <a href="{{route('shop.index')}}" class="nav-item nav-link @if(Request::url() == route('shop.index')) active @endif">Shop</a>       
                        <a href="{{route('order')}}" class="nav-item nav-link @if(Request::url() == route('order')) active @endif">My Order</a>       
                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <a href="{{url('/cart')}}" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">
                                @if(isset(Auth::user()->id))
                                    @php
                                        $count = DB::table('carts')->where('user_id','=',Auth::user()->id)->count();
                                    @endphp
                                    {{$count}}
                                @else
                                    0
                                @endif
                            </span>
                        </a>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-user text-primary"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                @if (isset(Auth::user()->role))
                                <a class="dropdown-item" href="{{route('myProfile',Auth::user()->id)}}">My Profile</a>
                                <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                                @else
                                <a class="dropdown-item" href="{{url('/user/login')}}">Sign in</a>
                                <a class="dropdown-item" href="{{url('/register')}}">Sign up</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->