<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>{{ config('app.name') }}</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('admin/img/user.jpg') }}" alt=""
                    style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                <span>{{ Auth::user()->role }}</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-item nav-link @if (Request::url() == route('admin.dashboard')) active @endif"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle @if (Request::url() == route('user.index')) active @endif"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-user-alt me-2"></i>Data User</a>
                <div class="dropdown-menu bg-transparent border-0" data-bs-popper="none">
                    <a href="{{ url('/admin/user?role=admin') }}" class="dropdown-item">Admin</a>
                    <a href="{{ url('/admin/user?role=pelanggan') }}" class="dropdown-item">Pelanggan</a>
                </div>
                <a href="{{ route('product.index') }}"
                    class="nav-item nav-link @if (Request::url() == route('product.index')) active @endif"><i
                        class="fa fa-table me-2"></i>Product</a>
                <a href="{{ route('category.index') }}"
                    class="nav-item nav-link @if (Request::url() == route('category.index')) active @endif"><i
                        class="fa fa-table me-2 "></i>Category</a>
                <a href="{{ route('brand.index') }}"
                    class="nav-item nav-link @if (Request::url() == route('brand.index')) active @endif"><i
                        class="fa fa-table me-2 "></i>Brand</a>
                <a href="#" class="nav-link dropdown-toggle @if (Request::url() == route('order.index')) active @endif"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-laptop me-2"></i>Data Order</a>
                    <div class="dropdown-menu bg-transparent border-0" data-bs-popper="none">
                        <a href="{{ url('/admin/order?status=waiting for payment') }}" class="dropdown-item">Waiting For Payment</a>
                        <a href="{{ url('/admin/order?status=packed') }}" class="dropdown-item">Packed</a>
                        <a href="{{ url('/admin/order?status=in delivery') }}" class="dropdown-item">in delivery</a>
                        <a href="{{ url('/admin/order?status=finished') }}" class="dropdown-item">finished</a>
                    </div>
            </div>
            {{-- <a href="{{route('user.index')}}" class="nav-item nav-link @if (Request::url() == route('user.index')) active @endif"><i class="fa fa-user-alt me-2"></i>User</a> --}}
        </div>
    </nav>
</div>
