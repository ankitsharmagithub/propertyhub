@extends('layouts.frontend.app')

@section('title', ($property->meta_title ?: $property->title) . ' | Property Portal')

@section('meta_description', $property->meta_description ?: Str::limit(strip_tags($property->description ??
    $property->title), 155))

@section('content')

    {{-- =========================================================
BREADCRUMB
========================================================= --}}

    <main id="main">


        <section class="pp-breadcrumb-wrapper">
            <div class="container-xl">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pp-breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <i class="bi bi-house-door-fill me-1"></i>Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('properties.index') }}">
                                Properties
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span class="text-truncate">{{ $property->title }}</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </section>




        <!-- new detail page -->


        <div class="property-detail-wrapper py-5">
            <div class="container">

                <!-- ============================================================
                                            GALLERY SECTION
                                            ============================================================ -->
                <section class="mb-5">

                    {{-- Collect all gallery images for the carousel --}}
                    @php
                        $allGalleryImages = $property->images ?? collect();
                        $totalGallery = $allGalleryImages->count();
                        $thumbnails = $allGalleryImages->take(4);
                        $remainingThumbs = $totalGallery - 4;
                    @endphp

                    <div class="row g-3">

                        {{-- MAIN FEATURED IMAGE --}}
                        <div class="col-lg-7">
                            <div class="gallery-main">
                                @if ($property->featured_image)
                                    <img src="{{ asset('storage/properties/featured/' . $property->featured_image) }}"
                                        alt="{{ $property->title }}" data-bs-toggle="modal" data-bs-target="#galleryModal"
                                        data-bs-slide-to="0" loading="lazy" />
                                @else
                                    <div class="img-placeholder w-100 h-100">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- THUMBNAIL GRID --}}
                        <div class="col-lg-5">
                            <div class="row g-3">

                                @if ($thumbnails->count() > 0)

                                    @foreach ($thumbnails as $index => $image)
                                        @php
                                            $slideIndex = $index + 1;
                                            $isLast = $index === 3;
                                            $showOverlay = $isLast && $remainingThumbs > 0;
                                        @endphp

                                        <div class="col-6">
                                            <div class="gallery-thumb" data-bs-toggle="modal" data-bs-target="#galleryModal"
                                                data-bs-slide-to="{{ $slideIndex }}">
                                                <img src="{{ asset('storage/properties/gallery/' . $image->image) }}"
                                                    alt="{{ $property->title }}" loading="lazy" />

                                                @if ($showOverlay)
                                                    <div class="overlay-count">
                                                        <i class="bi bi-plus-lg"></i>
                                                        {{ $remainingThumbs }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- If fewer than 4 images, pad with placeholders --}}
                                    @for ($i = $thumbnails->count(); $i < 4; $i++)
                                        <div class="col-6">
                                            <div class="gallery-thumb img-placeholder">
                                                <i class="bi bi-image text-muted fs-3"></i>
                                            </div>
                                        </div>
                                    @endfor
                                @else
                                    {{-- No gallery images — show 4 placeholders --}}
                                    @for ($i = 0; $i < 4; $i++)
                                        <div class="col-6">
                                            <div class="gallery-thumb img-placeholder">
                                                <i class="bi bi-image text-muted fs-3"></i>
                                            </div>
                                        </div>
                                    @endfor

                                @endif

                            </div>
                        </div>

                    </div>



                </section>


                <!-- ============================================================
                                        MAIN CONTENT + SIDEBAR
                                        ============================================================ -->
                <div class="row">

                    {{-- ============================================================
        LEFT COLUMN
        ============================================================ --}}
                    <div class="col-lg-8">

                        <div class="property-sticky-nav-wrapper mb-1">
                            <nav class="property-sticky-nav" id="propertySubNav">
                                <ul class="nav nav-pills flex-nowrap">
                                    @if ($property->short_description || $property->description)
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#sec-overview">Overview</a>
                                        </li>
                                    @endif
                                    <li class="nav-item">
                                        <a class="nav-link" href="#sec-details">Details</a>
                                    </li>
                                    @if ($property->amenities && $property->amenities->count())
                                        <li class="nav-item">
                                            <a class="nav-link" href="#sec-amenities">Amenities</a>
                                        </li>
                                    @endif
                                    @if ($property->specifications && $property->specifications->count())
                                        <li class="nav-item">
                                            <a class="nav-link" href="#sec-specifications">Specifications</a>
                                        </li>
                                    @endif
                                    @if (
                                        $property->developer ||
                                            $property->project_status ||
                                            $property->possession_date ||
                                            $property->rera_number ||
                                            $property->rera_status)
                                        <li class="nav-item">
                                            <a class="nav-link" href="#sec-project">Project Info</a>
                                        </li>
                                    @endif
                                    @if ($property->floorPlans && $property->floorPlans->count())
                                        <li class="nav-item">
                                            <a class="nav-link" href="#sec-floor-plans">Floor Plans</a>
                                        </li>
                                    @endif
                                    @if ($property->paymentPlans && $property->paymentPlans->count())
                                        <li class="nav-item">
                                            <a class="nav-link" href="#sec-payment-plans">Payment Plans</a>
                                        </li>
                                    @endif
                                    @if ($property->landmarks && $property->landmarks->count())
                                        <li class="nav-item">
                                            <a class="nav-link" href="#sec-landmarks">Landmarks</a>
                                        </li>
                                    @endif
                                    <li class="nav-item">
                                        <a class="nav-link" href="#sec-location">Location</a>
                                    </li>
                                    @if ($property->documents && $property->documents->count())
                                        <li class="nav-item">
                                            <a class="nav-link" href="#sec-documents">Documents</a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>

                        {{-- === PROPERTY HEADER === --}}
                        <div class="maincardbox">
                            <div class="card-modern">
                                {{-- Main Info Section --}}
                                <div class="mb-4">
                                    {{-- Badges --}}
                                    <div class="d-flex flex-wrap gap-2 mb-3">
                                        @if ($property->availability)
                                            <span class="badge-modern bg-availability">
                                                {{ ucfirst($property->availability) }}
                                            </span>
                                        @endif

                                        @isset($property->listing_type)
                                            <span class="badge-modern bg-listing">
                                                {{ [
                                                    'sale' => 'For Sale',
                                                    'rent' => 'For Rent',
                                                    'lease' => 'For Lease',
                                                ][$property->listing_type] ?? ucfirst($property->listing_type) }}
                                            </span>
                                        @endisset

                                        @if ($property->featured)
                                            <span class="badge-modern bg-featured">
                                                <i class="bi bi-star-fill me-1"></i> Featured
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Title --}}
                                    <h1 class="property-title mb-2">
                                        {{ $property->title }}
                                    </h1>

                                    {{-- Location --}}
                                    <p class="property-location mb-2">
                                        <i class="bi bi-geo-alt me-1"></i>
                                        {{ $property->city->name ?? '' }}
                                        @if ($property->city && $property->state)
                                            ,
                                        @endif
                                        {{ $property->state->name ?? '' }}
                                    </p>

                                    {{-- Property Code --}}
                                    @if ($property->property_code)
                                        <span class="property-code">
                                            Property Code: <strong>{{ $property->property_code }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- Price Section --}}
                                @if ($property->price !== null)
                                    <div class="property-price-box">
                                        <div class="property-price">
                                            ₹{{ number_format($property->price) }}
                                            <small>inclusive of all charges</small>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- === STICKY SUB-NAVIGATION BAR === --}}

                            {{-- === OVERVIEW / DESCRIPTION === --}}
                            @if ($property->short_description || $property->description)
                                <div id="sec-overview" class="detail-section-block card-modern">
                                    <div class="card-body p-0">
                                        @if ($property->short_description)
                                            <div class="mb-4">
                                                <h4 class="card-title mb-3">Overview</h4>
                                                <p class="overview-text mb-0">
                                                    {{ $property->short_description }}
                                                </p>
                                            </div>
                                        @endif

                                        @if ($property->description)
                                            <div>
                                                <h4 class="card-title mb-3">Description</h4>
                                                <div class="description-text">
                                                    {!! nl2br(e($property->description)) !!}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- === PROPERTY DETAILS === --}}
                            <div id="sec-details" class="detail-section-block card-modern ">
                                <div class="card-body p-0">
                                    <h4 class="card-title mb-4">Property Details</h4>
                                    <div class="row g-3">
                                        @if ($property->propertyType)
                                            <div class="col-6 col-md-4">
                                                <div class="detail-item">
                                                    <span class="label">Property Type</span>
                                                    <span class="value">{{ $property->propertyType->name }}</span>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($property->category)
                                            <div class="col-6 col-md-4">
                                                <div class="detail-item">
                                                    <span class="label">Category</span>
                                                    <span class="value">{{ $property->category->name }}</span>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($property->bedrooms !== null)
                                            <div class="col-6 col-md-4">
                                                <div class="detail-item">
                                                    <span class="label">Bedrooms</span>
                                                    <span class="value">{{ $property->bedrooms }} BHK</span>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($property->bathrooms !== null)
                                            <div class="col-6 col-md-4">
                                                <div class="detail-item">
                                                    <span class="label">Bathrooms</span>
                                                    <span class="value">{{ $property->bathrooms }}</span>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($property->balconies !== null)
                                            <div class="col-6 col-md-4">
                                                <div class="detail-item">
                                                    <span class="label">Balconies</span>
                                                    <span class="value">{{ $property->balconies }}</span>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($property->parking !== null)
                                            <div class="col-6 col-md-4">
                                                <div class="detail-item">
                                                    <span class="label">Parking</span>
                                                    <span class="value">{{ $property->parking }}</span>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($property->floor !== null)
                                            <div class="col-6 col-md-4">
                                                <div class="detail-item">
                                                    <span class="label">Floor</span>
                                                    <span class="value">{{ $property->floor }}</span>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($property->total_floors !== null)
                                            <div class="col-6 col-md-4">
                                                <div class="detail-item">
                                                    <span class="label">Total Floors</span>
                                                    <span class="value">{{ $property->total_floors }}</span>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($property->area !== null)
                                            <div class="col-6 col-md-4">
                                                <div class="detail-item">
                                                    <span class="label">Area</span>
                                                    <span class="value">
                                                        {{ number_format($property->area) }}
                                                        {{ $property->area_unit ?: 'sq.ft' }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($property->availability)
                                            <div class="col-6 col-md-4">
                                                <div class="detail-item">
                                                    <span class="label">Availability</span>
                                                    <span class="value">{{ ucfirst($property->availability) }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- === AMENITIES === --}}
                            @if ($property->amenities && $property->amenities->count())
                                <div id="sec-amenities" class="detail-section-block card-modern ">
                                    <div class="card-body p-0">
                                        <div class="d-flex align-items-center justify-content-between mb-4">
                                            <h4 class="card-title mb-0">Amenities</h4>
                                            <span class="badge-count">{{ $property->amenities->count() }} Available</span>
                                        </div>

                                        <div class="amenity-pills-wrapper">
                                            @foreach ($property->amenities as $amenity)
                                                <div class="amenity-pill-item">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                    <span>{{ $amenity->name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- === SPECIFICATIONS === --}}
                            @if ($property->specifications && $property->specifications->count())
                                <div id="sec-specifications" class="detail-section-block card-modern">
                                    <div class="card-body p-0">
                                        <h4 class="card-title mb-4">Specifications</h4>
                                        <div class="table-responsive">
                                            <table class="table table-spec-modern align-middle mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="spec-head-label">Feature / Title</th>
                                                        <th scope="col" class="spec-head-value">Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($property->specifications as $spec)
                                                        <tr>
                                                            <td class="spec-label">{{ $spec->title }}</td>
                                                            <td class="spec-value-col">
                                                                <div class="spec-value">{{ $spec->value }}</div>
                                                                @if ($spec->description)
                                                                    <div class="spec-desc">{{ $spec->description }}</div>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- === PROJECT INFORMATION === --}}
                            @if (
                                $property->developer ||
                                    $property->project_status ||
                                    $property->possession_date ||
                                    $property->rera_number ||
                                    $property->rera_status)
                                <div id="sec-project" class="detail-section-block project-info-card card-modern ">
                                    <div class="card-body p-0">
                                        <h4 class="card-title mb-4">Project Information</h4>
                                        <div class="project-info-grid">
                                            @if ($property->developer)
                                                <div class="project-info-item">
                                                    <div class="info-icon"><i class="bi bi-building"></i></div>
                                                    <div class="info-content">
                                                        <span class="label">Developer</span>
                                                        <span class="value">{{ $property->developer->name }}</span>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($property->project_status)
                                                <div class="project-info-item">
                                                    <div class="info-icon"><i class="bi bi-bar-chart-steps"></i></div>
                                                    <div class="info-content">
                                                        <span class="label">Project Status</span>
                                                        <span class="value">{{ $property->project_status }}</span>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($property->possession_date)
                                                <div class="project-info-item">
                                                    <div class="info-icon"><i class="bi bi-calendar2-check"></i></div>
                                                    <div class="info-content">
                                                        <span class="label">Possession Date</span>
                                                        <span class="value">
                                                            {{ \Carbon\Carbon::parse($property->possession_date)->format('d M Y') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($property->rera_number)
                                                <div class="project-info-item highlight-item">
                                                    <div class="info-icon"><i class="bi bi-shield-check"></i></div>
                                                    <div class="info-content">
                                                        <span class="label">RERA Number</span>
                                                        <span class="value mono-font">{{ $property->rera_number }}</span>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($property->rera_status)
                                                <div class="project-info-item">
                                                    <div class="info-icon"><i class="bi bi-patch-check"></i></div>
                                                    <div class="info-content">
                                                        <span class="label">RERA Status</span>
                                                        <span class="value">{{ $property->rera_status }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- === FLOOR PLANS (Big Slider) === --}}
                            @if ($property->floorPlans && $property->floorPlans->count())
                                <div id="sec-floor-plans" class="detail-section-block card-modern">
                                    <div class="card-body p-0">
                                        <h4 class="card-title mb-4">Floor Plans</h4>

                                        {{-- Owl Carousel Container --}}
                                        <div class="owl-carousel owl-theme floor-plan-carousel">
                                            @foreach ($property->floorPlans as $plan)
                                                <div class="item">
                                                    <div class="floor-plan-card">
                                                        @if ($plan->image)
                                                            <div class="floor-img-wrapper">
                                                                <img src="{{ asset('storage/properties/floor-plans/' . $plan->image) }}"
                                                                    alt="{{ $plan->title ?? 'Floor Plan' }}"
                                                                    loading="lazy" />
                                                                <div class="floor-overlay">
                                                                    <span class="preview-btn">
                                                                        <i class="bi bi-arrows-angle-expand me-1"></i>
                                                                        Preview
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <div class="floor-body">
                                                            @if ($plan->title)
                                                                <h5 class="floor-title">{{ $plan->title }}</h5>
                                                            @endif

                                                            <div class="floor-meta-grid">
                                                                @if ($plan->configuration)
                                                                    <div class="meta-item">
                                                                        <span class="meta-label">Config</span>
                                                                        <span
                                                                            class="meta-val">{{ $plan->configuration }}</span>
                                                                    </div>
                                                                @endif

                                                                @if ($plan->area)
                                                                    <div class="meta-item">
                                                                        <span class="meta-label">Area</span>
                                                                        <span
                                                                            class="meta-val">{{ number_format($plan->area) }}
                                                                            {{ $plan->area_unit ?: 'sq.ft' }}</span>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            @if ($plan->price !== null)
                                                                <div class="floor-price-box">
                                                                    <span class="price-label">Starting Price</span>
                                                                    <span
                                                                        class="price-amount">₹{{ number_format($plan->price) }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- === PAYMENT PLANS === --}}
                            @if ($property->paymentPlans && $property->paymentPlans->count())
                                <div id="sec-payment-plans" class="detail-section-block card-modern ">
                                    <div class="card-body p-0">
                                        <h4 class="card-title mb-4">Payment Plans</h4>
                                        <div class="row g-3">
                                            @foreach ($property->paymentPlans as $plan)
                                                <div class="col-md-6">
                                                    <div class="plan-card-v2">
                                                        <div class="plan-v2-top">
                                                            <span class="plan-v2-badge">
                                                                <i class="bi bi-wallet2"></i> Option
                                                                {{ $loop->iteration }}
                                                            </span>
                                                            @if ($plan->title)
                                                                <h5 class="plan-v2-title">{{ $plan->title }}</h5>
                                                            @endif
                                                        </div>

                                                        @if ($plan->description)
                                                            <div class="plan-v2-body">
                                                                <p class="plan-v2-text">{{ $plan->description }}</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- === LANDMARKS === --}}
                            @if ($property->landmarks && $property->landmarks->count())
                                <div id="sec-landmarks" class="detail-section-block card-modern">
                                    <div class="card-body p-0">
                                        <h4 class="card-title mb-4">Nearby Landmarks</h4>
                                        <div class="row g-3">
                                            @foreach ($property->landmarks as $landmark)
                                                <div class="col-md-6">
                                                    <div class="landmark-card-v2">
                                                        <div class="landmark-v2-icon">
                                                            <i class="bi bi-geo-alt-fill"></i>
                                                        </div>
                                                        <div class="landmark-v2-content">
                                                            <span class="landmark-v2-title">
                                                                {{ $landmark->name ?? $landmark->title }}
                                                            </span>
                                                            @if (isset($landmark->distance) && $landmark->distance)
                                                                <span class="landmark-v2-distance">
                                                                    <i
                                                                        class="bi bi-pin-map me-1"></i>{{ $landmark->distance }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- === LOCATION === --}}
                            <div id="sec-location" class="detail-section-block card-modern ">
                                <div class="card-body p-0">
                                    <h4 class="card-title mb-4">Location</h4>
                                    <div class="location-v2-wrapper">
                                        @if ($property->address)
                                            <div class="location-v2-main mb-3">
                                                <div class="location-v2-icon"><i class="bi bi-geo-alt-fill"></i></div>
                                                <div class="location-v2-info">
                                                    <span class="location-v2-label">Address</span>
                                                    <p class="location-v2-address">{{ $property->address }}</p>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="location-v2-grid">
                                            @if ($property->city)
                                                <div class="location-v2-chip">
                                                    <span class="chip-label">City</span>
                                                    <span class="chip-val">{{ $property->city->name }}</span>
                                                </div>
                                            @endif

                                            @if ($property->state)
                                                <div class="location-v2-chip">
                                                    <span class="chip-label">State</span>
                                                    <span class="chip-val">{{ $property->state->name }}</span>
                                                </div>
                                            @endif

                                            @if ($property->pincode)
                                                <div class="location-v2-chip">
                                                    <span class="chip-label">Pincode</span>
                                                    <span class="chip-val mono-font">{{ $property->pincode }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        @if ($property->latitude || $property->longitude)
                                            <div class="location-v2-coords mt-3">
                                                <div class="coords-info">
                                                    <i class="bi bi-compass me-1"></i>
                                                    @if ($property->latitude)
                                                        <span>Lat: {{ $property->latitude }}</span>
                                                    @endif
                                                    @if ($property->latitude && $property->longitude)
                                                        <span class="mx-1.5">•</span>
                                                    @endif
                                                    @if ($property->longitude)
                                                        <span>Long: {{ $property->longitude }}</span>
                                                    @endif
                                                </div>
                                                @if ($property->latitude && $property->longitude)
                                                    <a href="https://www.google.com/maps?q={{ $property->latitude }},{{ $property->longitude }}"
                                                        target="_blank" rel="noopener noreferrer" class="coords-link">
                                                        Get Directions <i class="bi bi-box-arrow-up-right ms-1"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- === DOCUMENTS === --}}
                            @if ($property->documents && $property->documents->count())
                                <div id="sec-documents" class="detail-section-block card-modern">
                                    <div class="card-body p-0">
                                        <h4 class="card-title mb-4">Documents</h4>
                                        <div class="doc-v2-list">
                                            @foreach ($property->documents as $doc)
                                                @php
                                                    $docFile = $doc->file ?? ($doc->document ?? ($doc->path ?? null));
                                                    $ext = $docFile
                                                        ? strtolower(pathinfo($docFile, PATHINFO_EXTENSION))
                                                        : '';
                                                    $iconClass = match ($ext) {
                                                        'pdf' => 'bi-file-earmark-pdf-fill text-danger',
                                                        'doc', 'docx' => 'bi-file-earmark-word-fill text-primary',
                                                        'jpg',
                                                        'jpeg',
                                                        'png',
                                                        'webp'
                                                            => 'bi-file-earmark-image-fill text-success',
                                                        default => 'bi-file-earmark-text-fill text-warning',
                                                    };
                                                @endphp

                                                @if ($docFile)
                                                    <a href="{{ asset('storage/properties/documents/' . $docFile) }}"
                                                        target="_blank" rel="noopener noreferrer" class="doc-card-v2">
                                                        <div class="doc-v2-icon">
                                                            <i class="bi {{ $iconClass }}"></i>
                                                        </div>

                                                        <div class="doc-v2-info">
                                                            <span class="doc-v2-title">
                                                                {{ $doc->title ?? ($doc->name ?? 'Property Document') }}
                                                            </span>
                                                            <span class="doc-v2-meta">
                                                                {{ strtoupper($ext ?: 'FILE') }} • Tap to view or download
                                                            </span>
                                                        </div>

                                                        <div class="doc-v2-action">
                                                            <span class="doc-v2-btn">
                                                                View <i class="bi bi-arrow-right ms-1"></i>
                                                            </span>
                                                        </div>
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                    {{-- end left column --}}


                    {{-- ============================================================
    RIGHT COLUMN — SIDEBAR
    ============================================================ --}}
                    <div class="col-lg-4">

                        <div class="sidebar-sticky-v3">
                            {{-- Ambient Decorative Glows --}}
                            <div class="sidebar-ambient-glow glow-1"></div>
                            <div class="sidebar-ambient-glow glow-2"></div>

                            <div class="card-sidebar-v3">
                                <div class="sidebar-v3-inner">

                                    {{-- Top Hero Header --}}
                                    <div class="sidebar-v3-header">
                                        <div class="header-badge-title">
                                            <span class="header-icon-box">
                                                <i class="bi bi-lightning-charge-fill"></i>
                                            </span>
                                            <div>
                                                <h5 class="header-v3-title">Instant Inquiry</h5>
                                                <p class="header-v3-subtitle">Direct Connect with Owner</p>
                                            </div>
                                        </div>
                                        <div class="live-pill">
                                            <span class="pulse-dot"></span>

                                        </div>
                                    </div>

                                    {{-- Owner / Lister Glass Card --}}
                                    @if ($property->user)
                                        <div class="lister-hero-v3">
                                            <div class="lister-avatar-ring">
                                                <div class="lister-avatar-inner">
                                                    <i class="bi bi-person-fill"></i>
                                                </div>
                                                <div class="verified-badge-v3" title="Verified Owner">
                                                    <i class="bi bi-patch-check-fill"></i>
                                                </div>
                                            </div>
                                            <div class="lister-meta">
                                                <h6 class="lister-name-v3">{{ $property->user->name }}</h6>
                                                <div class="lister-tags">
                                                    <span class="role-chip"><i
                                                            class="bi bi-shield-check me-1"></i>Property Owner</span>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Interactive Contact Grid --}}
                                        <div class="contact-grid-v3">
                                            @if ($property->user->phone)
                                                <a href="tel:{{ $property->user->phone }}"
                                                    class="contact-tile-v3 phone-tile">
                                                    <div class="tile-icon-box">
                                                        <i class="bi bi-telephone-fill"></i>
                                                    </div>
                                                    <div class="tile-info">
                                                        <span class="tile-label">Call Direct</span>
                                                        <span class="tile-val">{{ $property->user->phone }}</span>
                                                    </div>
                                                    <i class="bi bi-chevron-right tile-arrow"></i>
                                                </a>
                                            @endif

                                            @if ($property->user->email)
                                                <a href="mailto:{{ $property->user->email }}?subject={{ urlencode('Property Enquiry - ' . $property->title) }}"
                                                    class="contact-tile-v3 email-tile">
                                                    <div class="tile-icon-box">
                                                        <i class="bi bi-envelope-open-fill"></i>
                                                    </div>
                                                    <div class="tile-info">
                                                        <span class="tile-label">Email Owner</span>
                                                        <span
                                                            class="tile-val text-truncate">{{ $property->user->email }}</span>
                                                    </div>
                                                    <i class="bi bi-chevron-right tile-arrow"></i>
                                                </a>
                                            @endif
                                        </div>
                                    @endif

                                    {{-- Vibrant High-Conversion Action Buttons --}}
                                    <div class="cta-stack-v3">
                                        @if ($property->user && $property->user->phone)
                                            <a href="tel:{{ $property->user->phone }}" class="btn-v3-primary">
                                                <span class="btn-gradient-overlay"></span>
                                                <span class="btn-content">
                                                    <i class="bi bi-telephone-outbound-fill"></i>
                                                    <span>Call Owner Now</span>
                                                </span>
                                                <span class="btn-flare"></span>
                                            </a>
                                        @endif

                                        @if ($property->user && $property->user->email)
                                            <a href="mailto:{{ $property->user->email }}?subject={{ urlencode('Property Enquiry - ' . $property->title) }}"
                                                class="btn-v3-secondary">
                                                <i class="bi bi-chat-left-text-fill"></i>
                                                <span>Send Quick Message</span>
                                            </a>
                                        @endif
                                    </div>

                                    {{-- Decorative Accent Divider --}}
                                    <div class="divider-v3">
                                        <span>Quick Snapshot</span>
                                    </div>

                                    {{-- Elevated Metadata Grid --}}
                                    <div class="meta-card-v3">
                                        <div class="meta-item-v3">
                                            <span class="meta-label-v3"><i class="bi bi-qr-code"></i> Ref Code</span>
                                            <span
                                                class="meta-pill-v3 code-pill">{{ $property->property_code ?? 'N/A' }}</span>
                                        </div>

                                        <div class="meta-item-v3">
                                            <span class="meta-label-v3"><i class="bi bi-tag-fill"></i> Purpose</span>
                                            <span class="meta-pill-v3 type-pill">
                                                @isset($property->listing_type)
                                                    {{ [
                                                        'sale' => 'For Sale',
                                                        'rent' => 'For Rent',
                                                        'lease' => 'For Lease',
                                                    ][$property->listing_type] ?? ucfirst($property->listing_type) }}
                                                @endisset
                                            </span>
                                        </div>

                                        <div class="meta-item-v3">
                                            <span class="meta-label-v3"><i class="bi bi-calendar2-check-fill"></i>
                                                Posted</span>
                                            <span
                                                class="meta-val-v3">{{ $property->created_at?->format('d M Y') ?? 'Recently' }}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- end sidebar --}}


                </div>
                {{-- end row --}}


            </div>
        </div>
        {{-- end container --}}




        <section class="pp-owner-section py-5 bg-white">
            <div class="container-xl">

                <!-- Section Header with Right Side View All Link -->
                <div class="d-flex justify-content-between align-items-end mb-4 pp-section-head">
                    <div>
                        <span class="pp-eyebrow-pill">— Verified Listings —</span>
                        <h2 class="pp-title mt-2 mb-1">
                            Premium Properties in <span
                                class="gradient-text animated-gradient">{{ $property->city->name ?? 'Similar Projects' }}</span>
                        </h2>
                        <p class="pp-subtitle mb-0">Direct owner listings in the same city.</p>
                    </div>


                    <a href="{{ $property->city ? route('properties.city', $property->city->slug) : route('properties.index') }}"
                        class="pp-btn-link d-inline-flex align-items-center">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>

                <!-- 4-Column Bootstrap Grid -->
                <div class="row g-3 g-lg-4">

                    @forelse($similarProperties ?? [] as $similarProp)
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="pp-prop-card-sm h-100">

                                <!-- Image Media Wrapper -->
                                <div class="pp-card-media">
                                    @if ($similarProp->featured_image)
                                        <img src="{{ asset('storage/properties/featured/' . $similarProp->featured_image) }}"
                                            alt="{{ $similarProp->title }}" loading="lazy">
                                    @else
                                        <img src="https://picsum.photos/seed/owner-{{ $similarProp->id }}/480/320"
                                            alt="{{ $similarProp->title }}" loading="lazy">
                                    @endif

                                    <!-- Photo Count & Owner Badges -->
                                    <div class="pp-media-badges">
                                        <span class="pp-badge-photos">
                                            <i
                                                class="bi bi-camera me-1"></i>{{ $similarProp->photos_count ?? rand(8, 15) }}
                                        </span>
                                    </div>
                                    <span class="pp-badge-owner">Owner</span>
                                </div>

                                <!-- Card Body -->
                                <div class="pp-card-body">
                                    <h5 class="pp-card-title text-truncate mb-1" title="{{ $similarProp->title }}">
                                        {{ $similarProp->title }}
                                    </h5>

                                    <div class="pp-card-price mb-1">
                                        ₹{{ number_format($similarProp->price) }}
                                    </div>

                                    <p class="pp-card-location text-truncate mb-3">
                                        <i
                                            class="bi bi-geo-alt me-1"></i>{{ $similarProp->locality ?? $similarProp->title }},
                                        {{ $similarProp->city->name ?? '' }}
                                    </p>

                                    <!-- Footer Details -->
                                    <div
                                        class="pp-card-specs d-flex align-items-center justify-content-between pt-2 border-top mt-auto">
                                        <span class="pp-status-tag">
                                            <i
                                                class="bi bi-check-circle-fill me-1 text-success"></i>{{ ucfirst($similarProp->availability ?? 'Ready to Move') }}
                                        </span>

                                        <a href="{{ route('properties.city.slug', [$similarProp->city->slug, $similarProp->slug]) }}"
                                            class="pp-view-details-link">
                                            View Details
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @empty
                        {{-- अगर उसी शहर में कोई और प्रॉपर्टी नहीं है --}}
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">No similar properties found in
                                {{ $property->city->name ?? 'this area' }}.</p>
                        </div>
                    @endforelse

                </div>

            </div>
        </section>


        <!-- ============================================================
                                    GALLERY MODAL (Bootstrap Carousel)
                                    ============================================================ -->
        <div class="modal modal-gallery fade" id="galleryModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">

                    {{-- Header with close --}}
                    <div class="modal-header border-0 position-absolute top-0 end-0 z-3 p-3">
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    {{-- Body with carousel --}}
                    <div class="modal-body p-0">

                        <div id="galleryCarousel" class="carousel slide h-100" data-bs-ride="false">

                            {{-- Indicators --}}
                            <div class="carousel-indicators">
                                {{-- Featured image indicator --}}
                                <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="0"
                                    class="active" aria-current="true"></button>

                                @foreach ($allGalleryImages as $index => $image)
                                    <button type="button" data-bs-target="#galleryCarousel"
                                        data-bs-slide-to="{{ $index + 1 }}"></button>
                                @endforeach
                            </div>

                            {{-- Slides --}}
                            <div class="carousel-inner h-100">

                                {{-- Slide 0: Featured Image --}}
                                <div class="carousel-item active h-100">
                                    @if ($property->featured_image)
                                        <img src="{{ asset('storage/properties/featured/' . $property->featured_image) }}"
                                            alt="{{ $property->title }}" class="d-block w-100 h-100"
                                            style="object-fit:contain;" />
                                    @else
                                        <div
                                            class="h-100 w-100 d-flex align-items-center justify-content-center text-white">
                                            <i class="bi bi-image fs-1 opacity-50"></i>
                                        </div>
                                    @endif
                                </div>

                                {{-- Slides: Gallery Images --}}
                                @foreach ($allGalleryImages as $image)
                                    <div class="carousel-item h-100">
                                        <img src="{{ asset('storage/properties/gallery/' . $image->image) }}"
                                            alt="{{ $property->title }}" class="d-block w-100 h-100"
                                            style="object-fit:contain;" loading="lazy" />
                                    </div>
                                @endforeach

                            </div>

                            {{-- Controls --}}
                            <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>

                        </div>

                    </div>

                </div>
            </div>
        </div>





        {{-- =========================================================
PROPERTY DETAIL
========================================================= --}}









    </main>

    {{-- =========================================================
PROPERTY GALLERY MODAL
========================================================= --}}






    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navLinks = document.querySelectorAll("#propertySubNav .nav-link");
            const sections = document.querySelectorAll(".detail-section-block");
            const navContainer = document.querySelector(".property-sticky-nav");

            if (!sections.length || !navLinks.length) return;

            // 1. Smooth Scroll on Click
            navLinks.forEach((link) => {
                link.addEventListener("click", function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute("href");
                    const targetSection = document.querySelector(targetId);

                    if (targetSection) {
                        targetSection.scrollIntoView({
                            behavior: "smooth",
                            block: "start",
                        });
                    }
                });
            });

            // 2. Dynamic ScrollSpy Active Toggle
            function onScroll() {
                let currentSectionId = "";
                const scrollPosition = window.scrollY + 180; // Offset for trigger point

                sections.forEach((section) => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;

                    if (
                        scrollPosition >= sectionTop &&
                        scrollPosition < sectionTop + sectionHeight
                    ) {
                        currentSectionId = section.getAttribute("id");
                    }
                });

                if (currentSectionId) {
                    navLinks.forEach((link) => {
                        link.classList.remove("active");
                        if (link.getAttribute("href") === `#${currentSectionId}`) {
                            link.classList.add("active");

                            // Auto scroll menu bar horizontally to active item on mobile
                            if (navContainer) {
                                const linkRect = link.getBoundingClientRect();
                                const navRect = navContainer.getBoundingClientRect();
                                if (
                                    linkRect.left < navRect.left ||
                                    linkRect.right > navRect.right
                                ) {
                                    link.scrollIntoView({
                                        behavior: "smooth",
                                        inline: "center",
                                        block: "nearest",
                                    });
                                }
                            }
                        }
                    });
                }
            }

            window.addEventListener("scroll", onScroll, {
                passive: true
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof $ !== 'undefined' && $('.floor-plan-carousel').length) {
                $('.floor-plan-carousel').owlCarousel({
                    loop: true,
                    margin: 20,
                    nav: true,
                    dots: true,
                    autoplay: false,
                    autoplayTimeout: 4000,
                    smartSpeed: 800,
                    items: 1
                });
            }
        });
    </script>


@endsection
