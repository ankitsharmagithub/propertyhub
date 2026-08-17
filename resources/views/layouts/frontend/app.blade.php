<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    @include('layouts.frontend.header')

</head>

<body>

    @include('layouts.frontend.navbar')

    <main>

        @yield('content')

    </main>

    @include('layouts.frontend.footer')

    @stack('scripts')

</body>

</html>