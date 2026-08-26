<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
    @yield('title', config('app.name', 'Property Portal'))
</title>

<meta name="description" content="@yield('meta_description', 'Find your perfect property with our property portal.')">
<link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">


@vite(['resources/css/app.css', 'resources/css/frontend/properties.css', 'resources/css/frontend/property-detail.css', 'resources/js/app.js', 'resources/js/main.js', 'resources/js/three.js', 'resources/js/animation.js', 'resources/css/frontend/main.css', 'resources/css/frontend/responsive.css', ''])

@stack('styles')
