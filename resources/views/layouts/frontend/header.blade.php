<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>
    @yield('title', config('app.name', 'Property Portal'))
</title>

<meta
    name="description"
    content="@yield('meta_description', 'Find your perfect property with our property portal.')"
>

@vite([
    'resources/css/app.css',
    'resources/js/app.js'
])

@stack('styles')