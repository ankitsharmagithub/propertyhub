@extends('layouts.frontend.app')

@section('title', 'Find Your Perfect Property')

@section('meta_description',
    'Discover properties for sale and rent across cities. Find homes, apartments, plots and
    commercial properties.')

@section('content')


    <main id="main">
        <!-- ============================= HERO ============================= -->
        <section class="hero">
            <div class="neon-dot dot1"></div>

            <div class="neon-dot dot12"></div>
            <div class="hero-media">

                <img src="{{ asset('storage/img/hero-bnr.webp') }}" class="img-fluid"
                    alt="Modern luxury villa with pool at dusk">
            </div>


            <div class="container-xl hero-content">

                <div class="row justify-content-center">
                    <div class=" col-md-10 mx-center">
                        <h1 class="hero-title mb-4">
                            <span class="line"><span>India's Largest </span> Real Estate
                                <span>Platform</span></span></span>
                        </h1>



                        <div class="search-panel-wrapper pp-reveal" style="transition-delay:.1s;">

                            <div class="search-panel">

                                <div class="search-tabs">
                                    <button type="button" class="pp-tab active" data-listing-type="">All</button>
                                    <button type="button" class="pp-tab" data-listing-type="sale">Buy</button>
                                    <button type="button" class="pp-tab" data-listing-type="rent">Rent</button>
                                    <button type="button" class="pp-tab" data-listing-type="lease">Lease</button>
                                </div>

                                <form class="hero-search-form" action="{{ route('properties.index') }}" method="GET">

                                    <input type="hidden" name="listing_type" id="listing_type"
                                        value="{{ request('listing_type') }}">

                                    <input type="hidden" name="city_id" id="search_city_id"
                                        value="{{ request('city_id') }}">

                                    <input type="hidden" name="state_id" id="search_state_id"
                                        value="{{ request('state_id') }}">



                                    <div class="search-field1">
                                        {{-- Property Type --}}
                                        <div class="">

                                            <select name="property_type_id" class="form-select type-field h-100">

                                                <option value="">
                                                    Property Type
                                                </option>

                                                @foreach (\App\Models\PropertyType::where('status', 1)->orderBy('name')->get() as $propertyType)
                                                    <option value="{{ $propertyType->id }}"
                                                        {{ request('property_type_id') == $propertyType->id ? 'selected' : '' }}>
                                                        {{ $propertyType->name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>


                                        {{-- Location Search --}}
                                        <div class=" position-relative">

                                            <input type="text" name="search" id="property-location-search"
                                                value="{{ request('search') }}" class="form-control h-100"
                                                placeholder="Search city, locality or project" autocomplete="off">


                                            {{-- Live Suggestions --}}
                                            <div id="location-suggestions"
                                                class="position-absolute bg-white shadow rounded mt-1 w-100 d-none"
                                                style="
                            z-index:9999;
                            max-height:300px;
                            overflow-y:auto;
                        ">
                                            </div>

                                        </div>


                                        {{-- Budget --}}
                                        <div class="">

                                            <select name="budget" class="form-select h-100">

                                                <option value="">Budget</option>

                                                <option value="0-50" {{ request('budget') === '0-50' ? 'selected' : '' }}>
                                                    Under ₹50L
                                                </option>

                                                <option value="50-100"
                                                    {{ request('budget') === '50-100' ? 'selected' : '' }}>
                                                    ₹50L – ₹1Cr
                                                </option>

                                                <option value="100+"
                                                    {{ request('budget') === '100+' ? 'selected' : '' }}>
                                                    Above ₹1Cr
                                                </option>

                                            </select>

                                        </div>


                                        {{-- Search --}}
                                        <div class="search-field-btn">

                                            <button type="submit" class="pp-search-btn h-100 w-100">
                                                <i class="bi bi-search me-1"></i>
                                                Search
                                            </button>

                                        </div>

                                    </div>

                                    <div class="pp-hero-badges">
                                        <span><i class="bi bi-check-circle-fill"></i> No Broker Options</span>
                                        <span><i class="bi bi-check-circle-fill"></i> Verified Owners</span>
                                        <span><i class="bi bi-check-circle-fill"></i> EMI Calculator</span>
                                    </div>

                                </form>

                            </div>

                        </div>


                    </div>
                </div>
            </div>

            <div class="hero-scroll-cue"><span>Scroll</span><span class="rail"></span></div>
        </section>



        <section class="section bg-white" id="featured">
            <!-- Animated Background Orbs -->


            <div class="container-xl position-relative">

                <div class="text-center mb-4 mb-md-5">
                    <span class="pp-eyebrow-pill">— Featured Listings —</span>
                    <h2 class="pp-title mt-2 mb-1">
                        Exceptional Properties. <span class="gradient-text animated-gradient">Remarkable Living</span>
                    </h2>
                    <div class="title-accent-line mx-auto mt-3"></div>

                </div>



                <div class="property-grid1" id="featuredResults1">
                    <div class="row g-4">
                        <!-- <div class="property-carousel owl-carousel owl-theme"> -->


                        @forelse(($featuredProperties ?? collect())->take(3) as $property)
                            <div class="col-md-6 col-lg-4">
                                <article class="modern-card reveal-up" data-tilt>
                                    <div class="card-gradient-border">
                                        <div class="card-inner">

                                            <div class="card-media">
                                                <div class="media-shine"></div>

                                                {{-- Featured Image --}}
                                                @if ($property->featured_image)
                                                    <img src="{{ asset('storage/properties/featured/' . $property->featured_image) }}"
                                                        alt="{{ $property->title }}" loading="lazy">
                                                @else
                                                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=1200&auto=format&fit=crop"
                                                        alt="{{ $property->title }}" loading="lazy">
                                                @endif

                                                <div class="media-overlay">
                                                    {{-- Status Badge --}}
                                                    <span
                                                        class="status-badge {{ strtolower($property->listing_type ?? '') == 'rent' ? 'status-rent' : 'status-sale' }}">
                                                        <span class="pulse-dot"></span>
                                                        {{ $property->listing_type ? 'For ' . ucfirst($property->listing_type) : 'For Sale' }}
                                                    </span>

                                                    {{-- Favourite Button --}}
                                                    <button class="fav-btn" aria-label="Save {{ $property->title }}"
                                                        data-fav="{{ $property->id }}">
                                                        <i class="fa-regular fa-heart"></i>
                                                        <svg class="fav-particles" viewBox="0 0 24 24">
                                                            <circle cx="12" cy="12" r="1" />
                                                            <circle cx="4" cy="8" r="1" />
                                                            <circle cx="20" cy="8" r="1" />
                                                            <circle cx="6" cy="20" r="1" />
                                                            <circle cx="18" cy="20" r="1" />
                                                        </svg>
                                                    </button>

                                                    <span class="property-type-tag mono">
                                                        {{ $property->construction_status ?? 'Ready to Move' }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <div class="price-row">
                                                    <div class="property-price">
                                                        ₹{{ number_format($property->price) }}
                                                        @if (strtolower($property->listing_type ?? '') == 'rent')
                                                            <small>/mo</small>
                                                        @endif
                                                    </div>
                                                    <span class="price-label mono">
                                                        {{ strtolower($property->listing_type ?? '') == 'rent' ? 'Monthly rent' : 'Starting from' }}
                                                    </span>
                                                </div>

                                                <h3 class="property-title">
                                                    <a
                                                        href="{{ route('properties.city.slug', [$property->city->slug, $property->slug]) }}">
                                                        {{ $property->title }}
                                                    </a>
                                                </h3>

                                                <div class="property-loc">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                    <span>
                                                        {{ $property->city->name ?? '' }}{{ isset($property->city->name, $property->state->name) ? ', ' : '' }}{{ $property->state->name ?? '' }}
                                                    </span>
                                                </div>

                                                <div class="property-specs">
                                                    @if ($property->bedrooms !== null)
                                                        <div class="spec-item">
                                                            <i class="fa-solid fa-bed"></i>
                                                            <span class="spec-num">{{ $property->bedrooms }}</span>
                                                            <span class="spec-lbl">Beds</span>
                                                        </div>
                                                    @endif

                                                    @if ($property->bathrooms !== null)
                                                        <div class="spec-item">
                                                            <i class="fa-solid fa-bath"></i>
                                                            <span class="spec-num">{{ $property->bathrooms }}</span>
                                                            <span class="spec-lbl">Baths</span>
                                                        </div>
                                                    @endif

                                                    @if ($property->area)
                                                        <div class="spec-item">
                                                            <i class="fa-solid fa-vector-square"></i>
                                                            <span class="spec-num">{{ $property->area }}</span>
                                                            <span
                                                                class="spec-lbl">{{ $property->area_unit ?? 'Sq.Ft' }}</span>
                                                        </div>
                                                    @endif


                                                </div>

                                                <div class="property-cta">
                                                    <span class="mono property-type-label">
                                                        {{ $property->propertyType->name ?? 'Property' }}
                                                    </span>
                                                    <a href="{{ route('properties.city.slug', [$property->city->slug, $property->slug]) }}"
                                                        class="btn-view">
                                                        <span>View Details</span>
                                                        <i class="fa-solid fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </article>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <p class="text-muted">No featured properties available at the moment.</p>
                            </div>
                        @endforelse

                        @if ($featuredProperties->count() > 3)
                            <div class="col-12 text-center py-5">
                                <a href="#" class="btn btn-gold text-white">View All <i
                                        class="fa-solid fa-arrow-right"></i></a>
                            </div>
                    </div>
                    @endif
                </div>
            </div>
            </div>
        </section>




        <!-- Builders & Developers Section -->
        <section class="pp-builders-section py-5">
            <div class="container">

                <div class="title-wrapper text-center mb-4">
                    <span class="eyebrow mono">— Trusted Partners —</span>
                    <h2 class="section-title">
                        Top Builders
                        <span class="gradient-text animated-gradient">& Developers</span>
                    </h2>
                    <div class="title-accent-line mx-auto mt-3"></div>

                </div>





                @php
                    $buildersList = \App\Models\Category::withCount('properties')
                        ->where('status', 1)
                        ->orderBy('sort_order', 'asc')
                        ->get();
                @endphp

                <!-- Owl Carousel Slider -->
                <div class="owl-carousel owl-theme builder-carousel">
                    @foreach ($buildersList as $builder)
                        <div class="item">
                            <div class="pp-builder-card">
                                <div class="pp-builder-head">
                                    <div class="pp-builder-logo">
                                        @if ($builder->image)
                                            <img src="{{ asset('storage/' . $builder->image) }}"
                                                alt="{{ $builder->name }}" loading="lazy">
                                        @else
                                            <img src="https://picsum.photos/seed/builder1/120/120"
                                                alt="{{ $builder->name }}" loading="lazy">
                                        @endif
                                    </div>
                                    <span class="pp-badge-verified" title="Verified Builder">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </span>
                                </div>

                                <div class="pp-builder-body">
                                    <h5 class="pp-builder-name text-truncate" title="{{ $builder->name }}">
                                        {{ $builder->name }}
                                    </h5>

                                    <div class="pp-builder-stats">
                                        <div class="pp-stat-item">
                                            <i class="fa-solid fa-city"></i>
                                            <span>{{ $builder->properties_count }}+ Projects</span>
                                        </div>
                                        <div class="pp-stat-divider"></div>
                                        <div class="pp-stat-item">
                                            <i class="fa-solid fa-award"></i>
                                            <span>Verified</span>
                                        </div>
                                    </div>
                                </div>


                                <a href="{{ route('developer.detail', $builder->slug) }}" class="pp-builder-link">
                                    <span>View Projects</span>
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            </div>
        </section>




        <section class="popular-cities-section py-5 bg-white">
            <div class="container">

                <!-- Title Wrapper -->
                <div class="title-wrapper text-center mb-4 pb-2">
                    <span class="eyebrow mono">— Explore Locations —</span>
                    <h2 class="section-title">
                        Popular <span class="gradient-text animated-gradient">Cities</span>
                    </h2>
                    <div class="title-accent-line mx-auto mt-3"></div>
                </div>

                <!-- Bootstrap 5 Grid Layout -->
                <div class="row g-3 g-md-3 row-cols-2 row-cols-sm-3 row-cols-lg-6">

                    <!-- City Card 1 -->
                    <div class="col">
                        <a href="#" class="city-card">
                            <div class="city-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1570168007204-dfb528c6958f?auto=format&fit=crop&q=80&w=400"
                                    alt="Mumbai" loading="lazy">
                                <span class="city-badge"><i class="bi bi-geo-alt-fill"></i> 1,450+ Props</span>
                            </div>
                            <div class="city-info">
                                <h3 class="city-name">Mumbai</h3>
                                <span class="city-arrow"><i class="bi bi-arrow-up-right"></i></span>
                            </div>
                        </a>
                    </div>

                    <!-- City Card 2 -->
                    <div class="col">
                        <a href="#" class="city-card">
                            <div class="city-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1587474260584-136574528ed5?auto=format&fit=crop&q=80&w=400"
                                    alt="Delhi NCR" loading="lazy">
                                <span class="city-badge"><i class="bi bi-geo-alt-fill"></i> 2,100+ Props</span>
                            </div>
                            <div class="city-info">
                                <h3 class="city-name">Delhi NCR</h3>
                                <span class="city-arrow"><i class="bi bi-arrow-up-right"></i></span>
                            </div>
                        </a>
                    </div>

                    <!-- City Card 3 -->
                    <div class="col">
                        <a href="#" class="city-card">
                            <div class="city-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1596176530529-78163a4f7af2?auto=format&fit=crop&q=80&w=400"
                                    alt="Bengaluru" loading="lazy">
                                <span class="city-badge"><i class="bi bi-geo-alt-fill"></i> 1,820+ Props</span>
                            </div>
                            <div class="city-info">
                                <h3 class="city-name">Bengaluru</h3>
                                <span class="city-arrow"><i class="bi bi-arrow-up-right"></i></span>
                            </div>
                        </a>
                    </div>

                    <!-- City Card 4 -->
                    <div class="col">
                        <a href="#" class="city-card">
                            <div class="city-img-wrapper">
                                <img src="https://picsum.photos/seed/city-ghaziabad/300/260" alt="Hyderabad"
                                    loading="lazy">
                                <span class="city-badge"><i class="bi bi-geo-alt-fill"></i> 580+ Props</span>
                            </div>
                            <div class="city-info">
                                <h3 class="city-name">Jewar</h3>
                                <span class="city-arrow"><i class="bi bi-arrow-up-right"></i></span>
                            </div>
                        </a>
                    </div>

                    <!-- City Card 5 -->
                    <div class="col">
                        <a href="#" class="city-card">
                            <div class="city-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1567157577867-05ccb1388e66?auto=format&fit=crop&q=80&w=400"
                                    alt="Pune" loading="lazy">
                                <span class="city-badge"><i class="bi bi-geo-alt-fill"></i> 1,120+ Props</span>
                            </div>
                            <div class="city-info">
                                <h3 class="city-name">Pune</h3>
                                <span class="city-arrow"><i class="bi bi-arrow-up-right"></i></span>
                            </div>
                        </a>
                    </div>

                    <!-- City Card 6 -->
                    <div class="col">
                        <a href="#" class="city-card">
                            <div class="city-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1582510003544-4d00b7f74220?auto=format&fit=crop&q=80&w=400"
                                    alt="Chennai" loading="lazy">
                                <span class="city-badge"><i class="bi bi-geo-alt-fill"></i> 750+ Props</span>
                            </div>
                            <div class="city-info">
                                <h3 class="city-name">Chennai</h3>
                                <span class="city-arrow"><i class="bi bi-arrow-up-right"></i></span>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </section>





        <section class="pp-latest-section py-5">
            <div class="container" style="max-width: var(--container-max);">

                <!-- Section Header with Top-Right Nav Controls -->
                <div class="d-flex justify-content-between align-items-end mb-4 pp-section-head">
                    <div>
                        <span class="pp-eyebrow-pill">— Fresh Additions —</span>
                        <h2 class="pp-title mt-2 mb-1">
                            Latest <span class="gradient-text animated-gradient">Properties</span>
                        </h2>
                        <p class="pp-subtitle mb-0">Recently added listings, explore before they are taken.</p>
                    </div>

                    <!-- Header Right Controls: View All + Owl Nav Arrows -->
                    <div class="d-flex align-items-center gap-2 gap-md-3">
                        <a href="#" class="pp-btn-link d-none d-md-inline-flex align-items-center me-2">
                            View All <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                        <!-- Top-Right Owl Nav Arrows -->
                        <div class="pp-slider-nav d-flex gap-2">
                            <button type="button" class="pp-nav-btn pp-prev-btn" aria-label="Previous">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button type="button" class="pp-nav-btn pp-next-btn" aria-label="Next">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Owl Carousel Container -->
                @if ($latestProperties->count() > 0)
                    <div class="owl-carousel owl-theme latestpro-carousel">
                        @foreach ($latestProperties as $i => $property)
                            <div class="item">
                                <!-- Compact Property Card -->
                                <div class="pp-prop-card-sm h-100">

                                    <!-- Image Media Wrapper -->
                                    <div class="pp-card-media">
                                        @if ($property->featured_image)
                                            <img src="{{ asset('storage/properties/featured/' . $property->featured_image) }}"
                                                alt="{{ $property->title }}" loading="lazy">
                                        @else
                                            <img src="https://picsum.photos/seed/latest-{{ $property->id }}/480/320"
                                                alt="{{ $property->title }}" loading="lazy">
                                        @endif

                                        <!-- Badges Overlay -->
                                        <div class="pp-media-badges">
                                            <span class="pp-badge-new">New</span>
                                        </div>

                                        <!-- Favorite Button -->
                                        <button type="button" class="pp-fav-btn" aria-label="Save Property">
                                            <i class="bi bi-heart-fill"></i>
                                        </button>
                                    </div>

                                    <!-- Card Content Body -->
                                    <div class="pp-card-body">

                                        <!-- Price & Time Row -->
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <h6 class="pp-card-price mb-0">₹{{ number_format($property->price) }}</h6>
                                            <span class="pp-time-text">{{ $property->created_at->diffForHumans() }}</span>
                                        </div>

                                        <!-- Title & Location -->
                                        <h5 class="pp-card-title text-truncate mb-1" title="{{ $property->title }}">
                                            <a
                                                href="{{ route('properties.city.slug', [$property->city->slug, $property->slug]) }}">
                                                {{ $property->title }}</a>
                                        </h5>
                                        <p class="pp-card-location text-truncate mb-3">
                                            <i
                                                class="bi bi-geo-alt me-1"></i>{{ $property->city->name ?? '' }}{{ isset($property->state->name) ? ', ' . $property->state->name : '' }}
                                        </p>

                                        <!-- Compact Spec Badges -->
                                        <div class="pp-card-specs d-flex align-items-center gap-2 pt-2 border-top">
                                            @if ($property->bedrooms !== null)
                                                <span class="pp-spec-pill" title="Bedrooms">
                                                    <i class="bi bi-door-closed"></i> {{ $property->bedrooms }} Bed
                                                </span>
                                            @endif

                                            @if ($property->bathrooms !== null)
                                                <span class="pp-spec-pill" title="Bathrooms">
                                                    <i class="bi bi-droplet"></i> {{ $property->bathrooms }} Bath
                                                </span>
                                            @endif

                                            @if ($property->area)
                                                <span class="pp-spec-pill text-truncate" title="Area">
                                                    <i class="bi bi-arrows-angle"></i> {{ $property->area }}
                                                    {{ $property->area_unit }}
                                                </span>
                                            @endif
                                        </div>

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-light border rounded-3 text-center py-4 color-grey">
                        <i class="bi bi-info-circle me-1"></i> No properties available at the moment.
                    </div>
                @endif

            </div>
        </section>
        <!-- why chose -->



        <section class="pp-why-split-section py-5 py-lg-6">
            <div class="container" style="max-width: var(--container-max);">
                <div class="row g-4 g-lg-5 align-items-center">

                    <!-- Left Column: Visual Image Anchor with Floating Stats -->
                    <div class="col-lg-5 col-xl-5 pp-reveal">
                        <div class="pp-why-visual-wrapper position-relative">

                            <!-- Background Glow Effect -->
                            <div class="pp-visual-glow"></div>

                            <!-- Main Showcase Image -->
                            <div class="pp-visual-img-frame">
                                <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&q=80&w=800"
                                    alt="Modern Luxury Home" class="img-fluid pp-visual-img" loading="lazy">
                            </div>

                            <!-- Floating Badge 1: Top Right (Verified) -->
                            <div class="pp-float-badge pp-badge-top-right">
                                <div class="pp-badge-icon bg-success-soft text-success">
                                    <i class="bi bi-patch-check-fill"></i>
                                </div>
                                <div>
                                    <span class="pp-badge-title">100% Verified</span>
                                    <span class="pp-badge-sub">Legally Checked</span>
                                </div>
                            </div>

                            <!-- Floating Badge 2: Bottom Left (Properties Count) -->
                            <div class="pp-float-badge pp-badge-bottom-left">
                                <div class="pp-badge-icon text-gold">
                                    <i class="bi bi-house-door-fill"></i>
                                </div>
                                <div>
                                    <span class="pp-badge-number">15,000+</span>
                                    <span class="pp-badge-sub">Active Listings</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Right Column: Content & Feature List -->
                    <div class="col-lg-7 col-xl-7">
                        <div class="pp-why-content ps-lg-3">

                            <!-- Header -->
                            <div class="pp-section-head mb-4 pb-2">
                                <span class="pp-eyebrow-pill">— Why Choose Us —</span>
                                <h2 class="pp-title mt-2 mb-3">
                                    Redefining Your <span class="gradient-text animated-gradient">Real Estate</span>
                                    Experience
                                </h2>
                                <p class="pp-subtitle mb-0">
                                    We bridge the gap between property buyers, renters, and owners with transparency, direct
                                    communication, and smart digital tools.
                                </p>
                            </div>

                            <!-- Features Sub-Grid -->
                            @php
                                $features = [
                                    [
                                        'icon' => 'bi-shield-check',
                                        'title' => 'Verified Listings',
                                        'text' =>
                                            'Every property listing undergoes rigorous legal and physical verification before going live.',
                                    ],
                                    [
                                        'icon' => 'bi-search-heart',
                                        'title' => 'Smart Property Search',
                                        'text' =>
                                            'Hyper-targeted filters by budget, locality, amenities, and property layout.',
                                    ],
                                    [
                                        'icon' => 'bi-people-fill',
                                        'title' => 'Zero-Brokerage Direct Chat',
                                        'text' =>
                                            'Connect directly with genuine owners and trusted agents with no hidden surprise fees.',
                                    ],
                                    [
                                        'icon' => 'bi-calculator-fill',
                                        'title' => 'Instant EMI & Tax Tool',
                                        'text' =>
                                            'Evaluate monthly payments, tax savings, and loan eligibility instantly.',
                                    ],
                                ];
                            @endphp

                            <div class="row g-3 g-sm-4">
                                @foreach ($features as $k => $f)
                                    <div class="col-12 col-sm-6 pp-reveal"
                                        style="transition-delay: {{ $k * 0.08 }}s;">
                                        <div class="pp-feature-item">
                                            <div class="pp-feature-icon-wrapper">
                                                <i class="bi {{ $f['icon'] }}"></i>
                                            </div>
                                            <div class="pp-feature-body">
                                                <h5 class="pp-feature-title mb-1">{{ $f['title'] }}</h5>
                                                <p class="pp-feature-text mb-0">{{ $f['text'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>




        {{-- =========================================================
DYNAMIC CITY SECTIONS (Homepage)
========================================================= --}}
        @if (isset($homeCityData['ghaziabad']))
            <section class="pp-owner-section py-5 bg-white">
                <div class="container-xl">
                    <div class="d-flex justify-content-between align-items-end mb-4 pp-section-head">
                        <div>
                            <span class="pp-eyebrow-pill">— Verified Listings —</span>
                            <h2 class="pp-title mt-2 mb-1">
                                Exclusive Owner Properties in <span
                                    class="gradient-text animated-gradient">{{ $homeCityData['ghaziabad']['city']->name }}</span>
                            </h2>
                            <p class="pp-subtitle mb-0">Direct owner listings with zero brokerage fees.</p>
                        </div>
                        <a href="{{ route('properties.city', $homeCityData['ghaziabad']['city']->slug) }}"
                            class="pp-btn-link d-inline-flex align-items-center">
                            View All <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>

                    <div class="row g-3 g-lg-4">
                        @forelse($homeCityData['ghaziabad']['properties'] as $propertyItem)
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="pp-prop-card-sm h-100">

                                    <!-- Image Media Wrapper -->
                                    <div class="pp-card-media">
                                        @if ($propertyItem->featured_image)
                                            <img src="{{ asset('storage/properties/featured/' . $propertyItem->featured_image) }}"
                                                alt="{{ $propertyItem->title }}" loading="lazy">
                                        @else
                                            <img src="https://picsum.photos/seed/owner-{{ $propertyItem->id }}/480/320"
                                                alt="{{ $propertyItem->title }}" loading="lazy">
                                        @endif

                                        <!-- Photo Count & Owner Badges -->
                                        <div class="pp-media-badges">
                                            <span class="pp-badge-photos">
                                                <i
                                                    class="bi bi-camera me-1"></i>{{ $propertyItem->photos_count ?? rand(8, 15) }}
                                            </span>
                                        </div>
                                        <span class="pp-badge-owner">Owner</span>
                                    </div>

                                    <!-- Card Body -->
                                    <div class="pp-card-body">
                                        <h5 class="pp-card-title text-truncate mb-1" title="{{ $propertyItem->title }}">
                                            {{ $propertyItem->title }}
                                        </h5>

                                        <div class="pp-card-price mb-1">
                                            ₹{{ number_format($propertyItem->price) }}
                                        </div>

                                        <p class="pp-card-location text-truncate mb-3">
                                            <i
                                                class="bi bi-geo-alt me-1"></i>{{ $propertyItem->locality ?? $propertyItem->title }},
                                            {{ $propertyItem->city->name ?? '' }}
                                        </p>

                                        <!-- Footer Details -->
                                        <div
                                            class="pp-card-specs d-flex align-items-center justify-content-between pt-2 border-top mt-auto">
                                            <span class="pp-status-tag">
                                                <i
                                                    class="bi bi-check-circle-fill me-1 text-success"></i>{{ ucfirst($propertyItem->availability ?? 'Ready to Move') }}
                                            </span>

                                            <a href="{{ route('properties.city.slug', [$propertyItem->city->slug, $propertyItem->slug]) }}"
                                                class="pp-view-details-link">
                                                View Details
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <!-- Demo Card 1 -->
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="pp-prop-card-sm h-100">
                                    <div class="pp-card-media">
                                        <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?q=80&w=480&auto=format&fit=crop"
                                            alt="3 BHK Flat">
                                        <div class="pp-media-badges">
                                            <span class="pp-badge-photos"><i class="bi bi-camera me-1"></i>17</span>
                                        </div>
                                        <span class="pp-badge-owner">Owner</span>
                                    </div>
                                    <div class="pp-card-body">
                                        <h5 class="pp-card-title text-truncate mb-1">3 BHK Flat</h5>
                                        <div class="pp-card-price mb-1">₹2.50 Cr</div>
                                        <p class="pp-card-location text-truncate mb-3"><i
                                                class="bi bi-geo-alt me-1"></i>Crossings Republik, Ghaziabad</p>
                                        <div
                                            class="pp-card-specs d-flex align-items-center justify-content-between pt-2 border-top mt-auto">
                                            <span class="pp-status-tag"><i
                                                    class="bi bi-check-circle-fill me-1 text-success"></i>Ready to
                                                Move</span>
                                            <a href="#" class="pp-view-details-link">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Demo Card 2 -->
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="pp-prop-card-sm h-100">
                                    <div class="pp-card-media">
                                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=480&auto=format&fit=crop"
                                            alt="2 BHK Flat">
                                        <div class="pp-media-badges">
                                            <span class="pp-badge-photos"><i class="bi bi-camera me-1"></i>12</span>
                                        </div>
                                        <span class="pp-badge-owner">Owner</span>
                                    </div>
                                    <div class="pp-card-body">
                                        <h5 class="pp-card-title text-truncate mb-1">2 BHK Flat</h5>
                                        <div class="pp-card-price mb-1">₹90 Lac</div>
                                        <p class="pp-card-location text-truncate mb-3"><i
                                                class="bi bi-geo-alt me-1"></i>Mehrauli, Ghaziabad</p>
                                        <div
                                            class="pp-card-specs d-flex align-items-center justify-content-between pt-2 border-top mt-auto">
                                            <span class="pp-status-tag"><i
                                                    class="bi bi-check-circle-fill me-1 text-success"></i>Ready to
                                                Move</span>
                                            <a href="#" class="pp-view-details-link">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Demo Card 3 -->
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="pp-prop-card-sm h-100">
                                    <div class="pp-card-media">
                                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=480&auto=format&fit=crop"
                                            alt="4 BHK Flat">
                                        <div class="pp-media-badges">
                                            <span class="pp-badge-photos"><i class="bi bi-camera me-1"></i>9</span>
                                        </div>
                                        <span class="pp-badge-owner">Owner</span>
                                    </div>
                                    <div class="pp-card-body">
                                        <h5 class="pp-card-title text-truncate mb-1">4 BHK Flat</h5>
                                        <div class="pp-card-price mb-1">₹4.30 Cr</div>
                                        <p class="pp-card-location text-truncate mb-3"><i
                                                class="bi bi-geo-alt me-1"></i>Indirapuram, Ghaziabad</p>
                                        <div
                                            class="pp-card-specs d-flex align-items-center justify-content-between pt-2 border-top mt-auto">
                                            <span class="pp-status-tag"><i
                                                    class="bi bi-check-circle-fill me-1 text-success"></i>Ready to
                                                Move</span>
                                            <a href="#" class="pp-view-details-link">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Demo Card 4 -->
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="pp-prop-card-sm h-100">
                                    <div class="pp-card-media">
                                        <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?q=80&w=480&auto=format&fit=crop"
                                            alt="3 BHK Flat">
                                        <div class="pp-media-badges">
                                            <span class="pp-badge-photos"><i class="bi bi-camera me-1"></i>13</span>
                                        </div>
                                        <span class="pp-badge-owner">Owner</span>
                                        <button type="button" class="pp-fav-btn"><i class="bi bi-heart"></i></button>
                                    </div>
                                    <div class="pp-card-body">
                                        <h5 class="pp-card-title text-truncate mb-1">3 BHK Flat</h5>
                                        <div class="pp-card-price mb-1">₹1.60 Cr</div>
                                        <p class="pp-card-location text-truncate mb-3"><i
                                                class="bi bi-geo-alt me-1"></i>Crossings Republik, Ghaziabad</p>
                                        <div
                                            class="pp-card-specs d-flex align-items-center justify-content-between pt-2 border-top mt-auto">
                                            <span class="pp-status-tag"><i
                                                    class="bi bi-check-circle-fill me-1 text-success"></i>Ready to
                                                Move</span>
                                            <a href="#" class="pp-view-details-link">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>
        @endif



        <section class="pp-types-section py-5 bg-light">
            <div class="container-xl">

                <!-- Section Header -->
                <div class="text-center mb-4 mb-md-5">
                    <span class="pp-eyebrow-pill">— Categories —</span>
                    <h2 class="pp-title mt-2 mb-1">
                        Explore <span class="gradient-text animated-gradient">Property Types</span>
                    </h2>

                    <p class="pp-subtitle mb-0">Find the right living space or commercial investment tailored to your
                        needs.</p>
                </div>

                <!-- 4 Cards Row -->
                <div class="row g-3 g-lg-4">

                    <!-- Card 1: Apartments & Flats -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <a href="#" class="pp-type-overlay-card">
                            <div class="pp-type-bg"
                                style="background-image: url('https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?q=80&w=600&auto=format&fit=crop');">
                            </div>
                            <div class="pp-type-overlay"></div>

                            <div class="pp-type-content">
                                <span class="pp-type-badge">
                                    <i class="bi bi-building me-1"></i> 1,420+ Properties
                                </span>

                                <div class="pp-type-details">
                                    <div class="pp-type-icon-wrapper mb-2">
                                        <i class="bi bi-houses"></i>
                                    </div>
                                    <h4 class="pp-type-name">Apartments & Flats</h4>
                                    <p class="pp-type-sub">High-rise, Studios & Penthouses</p>

                                    <div class="pp-type-action">
                                        <span>Browse Category</span>
                                        <i class="bi bi-arrow-right ms-1"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Card 2: Luxury Villas -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <a href="#" class="pp-type-overlay-card">
                            <div class="pp-type-bg"
                                style="background-image: url('https://images.unsplash.com/photo-1613977257363-707ba9348227?q=80&w=600&auto=format&fit=crop');">
                            </div>
                            <div class="pp-type-overlay"></div>

                            <div class="pp-type-content">
                                <span class="pp-type-badge">
                                    <i class="bi bi-house-door me-1"></i> 380+ Properties
                                </span>

                                <div class="pp-type-details">
                                    <div class="pp-type-icon-wrapper mb-2">
                                        <i class="bi bi-house-heart"></i>
                                    </div>
                                    <h4 class="pp-type-name">Luxury Villas</h4>
                                    <p class="pp-type-sub">Independent Homes & Bungalows</p>

                                    <div class="pp-type-action">
                                        <span>Browse Category</span>
                                        <i class="bi bi-arrow-right ms-1"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Card 3: Builder Floors -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <a href="#" class="pp-type-overlay-card">
                            <div class="pp-type-bg"
                                style="background-image: url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=600&auto=format&fit=crop');">
                            </div>
                            <div class="pp-type-overlay"></div>

                            <div class="pp-type-content">
                                <span class="pp-type-badge">
                                    <i class="bi bi-layers me-1"></i> 890+ Properties
                                </span>

                                <div class="pp-type-details">
                                    <div class="pp-type-icon-wrapper mb-2">
                                        <i class="bi bi-layer-forward"></i>
                                    </div>
                                    <h4 class="pp-type-name">Builder Floors</h4>
                                    <p class="pp-type-sub">Private Floors & Duplexes</p>

                                    <div class="pp-type-action">
                                        <span>Browse Category</span>
                                        <i class="bi bi-arrow-right ms-1"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Card 4: Commercial Spaces -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <a href="#" class="pp-type-overlay-card">
                            <div class="pp-type-bg"
                                style="background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=600&auto=format&fit=crop');">
                            </div>
                            <div class="pp-type-overlay"></div>

                            <div class="pp-type-content">
                                <span class="pp-type-badge">
                                    <i class="bi bi-briefcase me-1"></i> 540+ Properties
                                </span>

                                <div class="pp-type-details">
                                    <div class="pp-type-icon-wrapper mb-2">
                                        <i class="bi bi-shop"></i>
                                    </div>
                                    <h4 class="pp-type-name">Commercial Spaces</h4>
                                    <p class="pp-type-sub">Offices, Shops & Warehouses</p>

                                    <div class="pp-type-action">
                                        <span>Browse Category</span>
                                        <i class="bi bi-arrow-right ms-1"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>

            </div>
        </section>


        @if (isset($homeCityData['noida']))
            <section class="pp-owner-section py-5 bg-light">
                <div class="container-xl">
                    <div class="d-flex justify-content-between align-items-end mb-4 pp-section-head">
                        <div>
                            <span class="pp-eyebrow-pill">— Premium Listings —</span>
                            <h2 class="pp-title mt-2 mb-1">
                                Exclusive Owner Properties in <span
                                    class="gradient-text animated-gradient">{{ $homeCityData['noida']['city']->name }}</span>
                            </h2>
                            <p class="pp-subtitle mb-0">Handpicked verified listings in Noida with zero brokerage fees.</p>
                        </div>


                        <a href="{{ route('properties.city', $homeCityData['noida']['city']->slug) }}"
                            class="pp-btn-link d-inline-flex align-items-center">
                            View All <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>

                    <div class="row g-3 g-lg-4">


                        @forelse($homeCityData['noida']['properties'] as $propertyItem)
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="pp-prop-card-sm h-100">

                                    <!-- Image Media Wrapper -->
                                    <div class="pp-card-media">
                                        @if ($propertyItem->featured_image)
                                            <img src="{{ asset('storage/properties/featured/' . $propertyItem->featured_image) }}"
                                                alt="{{ $propertyItem->title }}" loading="lazy">
                                        @else
                                            <img src="https://picsum.photos/seed/owner-{{ $propertyItem->id }}/480/320"
                                                alt="{{ $propertyItem->title }}" loading="lazy">
                                        @endif

                                        <!-- Photo Count & Owner Badges -->
                                        <div class="pp-media-badges">
                                            <span class="pp-badge-photos">
                                                <i
                                                    class="bi bi-camera me-1"></i>{{ $propertyItem->photos_count ?? rand(8, 15) }}
                                            </span>
                                        </div>
                                        <span class="pp-badge-owner">Owner</span>
                                    </div>

                                    <!-- Card Body -->
                                    <div class="pp-card-body">
                                        <h5 class="pp-card-title text-truncate mb-1" title="{{ $propertyItem->title }}">
                                            {{ $propertyItem->title }}
                                        </h5>

                                        <div class="pp-card-price mb-1">
                                            ₹{{ number_format($propertyItem->price) }}
                                        </div>

                                        <p class="pp-card-location text-truncate mb-3">
                                            <i
                                                class="bi bi-geo-alt me-1"></i>{{ $propertyItem->locality ?? $propertyItem->title }},
                                            {{ $propertyItem->city->name ?? '' }}
                                        </p>

                                        <!-- Footer Details -->
                                        <div
                                            class="pp-card-specs d-flex align-items-center justify-content-between pt-2 border-top mt-auto">
                                            <span class="pp-status-tag">
                                                <i
                                                    class="bi bi-check-circle-fill me-1 text-success"></i>{{ ucfirst($propertyItem->availability ?? 'Ready to Move') }}
                                            </span>

                                            <a href="{{ route('properties.city.slug', [$propertyItem->city->slug, $propertyItem->slug]) }}"
                                                class="pp-view-details-link">
                                                View Details
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <!-- Demo Card 1 -->
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="pp-prop-card-sm h-100">
                                    <div class="pp-card-media">
                                        <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?q=80&w=480&auto=format&fit=crop"
                                            alt="3 BHK Flat">
                                        <div class="pp-media-badges">
                                            <span class="pp-badge-photos"><i class="bi bi-camera me-1"></i>17</span>
                                        </div>
                                        <span class="pp-badge-owner">Owner</span>
                                    </div>
                                    <div class="pp-card-body">
                                        <h5 class="pp-card-title text-truncate mb-1">3 BHK Flat</h5>
                                        <div class="pp-card-price mb-1">₹2.50 Cr</div>
                                        <p class="pp-card-location text-truncate mb-3"><i
                                                class="bi bi-geo-alt me-1"></i>Noida Extension, Greater Noida</p>
                                        <div
                                            class="pp-card-specs d-flex align-items-center justify-content-between pt-2 border-top mt-auto">
                                            <span class="pp-status-tag"><i
                                                    class="bi bi-check-circle-fill me-1 text-success"></i>Ready to
                                                Move</span>
                                            <a href="#" class="pp-view-details-link">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Demo Card 2 -->
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="pp-prop-card-sm h-100">
                                    <div class="pp-card-media">
                                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=480&auto=format&fit=crop"
                                            alt="2 BHK Flat">
                                        <div class="pp-media-badges">
                                            <span class="pp-badge-photos"><i class="bi bi-camera me-1"></i>12</span>
                                        </div>
                                        <span class="pp-badge-owner">Owner</span>
                                    </div>
                                    <div class="pp-card-body">
                                        <h5 class="pp-card-title text-truncate mb-1">2 BHK Flat</h5>
                                        <div class="pp-card-price mb-1">₹90 Lac</div>
                                        <p class="pp-card-location text-truncate mb-3"><i
                                                class="bi bi-geo-alt me-1"></i>Sector 62, Noida</p>
                                        <div
                                            class="pp-card-specs d-flex align-items-center justify-content-between pt-2 border-top mt-auto">
                                            <span class="pp-status-tag"><i
                                                    class="bi bi-check-circle-fill me-1 text-success"></i>Ready to
                                                Move</span>
                                            <a href="#" class="pp-view-details-link">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Demo Card 3 -->
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="pp-prop-card-sm h-100">
                                    <div class="pp-card-media">
                                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=480&auto=format&fit=crop"
                                            alt="4 BHK Flat">
                                        <div class="pp-media-badges">
                                            <span class="pp-badge-photos"><i class="bi bi-camera me-1"></i>9</span>
                                        </div>
                                        <span class="pp-badge-owner">Owner</span>
                                    </div>
                                    <div class="pp-card-body">
                                        <h5 class="pp-card-title text-truncate mb-1">4 BHK Flat</h5>
                                        <div class="pp-card-price mb-1">₹4.30 Cr</div>
                                        <p class="pp-card-location text-truncate mb-3"><i
                                                class="bi bi-geo-alt me-1"></i>Sector 150, Noida</p>
                                        <div
                                            class="pp-card-specs d-flex align-items-center justify-content-between pt-2 border-top mt-auto">
                                            <span class="pp-status-tag"><i
                                                    class="bi bi-check-circle-fill me-1 text-success"></i>Ready to
                                                Move</span>
                                            <a href="#" class="pp-view-details-link">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Demo Card 4 -->
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="pp-prop-card-sm h-100">
                                    <div class="pp-card-media">
                                        <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?q=80&w=480&auto=format&fit=crop"
                                            alt="3 BHK Flat">
                                        <div class="pp-media-badges">
                                            <span class="pp-badge-photos"><i class="bi bi-camera me-1"></i>13</span>
                                        </div>
                                        <span class="pp-badge-owner">Owner</span>
                                        <button type="button" class="pp-fav-btn"><i class="bi bi-heart"></i></button>
                                    </div>
                                    <div class="pp-card-body">
                                        <h5 class="pp-card-title text-truncate mb-1">3 BHK Flat</h5>
                                        <div class="pp-card-price mb-1">₹1.60 Cr</div>
                                        <p class="pp-card-location text-truncate mb-3"><i
                                                class="bi bi-geo-alt me-1"></i>Sector 76, Noida</p>
                                        <div
                                            class="pp-card-specs d-flex align-items-center justify-content-between pt-2 border-top mt-auto">
                                            <span class="pp-status-tag"><i
                                                    class="bi bi-check-circle-fill me-1 text-success"></i>Ready to
                                                Move</span>
                                            <a href="#" class="pp-view-details-link">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>
        @endif





        <!-- high demanding -->

        <section class="pp-invest-section py-5 bg-white">
            <div class="container-xl">

                <div class="d-flex justify-content-between align-items-center mb-4 pp-section-head">
                    <div>
                        <span class="pp-eyebrow-pill">— Highlight Project —</span>
                        <h2 class="pp-title mt-2 mb-1">
                            High-demand projects <span class="gradient-text animated-gradient">to invest now</span>
                        </h2>
                        <p class="pp-subtitle mb-0">Leading projects in high demand</p>
                    </div>

                    <a href="#" class="pp-btn-link d-inline-flex align-items-center">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>


                <!-- 3-Column Grid (6 Cards) -->
                <div class="row g-3 g-lg-4">

                    <!-- Card 1 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="#" class="pp-project-card text-decoration-none">
                            <div class="pp-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?q=80&w=400&auto=format&fit=crop"
                                    alt="Signix Harmony Height">
                            </div>
                            <div class="pp-card-info">
                                <div>
                                    <h5 class="pp-project-name text-truncate mb-0" title="Signix Harmony Height">Signix
                                        Harmony Height</h5>
                                    <p class="pp-developer-name text-muted mb-2">by PROPFOLIO</p>
                                    <p class="pp-spec-text text-truncate mb-1">1, 2, 3 BHK Apartments</p>
                                    <p class="pp-location-text text-muted text-truncate mb-0">Noida Extension, Greater
                                        Noida</p>
                                </div>
                                <div class="pp-price-tag mt-2">
                                    ₹29.5 L - 53.51 L
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="#" class="pp-project-card text-decoration-none">
                            <div class="pp-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=400&auto=format&fit=crop"
                                    alt="JMD DM Infra">
                            </div>
                            <div class="pp-card-info">
                                <div>
                                    <h5 class="pp-project-name text-truncate mb-0" title="JMD DM Infra">JMD DM Infra</h5>
                                    <p class="pp-developer-name text-muted mb-2">by Capital Homes</p>
                                    <p class="pp-spec-text text-truncate mb-1">2, 2.5, 3, 3.5 BHK Builder Floor</p>
                                    <p class="pp-location-text text-muted text-truncate mb-0">Sector 110, Noida</p>
                                </div>
                                <div class="pp-price-tag mt-2">
                                    ₹52.0 L - 78 L
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="#" class="pp-project-card text-decoration-none">
                            <div class="pp-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=400&auto=format&fit=crop"
                                    alt="Trinity Trio">
                            </div>
                            <div class="pp-card-info">
                                <div>
                                    <h5 class="pp-project-name text-truncate mb-0" title="Trinity Trio">Trinity Trio</h5>
                                    <p class="pp-developer-name text-muted mb-2">by Trinity Ventures</p>
                                    <p class="pp-spec-text text-truncate mb-1">2, 3 BHK Builder Floors</p>
                                    <p class="pp-location-text text-muted text-truncate mb-0">Noida Extension, Greater
                                        Noida</p>
                                </div>
                                <div class="pp-price-tag mt-2">
                                    ₹35.0 L - 48.16 L
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Card 4 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="#" class="pp-project-card text-decoration-none">
                            <div class="pp-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?q=80&w=400&auto=format&fit=crop"
                                    alt="Vihaan Krystal Supreme">
                            </div>
                            <div class="pp-card-info">
                                <div>
                                    <h5 class="pp-project-name text-truncate mb-0" title="Vihaan Krystal Supreme">Vihaan
                                        Krystal Supreme</h5>
                                    <p class="pp-developer-name text-muted mb-2">by ARYA GROUP</p>
                                    <p class="pp-spec-text text-truncate mb-1">1, 2, 3 BHK Apartments</p>
                                    <p class="pp-location-text text-muted text-truncate mb-0">Noida Extension, Greater
                                        Noida</p>
                                </div>
                                <div class="pp-price-tag mt-2">
                                    ₹28.96 L - 59.85 L
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Card 5 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="#" class="pp-project-card text-decoration-none">
                            <div class="pp-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?q=80&w=400&auto=format&fit=crop"
                                    alt="Godrej Palm Retreat 2">
                            </div>
                            <div class="pp-card-info">
                                <div>
                                    <h5 class="pp-project-name text-truncate mb-0" title="Godrej Palm Retreat 2">Godrej
                                        Palm Retreat 2</h5>
                                    <p class="pp-developer-name text-muted mb-2">by Invest Mango Ltd</p>
                                    <p class="pp-spec-text text-truncate mb-1">2, 3, 4 BHK Apartments</p>
                                    <p class="pp-location-text text-muted text-truncate mb-0">Sector 150, Noida</p>
                                </div>
                                <div class="pp-price-tag mt-2">
                                    ₹2.33 Cr - 4.79 Cr
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Card 6 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="#" class="pp-project-card text-decoration-none">
                            <div class="pp-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?q=80&w=400&auto=format&fit=crop"
                                    alt="Balaji Residency">
                            </div>
                            <div class="pp-card-info">
                                <div>
                                    <h5 class="pp-project-name text-truncate mb-0" title="Balaji Residency">Balaji
                                        Residency</h5>
                                    <p class="pp-developer-name text-muted mb-2">by Balaji Homes</p>
                                    <p class="pp-spec-text text-truncate mb-1">2 BHK Villa</p>
                                    <p class="pp-location-text text-muted text-truncate mb-0">Noida Extension, Greater
                                        Noida</p>
                                </div>
                                <div class="pp-price-tag mt-2">
                                    ₹75.0 L
                                </div>
                            </div>
                        </a>
                    </div>

                </div>

            </div>
        </section>

    </main>





    <div class="pp-scope">




        <!--
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

                                                                                                                                <a href="{{ route('properties.city.slug', [$property->city->slug, $property->slug]) }}"
                                                                                                                                class="text-decoration-none text-reset">

                                                                                                                                    <div class="pp-card">

                                                                                                                                        <div class="pp-card-media">

                                                                                                                                            @if ($property->featured_image)
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

                                                                                                                                                @if ($property->featured)
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

                                                                                                                                                @if ($property->bedrooms !== null)
    <span>
                                                                                                                                                        <i class="bi bi-house-door"></i>
                                                                                                                                                        {{ $property->bedrooms }} BHK
                                                                                                                                                    </span>
    @endif

                                                                                                                                                @if ($property->area)
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

                                                                                                                        </section>   -->







        {{-- =========================================================
PROPERTY CATEGORIES
========================================================= --}}

        <!-- <section class="py-5 py-md-6">

                                                                                                                        <div class="container">

                                                                                                                            <div class="text-center mb-5 pp-reveal pp-section-head">
                                                                                                                                <span class="pp-eyebrow">Explore</span>
                                                                                                                                <h2 class="mt-2">Browse by Property Type</h2>
                                                                                                                                <p>Find the right property for your needs.</p>
                                                                                                                            </div>

                                                                                                                            <div class="row g-4">

                                                                                                                                @php
                                                                                                                                    $propertyCategories = [
                                                                                                                                        [
                                                                                                                                            'title' =>
                                                                                                                                                'Apartments',
                                                                                                                                            'icon' =>
                                                                                                                                                'bi-building',
                                                                                                                                            'count' =>
                                                                                                                                                '2,400+ listings',
                                                                                                                                            'seed' =>
                                                                                                                                                'cat-apartments',
                                                                                                                                        ],
                                                                                                                                        [
                                                                                                                                            'title' =>
                                                                                                                                                'Independent Houses',
                                                                                                                                            'icon' =>
                                                                                                                                                'bi-house-door',
                                                                                                                                            'count' =>
                                                                                                                                                '980+ listings',
                                                                                                                                            'seed' =>
                                                                                                                                                'cat-houses',
                                                                                                                                        ],
                                                                                                                                        [
                                                                                                                                            'title' =>
                                                                                                                                                'Plots & Land',
                                                                                                                                            'icon' =>
                                                                                                                                                'bi-map',
                                                                                                                                            'count' =>
                                                                                                                                                '640+ listings',
                                                                                                                                            'seed' =>
                                                                                                                                                'cat-plots',
                                                                                                                                        ],
                                                                                                                                        [
                                                                                                                                            'title' =>
                                                                                                                                                'Commercial',
                                                                                                                                            'icon' =>
                                                                                                                                                'bi-shop',
                                                                                                                                            'count' =>
                                                                                                                                                '310+ listings',
                                                                                                                                            'seed' =>
                                                                                                                                                'cat-commercial',
                                                                                                                                        ],
                                                                                                                                    ];
                                                                                                                                @endphp

                                                                                                                                @foreach ($categories as $k => $category)
    <div class="col-6 col-lg-3 pp-reveal" style="transition-delay:{{ $k * 0.06 }}s;">

                                                                                                                                        <a href="{{ url('/properties?category=' . $category->slug) }}" class="text-decoration-none">
                                                                                                                                            <div class="pp-cat">
                                                                                                                                                <img src="https://picsum.photos/seed/{{ $category['seed'] }}/420/320" alt="{{ $category['title'] }}" loading="lazy">
                                                                                                                                                <div class="pp-cat-icon"><i class="bi {{ $category['icon'] }}"></i></div>
                                                                                                                                                <div>
                                                                                                                                                    <h5>{{ $category->name }}</h5>
                                                                                                                                                    <small>  {{ $category->properties_count ?? '' }}
                                                                                                                                            @if (isset($category->properties_count))
    listings
    @endif
                                                                                                                    </small>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        </a>

                                                                                                                                    </div>
    @endforeach

                                                                                                                            </div>

                                                                                                                        </div>

                                                                                                                    </section> -->



        {{-- =========================================================
POPULAR CITIES
========================================================= --}}

        <!-- <section class="py-5 py-md-6">

                                                                                                                        <div class="container">

                                                                                                                            <div class="mb-4 pp-reveal pp-section-head">
                                                                                                                                <span class="pp-eyebrow">Locations</span>
                                                                                                                                <h2 class="mt-2">Popular Cities</h2>
                                                                                                                                <p>Explore properties in popular locations.</p>
                                                                                                                            </div>

                                                                                                                            <div class="row g-4">

                                                                                                                                @php
                                                                                                                                    $cities = [
                                                                                                                                        [
                                                                                                                                            'name' =>
                                                                                                                                                'Delhi',
                                                                                                                                            'count' =>
                                                                                                                                                '3,200+',
                                                                                                                                            'seed' =>
                                                                                                                                                'city-delhi',
                                                                                                                                        ],
                                                                                                                                        [
                                                                                                                                            'name' =>
                                                                                                                                                'Noida',
                                                                                                                                            'count' =>
                                                                                                                                                '1,850+',
                                                                                                                                            'seed' =>
                                                                                                                                                'city-noida',
                                                                                                                                        ],
                                                                                                                                        [
                                                                                                                                            'name' =>
                                                                                                                                                'Ghaziabad',
                                                                                                                                            'count' =>
                                                                                                                                                '1,410+',
                                                                                                                                            'seed' =>
                                                                                                                                                'city-ghaziabad',
                                                                                                                                        ],
                                                                                                                                        [
                                                                                                                                            'name' =>
                                                                                                                                                'Gurugram',
                                                                                                                                            'count' =>
                                                                                                                                                '2,050+',
                                                                                                                                            'seed' =>
                                                                                                                                                'city-gurugram',
                                                                                                                                        ],
                                                                                                                                        [
                                                                                                                                            'name' =>
                                                                                                                                                'Lucknow',
                                                                                                                                            'count' =>
                                                                                                                                                '920+',
                                                                                                                                            'seed' =>
                                                                                                                                                'city-lucknow',
                                                                                                                                        ],
                                                                                                                                        [
                                                                                                                                            'name' =>
                                                                                                                                                'Jaipur',
                                                                                                                                            'count' =>
                                                                                                                                                '760+',
                                                                                                                                            'seed' =>
                                                                                                                                                'city-jaipur',
                                                                                                                                        ],
                                                                                                                                    ];
                                                                                                                                @endphp

                                                                                                                                @foreach ($cities as $k => $city)
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

                                                                                                                    </section> -->




        {{-- =========================================================
LATEST PROPERTIES
========================================================= --}}
        <!--
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
                                                                                                                                                 @if ($property->featured_image)
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

                                                                                                                                                <h5 class="fw-bold mt-2 mb-0" style="font-size:1rem;"><a href="{{ route('properties.city.slug', [$property->city->slug, $property->slug]) }}">{{ $property->title }}</a></h5>
                                                                                                                                                <p class="text-muted small mb-0"><i class="bi bi-geo-alt"></i>{{ $property->city->name ?? '' }},
                                                                                                                                            {{ $property->state->name ?? '' }}</p>

                                                                                                                                                <div class="pp-meta">
                                                                                                                                                    @if ($property->bedrooms !== null)
    <span>
                                                                                                                                                    <i class="bi bi-house"></i>
                                                                                                                                                    {{ $property->bedrooms }} Beds
                                                                                                                                                </span>
    @endif

                                                                                                                                            @if ($property->bathrooms !== null)
    <span>
                                                                                                                                                    <i class="bi bi-droplet"></i>
                                                                                                                                                    {{ $property->bathrooms }} Baths
                                                                                                                                                </span>
    @endif

                                                                                                                                            @if ($property->area)
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

                                                                                                                    </section> -->

        {{-- =========================================================
WHY CHOOSE US
========================================================= --}}
        <!--
                                                                                                                    <section class="py-5 py-md-6">

                                                                                                                        <div class="container">

                                                                                                                            <div class="text-center mb-5 pp-reveal pp-section-head">
                                                                                                                                <span class="pp-eyebrow">Why Us</span>
                                                                                                                                <h2 class="mt-2">Why Choose Our Property Portal?</h2>
                                                                                                                            </div>

                                                                                                                            <div class="row g-4">

                                                                                                                                @php
                                                                                                                                    $benefits = [
                                                                                                                                        [
                                                                                                                                            'icon' =>
                                                                                                                                                'bi-shield-check',
                                                                                                                                            'title' =>
                                                                                                                                                'Verified Listings',
                                                                                                                                            'text' =>
                                                                                                                                                'Every listing checked for accuracy before it goes live.',
                                                                                                                                            'cls' =>
                                                                                                                                                'pp-ic-1',
                                                                                                                                        ],
                                                                                                                                        [
                                                                                                                                            'icon' =>
                                                                                                                                                'bi-search',
                                                                                                                                            'title' =>
                                                                                                                                                'Easy Property Search',
                                                                                                                                            'text' =>
                                                                                                                                                'Filter by location, budget and property type in seconds.',
                                                                                                                                            'cls' =>
                                                                                                                                                'pp-ic-2',
                                                                                                                                        ],
                                                                                                                                        [
                                                                                                                                            'icon' =>
                                                                                                                                                'bi-people',
                                                                                                                                            'title' =>
                                                                                                                                                'Direct Connection',
                                                                                                                                            'text' =>
                                                                                                                                                'Talk to owners directly — no hidden brokerage fees.',
                                                                                                                                            'cls' =>
                                                                                                                                                'pp-ic-3',
                                                                                                                                        ],
                                                                                                                                        [
                                                                                                                                            'icon' =>
                                                                                                                                                'bi-calculator',
                                                                                                                                            'title' =>
                                                                                                                                                'Free EMI Calculator',
                                                                                                                                            'text' =>
                                                                                                                                                'Plan your budget before you fall in love with a place.',
                                                                                                                                            'cls' =>
                                                                                                                                                'pp-ic-4',
                                                                                                                                        ],
                                                                                                                                    ];
                                                                                                                                @endphp

                                                                                                                                @foreach ($benefits as $k => $b)
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

                                                                                                                    </section> -->



        {{-- =========================================================
TESTIMONIALS
========================================================= --}}




    </div>{{-- /.pp-scope --}}



    @push('scripts')
        <script>
            (function() {
                const revealEls = document.querySelectorAll('.pp-reveal');
                const io = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('pp-in');
                            io.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.12
                });
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
            document.addEventListener('DOMContentLoaded', function() {

                const tabs = document.querySelectorAll('.pp-tab');
                const listingTypeInput =
                    document.getElementById('listing_type');

                tabs.forEach(function(tab) {

                    tab.addEventListener('click', function() {

                        tabs.forEach(function(item) {

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
            document.addEventListener('DOMContentLoaded', function() {

                const input = document.getElementById('property-location-search');
                const suggestions = document.getElementById('location-suggestions');

                const cityInput = document.getElementById('search_city_id');
                const stateInput = document.getElementById('search_state_id');

                let timer;


                input.addEventListener('input', function() {

                    clearTimeout(timer);

                    const value = this.value.trim();

                    cityInput.value = '';
                    stateInput.value = '';

                    if (value.length < 2) {
                        suggestions.classList.add('d-none');
                        suggestions.innerHTML = '';
                        return;
                    }


                    timer = setTimeout(function() {

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


                                data.forEach(function(location) {

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


                                    item.addEventListener('click', function() {

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
                            .catch(function() {

                                suggestions.classList.add('d-none');

                            });

                    }, 300);

                });


                // Hide dropdown when clicking outside
                document.addEventListener('click', function(event) {

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

                tabs.forEach(function(tab) {

                    tab.addEventListener('click', function() {

                        tabs.forEach(function(item) {
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
