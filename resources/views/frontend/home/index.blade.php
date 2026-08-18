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
            <button type="button" class="pp-tab active" data-listing-type="">
                All
            </button>

            <button type="button" class="pp-tab" data-listing-type="sale">
                Buy
            </button>

            <button type="button" class="pp-tab" data-listing-type="rent">
                Rent
            </button>

            <button type="button" class="pp-tab" data-listing-type="lease">
                Lease
            </button>
        </div>


        <form action="{{ route('properties.index') }}" method="GET">

            <input
                type="hidden"
                name="listing_type"
                id="listing_type"
                value="{{ request('listing_type') }}"
            >

            <input
                type="hidden"
                name="city_id"
                id="search_city_id"
                value="{{ request('city_id') }}"
            >

            <input
                type="hidden"
                name="state_id"
                id="search_state_id"
                value="{{ request('state_id') }}"
            >


            <div class="row g-2 align-items-stretch">

                {{-- Property Type --}}
                <div class="col-md-3">

                    <select
                        name="property_type_id"
                        class="form-select h-100"
                    >

                        <option value="">
                            Property Type
                        </option>

                        @foreach(
                            \App\Models\PropertyType::where('status', 1)
                                ->orderBy('name')
                                ->get()
                            as $propertyType
                        )

                            <option
                                value="{{ $propertyType->id }}"
                                {{ request('property_type_id') == $propertyType->id ? 'selected' : '' }}
                            >
                                {{ $propertyType->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Location Search --}}
                <div class="col-md-5 position-relative">

                    <input
                        type="text"
                        name="search"
                        id="property-location-search"
                        value="{{ request('search') }}"
                        class="form-control h-100"
                        placeholder="Search city, locality or project"
                        autocomplete="off"
                    >


                    {{-- Live Suggestions --}}
                    <div
                        id="location-suggestions"
                        class="position-absolute bg-white shadow rounded mt-1 w-100 d-none"
                        style="
                            z-index:9999;
                            max-height:300px;
                            overflow-y:auto;
                        "
                    ></div>

                </div>


                {{-- Budget --}}
                <div class="col-md-2">

                    <select
                        name="budget"
                        class="form-select h-100"
                    >

                        <option value="">Budget</option>

                        <option
                            value="0-50"
                            {{ request('budget') === '0-50' ? 'selected' : '' }}
                        >
                            Under ₹50L
                        </option>

                        <option
                            value="50-100"
                            {{ request('budget') === '50-100' ? 'selected' : '' }}
                        >
                            ₹50L – ₹1Cr
                        </option>

                        <option
                            value="100+"
                            {{ request('budget') === '100+' ? 'selected' : '' }}
                        >
                            Above ₹1Cr
                        </option>

                    </select>

                </div>


                {{-- Search --}}
                <div class="col-md-2">

                    <button
                        type="submit"
                        class="pp-search-btn h-100 w-100"
                    >
                        <i class="bi bi-search me-1"></i>
                        Search
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

            @forelse($featuredProperties as $i => $property)

    <div class="col-md-6 col-lg-3 pp-reveal"
         style="transition-delay:{{ ($i + 1) * 0.06 }}s;">

        <a href="{{ route('properties.show', $property->slug) }}"
           class="text-decoration-none text-reset">

            <div class="pp-card">

                <div class="pp-card-media">

                    @if($property->featured_image)

                        <img
                            src="{{ asset('storage/properties/featured/' . $property->featured_image) }}"
                            alt="{{ $property->title }}"
                            loading="lazy"
                        >

                    @else

                        <img
                            src="https://picsum.photos/seed/property-{{ $property->id }}/500/360"
                            alt="{{ $property->title }}"
                            loading="lazy"
                        >

                    @endif

                    <span class="pp-tag pp-tag-sale">
                        {{ ucfirst($property->listing_type ?? 'Sale') }}
                    </span>

                    <span class="pp-fav">
                        <i class="bi bi-heart-fill"></i>
                    </span>

                </div>

                <div class="pp-card-body">

                    <div class="d-flex justify-content-between align-items-start">

                        <h6 class="pp-price pp-mono mb-0">
                            ₹{{ number_format($property->price) }}
                        </h6>

                        @if($property->featured)
                            <span class="pp-verified">
                                <i class="bi bi-patch-check-fill"></i>
                                Featured
                            </span>
                        @endif

                    </div>

                    <h5 class="fw-bold mt-2 mb-0" style="font-size:1rem;">
                        {{ $property->title }}
                    </h5>

                    <p class="text-muted small mb-0">
                        <i class="bi bi-geo-alt"></i>
                        {{ $property->city->name ?? '' }},
                        {{ $property->state->name ?? '' }}
                    </p>

                    <div class="pp-meta">

                        @if($property->bedrooms !== null)
                            <span>
                                <i class="bi bi-house-door"></i>
                                {{ $property->bedrooms }} BHK
                            </span>
                        @endif

                        @if($property->area)
                            <span>
                                <i class="bi bi-rulers"></i>
                                {{ $property->area }}
                                {{ $property->area_unit }}
                            </span>
                        @endif

                    </div>

                    <div class="pp-agent">
                        <span>
                            <i class="bi bi-person-circle"></i>
                            Listed by Owner
                        </span>
                    </div>

                </div>

            </div>

        </a>

    </div>

@empty

    <div class="col-12">
        <div class="alert alert-light border">
            No featured properties available.
        </div>
    </div>

@endforelse

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

            @foreach($categories as $k => $category)

                <div class="col-6 col-lg-3 pp-reveal" style="transition-delay:{{ $k * 0.06 }}s;">

                    <a href="{{ url('/properties?category=' . $category->slug) }}" class="text-decoration-none">
                        <div class="pp-cat">
                            <img src="https://picsum.photos/seed/{{ $category['seed'] }}/420/320" alt="{{ $category['title'] }}" loading="lazy">
                            <div class="pp-cat-icon"><i class="bi {{ $category['icon'] }}"></i></div>
                            <div>
                                <h5>{{ $category->name }}</h5>
                                <small>  {{ $category->properties_count ?? '' }}
                        @if(isset($category->properties_count))
                            listings
                        @endif</small>
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

            @forelse($latestProperties as $i => $property)

                <div class="col-md-6 col-lg-4 pp-reveal" style="transition-delay:{{ $i * 0.07 }}s;">

                    <div class="pp-card">

                        <div class="pp-card-media" style="height:230px;">
                             @if($property->featured_image)

                        <img
                            src="{{ asset('storage/properties/featured/' . $property->featured_image) }}"
                            alt="{{ $property->title }}"
                            loading="lazy"
                        >

                    @else

                        <img
                            src="https://picsum.photos/seed/latest-{{ $property->id }}/560/400"
                            alt="{{ $property->title }}"
                            loading="lazy"
                        >

                    @endif
                            <span class="pp-tag pp-tag-new">New</span>
                            <span class="pp-fav"><i class="bi bi-heart-fill"></i></span>
                        </div>

                        <div class="pp-card-body">

                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="pp-price pp-mono mb-0">₹{{ number_format($property->price) }}</h6>
                                <span class="text-muted small">{{ $property->created_at->diffForHumans() }} days ago</span>
                            </div>

                            <h5 class="fw-bold mt-2 mb-0" style="font-size:1rem;">{{ $property->title }}</h5>
                            <p class="text-muted small mb-0"><i class="bi bi-geo-alt"></i>{{ $property->city->name ?? '' }},
                        {{ $property->state->name ?? '' }}</p>

                            <div class="pp-meta">
                                @if($property->bedrooms !== null)
                            <span>
                                <i class="bi bi-house"></i>
                                {{ $property->bedrooms }} Beds
                            </span>
                        @endif

                        @if($property->bathrooms !== null)
                            <span>
                                <i class="bi bi-droplet"></i>
                                {{ $property->bathrooms }} Baths
                            </span>
                        @endif

                        @if($property->area)
                            <span>
                                <i class="bi bi-rulers"></i>
                                {{ $property->area }}
                                {{ $property->area_unit }}
                            </span>
                        @endif
                            </div>

                        </div>
                    </div>

                </div>

            @empty

    <div class="col-12">
        <div class="alert alert-light border">
            No properties available.
        </div>
    </div>

@endforelse

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
<script>
document.addEventListener('DOMContentLoaded', function () {

    const tabs = document.querySelectorAll('.pp-tab');
    const listingTypeInput =
        document.getElementById('listing_type');

    tabs.forEach(function (tab) {

        tab.addEventListener('click', function () {

            tabs.forEach(function (item) {

                item.classList.remove('active');

            });

            this.classList.add('active');

            listingTypeInput.value =
                this.dataset.listingType || '';

        });

    });

});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('property-location-search');
    const suggestions = document.getElementById('location-suggestions');

    const cityInput = document.getElementById('search_city_id');
    const stateInput = document.getElementById('search_state_id');

    let timer;


    input.addEventListener('input', function () {

        clearTimeout(timer);

        const value = this.value.trim();

        cityInput.value = '';
        stateInput.value = '';

        if (value.length < 2) {
            suggestions.classList.add('d-none');
            suggestions.innerHTML = '';
            return;
        }


        timer = setTimeout(function () {

            fetch(
                `{{ route('ajax.property.locations') }}?q=${encodeURIComponent(value)}`
            )
            .then(response => response.json())
            .then(data => {

                suggestions.innerHTML = '';

                if (!data.length) {
                    suggestions.innerHTML = `
                        <div class="p-3 text-muted">
                            No locations found
                        </div>
                    `;

                    suggestions.classList.remove('d-none');
                    return;
                }


                data.forEach(function (location) {

                    const item = document.createElement('button');

                    item.type = 'button';

                    item.className =
                        'w-100 border-0 bg-white text-start p-3';

                    item.innerHTML = `
                        <div class="fw-semibold">
                            <i class="bi bi-geo-alt me-2"></i>
                            ${location.name}
                        </div>

                        <small class="text-muted">
                            ${location.type === 'city'
                                ? 'City'
                                : 'State'}
                            ${location.state_name
                                ? ' · ' + location.state_name
                                : ''}
                        </small>
                    `;


                    item.addEventListener('click', function () {

                        input.value = location.name;

                        cityInput.value =
                            location.city_id ?? '';

                        stateInput.value =
                            location.state_id ?? '';

                        suggestions.classList.add('d-none');

                    });


                    suggestions.appendChild(item);

                });


                suggestions.classList.remove('d-none');

            })
            .catch(function () {

                suggestions.classList.add('d-none');

            });

        }, 300);

    });


    // Hide dropdown when clicking outside
    document.addEventListener('click', function (event) {

        if (
            !input.contains(event.target) &&
            !suggestions.contains(event.target)
        ) {
            suggestions.classList.add('d-none');
        }

    });


    // Tabs
    const tabs = document.querySelectorAll('.pp-tab');
    const listingType = document.getElementById('listing_type');

    tabs.forEach(function (tab) {

        tab.addEventListener('click', function () {

            tabs.forEach(function (item) {
                item.classList.remove('active');
            });

            this.classList.add('active');

            listingType.value =
                this.dataset.listingType || '';

        });

    });

});
</script>
@endpush

@endsection