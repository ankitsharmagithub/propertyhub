@extends('layouts.frontend.app')

@section('title', $developer->name . ' - Properties')

@section('meta_description',
    'Browse properties listed by ' .
    $developer->name .
    '. Find homes, apartments, and
    commercial properties.')

@section('content')

    {{-- =========================================================
    1. FULL WIDTH DEVELOPER BANNER
    ========================================================= --}}
    @if ($developer->image)
        <div class="developer-banner w-100 position-relative"
            style="height: 450px; background-image: url('{{ asset('storage/' . $developer->image) }}'); background-size: cover; background-position: center;">

            {{-- Text Overlay --}}
            <div class="d-flex align-items-center justify-content-center h-100">
                <h1 class="text-white display-3 fw-bold text-uppercase"
                    style="text-shadow: 0 2px 10px rgba(0,0,0,0.3); letter-spacing: 2px;">
                    {{ $developer->name }}
                </h1>
            </div>
        </div>
    @else
        <div class="bg-light w-100 py-5 text-center border-bottom">
            <h1 class="display-4 fw-bold text-dark">{{ $developer->name }}</h1>
        </div>
    @endif


    {{-- =========================================================
    2. BREADCRUMB SECTION
    ========================================================= --}}
    <div class="container py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none text-secondary">Home</a>
                </li>
                <li class="breadcrumb-item text-secondary">Builder</li>
                <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">
                    {{ $developer->name }}
                </li>
            </ol>
        </nav>
    </div>


    <div class="container">
        <div class="property-filter-section mb-4">
            <div class="filter-card">
                <form action="{{ route('developer.detail', $developer->slug) }}" method="GET">
                    <div class="row g-3 align-items-end">

                        {{-- Search Input --}}
                        <div class="col-lg-3">
                            <label class="filter-label">
                                <i class="bi bi-search me-1"></i> Search
                            </label>
                            <div class="input-icon-group">
                                <i class="bi bi-search input-icon"></i>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control filter-control" placeholder="Search property title or code...">
                            </div>
                        </div>

                        {{-- State Dropdown --}}
                        <div class="col-md-6 col-lg-2">
                            <label class="filter-label">
                                <i class="bi bi-geo-alt me-1"></i> State
                            </label>
                            <select name="state_id" class="form-select filter-control">
                                <option value="">All States</option>
                                @foreach (\App\Models\State::where('status', 1)->orderBy('name')->get() as $state)
                                    <option value="{{ $state->id }}" @selected(request('state_id') == $state->id)>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- City Dropdown --}}
                        <div class="col-md-6 col-lg-2">
                            <label class="filter-label">
                                <i class="bi bi-building me-1"></i> City
                            </label>
                            <select name="city_id" class="form-select filter-control">
                                <option value="">All Cities</option>
                                @foreach (\App\Models\City::where('status', 1)->orderBy('name')->get() as $city)
                                    <option value="{{ $city->id }}" @selected(request('city_id') == $city->id)>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Property Type Dropdown --}}
                        <div class="col-md-6 col-lg-2">
                            <label class="filter-label">
                                <i class="bi bi-house me-1"></i> Property Type
                            </label>
                            <select name="property_type_id" class="form-select filter-control">
                                <option value="">All Types</option>
                                @foreach (\App\Models\PropertyType::where('status', 1)->orderBy('name')->get() as $type)
                                    <option value="{{ $type->id }}" @selected(request('property_type_id') == $type->id)>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="col-md-6 col-lg-3 d-flex gap-2">
                            <button type="submit" class="btn btn-filter-submit flex-grow-1">
                                <i class="bi bi-funnel-fill me-1"></i> Filter
                            </button>

                            <a href="{{ route('developer.detail', $developer->slug) }}" class="btn btn-filter-reset"
                                title="Reset Search Filters">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- =========================================================
    5. DEVELOPER PROPERTY LISTING
    ========================================================= --}}
    <div class="container pb-5">
        @if ($properties->count())
            <div class="row g-4">
                {{-- Main Listing Column --}}
                <div class="col-lg-9">
                    <div class="property-listing">
                        @foreach ($properties as $property)
                            <div class="property-card-horizontal">
                                {{-- Media / Image Container --}}
                                <div class="property-media">
                                    <div class="media-agency-tag">
                                        <i class="bi bi-building me-1"></i>
                                        <span>{{ $property->agency_name ?? ucfirst($developer->name) }}</span>
                                    </div>

                                    <img src="{{ asset('storage/properties/featured/' . $property->featured_image) }}"
                                        class="property-img">

                                    <div class="media-badges">
                                        <span class="badge-verified">
                                            <i class="bi bi-patch-check-fill"></i> Verified
                                        </span>
                                        <span class="media-counter">1/12</span>
                                    </div>
                                </div>

                                {{-- Property Content Details --}}
                                <div class="property-content">
                                    <div class="content-header">
                                        <span class="badge-tag">{{ $property->type_label ?? 'New Booking' }}</span>
                                        <h3 class="property-title">
                                            <a
                                                href="{{ route('properties.city.slug', [$property->city->slug, $property->slug]) }}">
                                                {{ $property->title }}
                                            </a>
                                        </h3>
                                    </div>

                                    {{-- Property Stats Grid --}}
                                    <div class="property-stats-grid">
                                        <div class="stat-item">
                                            <div class="stat-value">₹{{ $property->price ?? '00.0 L' }}</div>

                                        </div>
                                        <div class="stat-item border-start ps-3">
                                            <div class="stat-value">{{ $property->area ?? '0' }} sq.ft</div>
                                            <div class="stat-label">Builtup area</div>
                                        </div>
                                        <div class="stat-item border-start ps-3">
                                            <div class="stat-value">
                                                {{ ucfirst($property->availability) ?? 'Ready to move' }}
                                            </div>
                                            <div class="stat-label">Possession status</div>
                                        </div>
                                    </div>

                                    {{-- Amenities / Highlights --}}
                                    <div class="property-highlights">
                                        <span class="text-muted fw-semibold">Aminities:</span>
                                        <span>
                                            @if ($property->amenities && $property->amenities->isNotEmpty())
                                                {{ $property->amenities->pluck('name')->implode(' • ') }}
                                            @else
                                                {{ $property->highlights ?? 'Fresh Construction • Natural Light • Lift • Parking' }}
                                            @endif
                                        </span>
                                    </div>

                                    {{-- Action Bar Footer --}}
                                    <div class="property-footer">
                                        <div class="updated-time">
                                            Updated {{ $property->updated_at?->diffForHumans() ?? '2w ago' }}
                                        </div>
                                        <div class="action-buttons">
                                            <a href="{{ route('properties.city.slug', [$property->city->slug, $property->slug]) }}"
                                                class="btn-contact">
                                                Contact
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $properties->links() }}
                    </div>
                </div>

                {{-- Right Promo Sidebar --}}
                <div class="col-lg-3">
                    <div class="property-sidebar-card sticky-top" style="top: 90px; z-index: 10;">
                        <img src="{{ asset('storage/img/sideimg.jpg') }}" class="img-fluid"
                            alt="Modern luxury villa with pool at dusk">
                    </div>
                </div>
            </div>
        @else
            {{-- Empty State --}}
            <div class="property-empty-card card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="fs-1 text-muted mb-3">
                        <i class="bi bi-house-x"></i>
                    </div>
                    <h4 class="fw-bold">No Properties Found</h4>
                    <p class="text-muted mb-4">
                        We couldn't find any property matching your search criteria for
                        <strong>{{ $developer->name }}</strong>.
                    </p>
                    <a href="{{ route('developer.detail', $developer->slug) }}" class="btn btn-primary px-4 py-2">
                        View All Properties
                    </a>
                </div>
            </div>
        @endif
    </div>

@endsection
