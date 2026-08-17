@extends('layouts.frontend.app')

@section('title', 'Find Your Perfect Property')

@section('meta_description', 'Discover properties for sale and rent across cities. Find homes, apartments, plots and commercial properties.')

@section('content')

{{-- =========================================================
     DESIGN SYSTEM — portal style (99acres / MagicBricks category)
     Brand blue #0B4DE0 · Signal orange #FF6B35 · Ink #12213D
     Type: Sora (display) + Inter (body) + IBM Plex Mono (prices/data)
     Photography via picsum.photos seeded placeholders — swap the
     `background-image:url(...)` values for real listing photos later.
     ========================================================= --}}

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@500;600;700;800&family=Inter:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">



<div class="pp-scope">

{{-- Trust utility bar --}}
<div class="pp-utility">
    <div class="container d-flex flex-wrap">
        <span class="item"><i class="bi bi-patch-check-fill"></i> RERA Registered</span>
        <span class="item"><i class="bi bi-house-heart-fill"></i> 10,000+ Verified Listings</span>
        <span class="item"><i class="bi bi-calendar-check-fill"></i> Free Site Visit</span>
        <span class="item d-none d-md-inline-flex"><i class="bi bi-telephone-fill"></i> 1800-123-4567</span>
    </div>
</div>

{{-- =========================================================
HERO + FLOATING SEARCH
========================================================= --}}

<section class="pp-hero">

    <div class="container position-relative">

        <div class="row">
            <div class="col-lg-8 pp-reveal">

                <h1 class="mb-3">
                    Find a place <span>you'll love</span><br>to call home.
                </h1>

                <p class="lead mb-0">
                    Explore verified properties for sale and rent across
                    your favorite cities — real photos, real prices, zero brokerage listings included.
                </p>

                <div class="pp-hero-badges">
                    <span><i class="bi bi-check-circle-fill"></i> No Broker Options</span>
                    <span><i class="bi bi-check-circle-fill"></i> Verified Owners</span>
                    <span><i class="bi bi-check-circle-fill"></i> EMI Calculator</span>
                </div>

            </div>
        </div>

    </div>

</section>

<div class="container pp-search-wrap pp-reveal" style="transition-delay:.1s;">

    <div class="pp-search">

        <div class="pp-tabs">
            <button type="button" class="pp-tab active">Buy</button>
            <button type="button" class="pp-tab">Rent</button>
            <button type="button" class="pp-tab">PG / Co-living</button>
            <button type="button" class="pp-tab">Commercial</button>
        </div>

        <form action="#" method="GET">

            <div class="row g-2 align-items-stretch">

                <div class="col-md-3">
                    <select name="property_type" class="form-select h-100">
                        <option value="">Property Type</option>
                        <option value="residential">Residential</option>
                        <option value="commercial">Commercial</option>
                        <option value="plot">Plot / Land</option>
                    </select>
                </div>

                <div class="col-md-5">
                    <input type="text" name="location" class="form-control h-100" placeholder="Search city, locality or project">
                </div>

                <div class="col-md-2">
                    <select name="budget" class="form-select h-100">
                        <option value="">Budget</option>
                        <option value="0-50">Under ₹50L</option>
                        <option value="50-100">₹50L – ₹1Cr</option>
                        <option value="100+">Above ₹1Cr</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="pp-search-btn h-100">
                        <i class="bi bi-search me-1"></i> Search
                    </button>
                </div>

            </div>

        </form>

    </div>

</div>

{{-- =========================================================
FEATURED PROPERTIES
========================================================= --}}

<section class="py-5 py-md-6 mt-4">

    <div class="container">

        <div class="d-flex justify-content-between align-items-end mb-4 pp-reveal pp-section-head">
            <div>
                <span class="pp-eyebrow">Featured</span>
                <h2 class="mt-2 mb-1">Featured Properties</h2>
                <p class="mb-0">Hand-picked listings, verified and ready to view.</p>
            </div>
            <a href="#" class="pp-btn-ghost d-none d-md-inline-block">View All</a>
        </div>

        <div class="row g-4">

            @php
                $featuredSeeds = ['prop-a','prop-b','prop-c','prop-d'];
            @endphp

            @for($i = 1; $i <= 4; $i++)

                <div class="col-md-6 col-lg-3 pp-reveal" style="transition-delay:{{ $i * 0.06 }}s;">

                    <div class="pp-card">

                        <div class="pp-card-media">
                            <img src="https://picsum.photos/seed/{{ $featuredSeeds[$i-1] }}/500/360" alt="Modern property" loading="lazy">
                            <span class="pp-tag pp-tag-sale">For Sale</span>
                            <span class="pp-fav"><i class="bi bi-heart-fill"></i></span>
                        </div>

                        <div class="pp-card-body">

                            <div class="d-flex justify-content-between align-items-start">
                                <h6 class="pp-price pp-mono mb-0">₹45,00,000</h6>
                                <span class="pp-verified"><i class="bi bi-patch-check-fill"></i> Verified</span>
                            </div>

                            <h5 class="fw-bold mt-2 mb-0" style="font-size:1rem;">Modern Property</h5>
                            <p class="text-muted small mb-0"><i class="bi bi-geo-alt"></i> Ghaziabad, Uttar Pradesh</p>

                            <div class="pp-meta">
                                <span><i class="bi bi-house-door"></i>3 BHK</span>
                                <span><i class="bi bi-rulers"></i>1450 sq.ft</span>
                            </div>

                            <div class="pp-agent">
                                <img src="https://picsum.photos/seed/agent{{ $i }}/60/60" alt="">
                                <span>Listed by Owner</span>
                            </div>

                        </div>
                    </div>

                </div>

            @endfor

        </div>

    </div>

</section>

{{-- =========================================================
PROPERTY CATEGORIES
========================================================= --}}

<section class="py-5 py-md-6">

    <div class="container">

        <div class="text-center mb-5 pp-reveal pp-section-head">
            <span class="pp-eyebrow">Explore</span>
            <h2 class="mt-2">Browse by Property Type</h2>
            <p>Find the right property for your needs.</p>
        </div>

        <div class="row g-4">

            @php
                $propertyCategories = [
                    ['title' => 'Apartments', 'icon' => 'bi-building', 'count' => '2,400+ listings', 'seed' => 'cat-apartments'],
                    ['title' => 'Independent Houses', 'icon' => 'bi-house-door', 'count' => '980+ listings', 'seed' => 'cat-houses'],
                    ['title' => 'Plots & Land', 'icon' => 'bi-map', 'count' => '640+ listings', 'seed' => 'cat-plots'],
                    ['title' => 'Commercial', 'icon' => 'bi-shop', 'count' => '310+ listings', 'seed' => 'cat-commercial'],
                ];
            @endphp

            @foreach($propertyCategories as $k => $category)

                <div class="col-6 col-lg-3 pp-reveal" style="transition-delay:{{ $k * 0.06 }}s;">

                    <a href="#" class="text-decoration-none">
                        <div class="pp-cat">
                            <img src="https://picsum.photos/seed/{{ $category['seed'] }}/420/320" alt="{{ $category['title'] }}" loading="lazy">
                            <div class="pp-cat-icon"><i class="bi {{ $category['icon'] }}"></i></div>
                            <div>
                                <h5>{{ $category['title'] }}</h5>
                                <small>{{ $category['count'] }}</small>
                            </div>
                        </div>
                    </a>

                </div>

            @endforeach

        </div>

    </div>

</section>

{{-- =========================================================
POPULAR CITIES
========================================================= --}}

<section class="py-5 py-md-6">

    <div class="container">

        <div class="mb-4 pp-reveal pp-section-head">
            <span class="pp-eyebrow">Locations</span>
            <h2 class="mt-2">Popular Cities</h2>
            <p>Explore properties in popular locations.</p>
        </div>

        <div class="row g-4">

            @php
                $cities = [
                    ['name' => 'Delhi', 'count' => '3,200+', 'seed' => 'city-delhi'],
                    ['name' => 'Noida', 'count' => '1,850+', 'seed' => 'city-noida'],
                    ['name' => 'Ghaziabad', 'count' => '1,410+', 'seed' => 'city-ghaziabad'],
                    ['name' => 'Gurugram', 'count' => '2,050+', 'seed' => 'city-gurugram'],
                    ['name' => 'Lucknow', 'count' => '920+', 'seed' => 'city-lucknow'],
                    ['name' => 'Jaipur', 'count' => '760+', 'seed' => 'city-jaipur'],
                ];
            @endphp

            @foreach($cities as $k => $city)

                <div class="col-6 col-md-4 col-lg-2 pp-reveal" style="transition-delay:{{ $k * 0.05 }}s;">

                    <a href="#" class="text-decoration-none">
                        <div class="pp-city">
                            <img src="https://picsum.photos/seed/{{ $city['seed'] }}/300/260" alt="{{ $city['name'] }}" loading="lazy">
                            <h6>{{ $city['name'] }}</h6>
                            <small>{{ $city['count'] }} properties</small>
                        </div>
                    </a>

                </div>

            @endforeach

        </div>

    </div>

</section>

{{-- =========================================================
LATEST PROPERTIES
========================================================= --}}

<section class="py-5 py-md-6">

    <div class="container">

        <div class="d-flex justify-content-between align-items-end mb-4 pp-reveal pp-section-head">
            <div>
                <span class="pp-eyebrow">New Listings</span>
                <h2 class="mt-2 mb-1">Latest Properties</h2>
                <p class="mb-0">Recently added, first come first served.</p>
            </div>
            <a href="#" class="pp-btn-ghost d-none d-md-inline-block">View All</a>
        </div>

        <div class="row g-4">

            @php
                $latestSeeds = ['latest-a','latest-b','latest-c'];
            @endphp

            @for($i = 1; $i <= 3; $i++)

                <div class="col-md-6 col-lg-4 pp-reveal" style="transition-delay:{{ $i * 0.07 }}s;">

                    <div class="pp-card">

                        <div class="pp-card-media" style="height:230px;">
                            <img src="https://picsum.photos/seed/{{ $latestSeeds[$i-1] }}/560/400" alt="Premium Family Home" loading="lazy">
                            <span class="pp-tag pp-tag-new">New</span>
                            <span class="pp-fav"><i class="bi bi-heart-fill"></i></span>
                        </div>

                        <div class="pp-card-body">

                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="pp-price pp-mono mb-0">₹68,00,000</h6>
                                <span class="text-muted small">2 days ago</span>
                            </div>

                            <h5 class="fw-bold mt-2 mb-0" style="font-size:1rem;">Premium Family Home</h5>
                            <p class="text-muted small mb-0"><i class="bi bi-geo-alt"></i> Noida, Uttar Pradesh</p>

                            <div class="pp-meta">
                                <span><i class="bi bi-house"></i>3 Beds</span>
                                <span><i class="bi bi-droplet"></i>2 Baths</span>
                                <span><i class="bi bi-rulers"></i>1500 sq.ft</span>
                            </div>

                        </div>
                    </div>

                </div>

            @endfor

        </div>

    </div>

</section>

{{-- =========================================================
WHY CHOOSE US
========================================================= --}}

<section class="py-5 py-md-6">

    <div class="container">

        <div class="text-center mb-5 pp-reveal pp-section-head">
            <span class="pp-eyebrow">Why Us</span>
            <h2 class="mt-2">Why Choose Our Property Portal?</h2>
        </div>

        <div class="row g-4">

            @php
                $benefits = [
                    ['icon' => 'bi-shield-check', 'title' => 'Verified Listings', 'text' => 'Every listing checked for accuracy before it goes live.', 'cls' => 'pp-ic-1'],
                    ['icon' => 'bi-search', 'title' => 'Easy Property Search', 'text' => 'Filter by location, budget and property type in seconds.', 'cls' => 'pp-ic-2'],
                    ['icon' => 'bi-people', 'title' => 'Direct Connection', 'text' => 'Talk to owners directly — no hidden brokerage fees.', 'cls' => 'pp-ic-3'],
                    ['icon' => 'bi-calculator', 'title' => 'Free EMI Calculator', 'text' => 'Plan your budget before you fall in love with a place.', 'cls' => 'pp-ic-4'],
                ];
            @endphp

            @foreach($benefits as $k => $b)

                <div class="col-md-6 col-lg-3 pp-reveal" style="transition-delay:{{ $k * 0.08 }}s;">
                    <div class="pp-benefit">
                        <div class="pp-benefit-icon {{ $b['cls'] }}"><i class="bi {{ $b['icon'] }}"></i></div>
                        <h5 class="fw-bold" style="font-size:1.02rem;">{{ $b['title'] }}</h5>
                        <p class="text-muted small mb-0">{{ $b['text'] }}</p>
                    </div>
                </div>

            @endforeach

        </div>

    </div>

</section>

{{-- =========================================================
TESTIMONIALS
========================================================= --}}

<section class="py-5 py-md-6">

    <div class="container">

        <div class="text-center mb-5 pp-reveal pp-section-head">
            <span class="pp-eyebrow">Testimonials</span>
            <h2 class="mt-2">What Our Customers Say</h2>
        </div>

        <div class="row g-4">

            @php
                $testimonials = [
                    ['name' => 'Rohit Sharma', 'role' => 'Bought in Noida', 'text' => 'Found our dream apartment within two weeks — the verified badge really did save us from a lot of back and forth.', 'seed' => 'user-1'],
                    ['name' => 'Ayesha Khan', 'role' => 'Rented in Delhi', 'text' => 'Direct contact with the owner meant no brokerage. The search filters made narrowing down locations effortless.', 'seed' => 'user-2'],
                    ['name' => 'Vikram Mehta', 'role' => 'Bought in Gurugram', 'text' => 'The EMI calculator helped us plan our budget before we even started visiting sites. Smooth experience overall.', 'seed' => 'user-3'],
                ];
            @endphp

            @foreach($testimonials as $k => $t)

                <div class="col-md-4 pp-reveal" style="transition-delay:{{ $k * 0.08 }}s;">
                    <div class="pp-testi">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p class="mb-0">{{ $t['text'] }}</p>
                        <div class="pp-testi-user">
                            <img src="https://picsum.photos/seed/{{ $t['seed'] }}/80/80" alt="{{ $t['name'] }}">
                            <div>
                                <strong>{{ $t['name'] }}</strong>
                                <span>{{ $t['role'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>

    </div>

</section>

{{-- =========================================================
BLOG SECTION
========================================================= --}}

<section class="py-5 py-md-6">

    <div class="container">

        <div class="d-flex justify-content-between align-items-end mb-4 pp-reveal pp-section-head">
            <div>
                <span class="pp-eyebrow">Insights</span>
                <h2 class="mt-2 mb-1">Latest From Our Blog</h2>
                <p class="mb-0">Property tips, market insights and guides.</p>
            </div>
            <a href="#" class="pp-btn-ghost d-none d-md-inline-block">View Blog</a>
        </div>

        <div class="row g-4">

            @php
                $blogSeeds = ['blog-a','blog-b','blog-c'];
            @endphp

            @for($i = 1; $i <= 3; $i++)

                <div class="col-md-4 pp-reveal" style="transition-delay:{{ $i * 0.07 }}s;">

                    <article class="pp-card h-100">

                        <div class="pp-blog-img">
                            <img src="https://picsum.photos/seed/{{ $blogSeeds[$i-1] }}/500/340" alt="Blog cover" loading="lazy">
                        </div>

                        <div class="pp-card-body">

                            <span class="pp-eyebrow">Property Guide</span>

                            <h5 class="fw-bold mt-2" style="font-size:1.05rem; line-height:1.35;">
                                Important Things to Know Before Buying a Property
                            </h5>

                            <p class="text-muted small">
                                Helpful information for property buyers and investors.
                            </p>

                            <a href="#" class="pp-read-more">
                                Read More
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </a>

                        </div>

                    </article>

                </div>

            @endfor

        </div>

    </div>

</section>

{{-- =========================================================
APP DOWNLOAD BANNER
========================================================= --}}

<section class="py-4 py-md-5">

    <div class="container">

        <div class="pp-app pp-reveal">

            <div class="row align-items-center position-relative">

                <div class="col-lg-8">
                    <span class="pp-eyebrow" style="color:#7CFFB2;">On The Go</span>
                    <h2 class="mt-2 mb-2" style="color:#fff;">Search properties from your pocket</h2>
                    <p class="mb-4" style="color:rgba(255,255,255,.78); max-width:460px;">
                        Get instant alerts, save your favorite listings and chat
                        with owners — download the app for free.
                    </p>

                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#" class="pp-store-badge">
                            <i class="bi bi-apple fs-4"></i>
                            <span><small>Download on the</small><strong>App Store</strong></span>
                        </a>
                        <a href="#" class="pp-store-badge">
                            <i class="bi bi-google-play fs-4"></i>
                            <span><small>Get it on</small><strong>Google Play</strong></span>
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>

</section>

{{-- =========================================================
CALL TO ACTION
========================================================= --}}

<section class="py-5">

    <div class="container">

        <div class="pp-cta pp-reveal">

            <span class="pp-eyebrow" style="color:#fff;">List With Confidence</span>

            <h2 class="mb-3 mt-3">Looking to List Your Property?</h2>

            <p class="mb-4" style="color:rgba(255,255,255,.85); max-width:520px; margin-inline:auto;">
                Create your property listing and reach potential
                buyers and tenants across the region — completely free to post.
            </p>

            @auth
                <a href="{{ route('user.properties.create') }}" class="pp-btn-ghost" style="background:#fff;">
                    List Your Property
                </a>
            @else
                <a href="{{ route('register') }}" class="pp-btn-ghost" style="background:#fff;">
                    Get Started
                </a>
            @endauth

        </div>

    </div>

</section>

</div>{{-- /.pp-scope --}}

@push('scripts')
<script>
    (function () {
        const revealEls = document.querySelectorAll('.pp-reveal');
        const io = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('pp-in');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        revealEls.forEach(el => io.observe(el));

        // Search tab toggle
        document.querySelectorAll('.pp-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.pp-tab').forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
            });
        });

        // Favorite heart toggle
        document.querySelectorAll('.pp-fav').forEach(fav => {
            fav.addEventListener('click', () => {
                fav.classList.toggle('active');
                fav.style.color = fav.classList.contains('active') ? '#FF6B35' : '#B8C0CE';
            });
        });
    })();
</script>
@endpush

@endsection