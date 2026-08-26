@extends('layouts.frontend.app')

@section('title', 'Properties')

@section('meta_description',
    'Browse properties for sale and rent. Find homes, apartments, plots and commercial
    properties.')

@section('content')



    {{-- =========================================================
PAGE HEADER
========================================================= --}}




    <section class="inner-hero py-5">

        <div class="container-xl hero-content pb-0">

            <div class="row justify-content-center">


                <div class="property-filter-section py-4">
                    <div class="container">
                        <div class="filter-card">
                            <form action="{{ route('properties.index') }}" method="GET">
                                <div class="row g-3 align-items-end">

                                    {{-- Search Input --}}
                                    <div class="col-lg-3">
                                        <label class="filter-label">
                                            <i class="bi bi-search me-1"></i> Search
                                        </label>
                                        <div class="input-icon-group">
                                            <i class="bi bi-search input-icon"></i>
                                            <input type="text" name="search" value="{{ request('search') }}"
                                                class="form-control filter-control"
                                                placeholder="Search property title or code...">
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

                                        <a href="{{ route('properties.index') }}" class="btn btn-filter-reset"
                                            title="Reset Search Filters">
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                        </a>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </section>


    <div class="property-listing-wrapper container py-4">
        @if ($properties->count())
            <div class="row g-4">
                {{-- Main Listing Column (Left - 8 Cols) --}}
                <div class="col-lg-9">
                    <div class="property-listing">
                        @foreach ($properties as $property)
                            <div class="property-card-horizontal">
                                {{-- Media / Image Container (Left Side) --}}
                                <div class="property-media">
                                    {{-- Agency/Builder Header Banner --}}
                                    <div class="media-agency-tag">
                                        <i class="bi bi-building me-1"></i>
                                        <span></span>
                                    </div>

                                    {{-- Property Image --}}
                                    <img src="{{ asset('storage/properties/featured/' . $property->featured_image) }}   "
                                        class="property-img">

                                    {{-- Media Footer Badges --}}
                                    <div class="media-badges">
                                        <span class="badge-verified">
                                            <i class="bi bi-patch-check-fill"></i> Verified
                                        </span>
                                        <span class="media-counter">1/12</span>
                                    </div>
                                </div>

                                {{-- Property Content Details (Right Side) --}}
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
                                            <div class="stat-value">₹{{ $property->price ?? '0.0 L' }}</div>
                                            <div class="stat-label">Avg. price:
                                                ₹{{ $property->avg_price ?? '6.52k' }}/sq.ft</div>
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
                                        <span class="text-muted fw-semibold">Highlights:</span>
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

                {{-- Right Promo Sidebar (4 Cols - Housing.com style) --}}
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
                        We couldn't find any property matching your search criteria.
                    </p>
                    <a href="{{ route('properties.index') }}" class="btn btn-primary px-4 py-2">
                        View All Properties
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- <section class="pb-5">


                            <div class="container">

                                @if ($properties->count())

                                    <div class="row g-4">

                                        @foreach ($properties as $property)
    <div class="col-md-6 col-lg-4">

                                                <x-frontend.property-card
                                                    :property="$property"
                                                />

                                            </div>
    @endforeach

                                    </div>


                                    {{-- Pagination --}}

                                    <div class="mt-5 d-flex justify-content-center">

                                        {{ $properties->links() }}

                                    </div>
@else
    <div class="card border-0 shadow-sm">

                                        <div class="card-body text-center py-5">

                                            <div class="fs-1 text-muted mb-3">
                                                <i class="bi bi-house-x"></i>
                                            </div>

                                            <h4 class="fw-bold">
                                                No Properties Found
                                            </h4>

                                            <p class="text-muted mb-4">
                                                We couldn't find any property matching
                                                your search criteria.
                                            </p>

                                            <a
                                                href="{{ route('properties.index') }}"
                                                class="btn btn-primary"
                                            >
                                                View All Properties
                                            </a>

                                        </div>

                                    </div>

                                @endif

                            </div>


                            </section> -->

@endsection
