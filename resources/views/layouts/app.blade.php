<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <div class="content-wrapper container-fluid">

        @if (auth()->check() && auth()->user()->role == 'admin')
            @include('admin.layouts.sidebar')
        @else
            @include('user.layouts.sidebar')
        @endif

        <div class="main-content">

            @include('layouts.topbar')

            <div class="content-wrapper">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">

                        {{ session('success') }}

                        <button class="btn-close" data-bs-dismiss="alert">
                        </button>

                    </div>
                @endif

                @yield('content')

            </div>

        </div>

    </div>

    @include('layouts.footer')
    @stack('scripts')
</body>

</html>
