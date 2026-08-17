@extends('layouts.frontend.app')

@section('title', 'Properties')

@section('meta_description', 'Browse properties for sale and rent. Find homes, apartments, plots and commercial properties.')

@section('content')

{{-- =========================================================
PAGE HEADER
========================================================= --}}

<section class="py-5 bg-light">

<div class="container">

    <div class="row align-items-center">

        <div class="col-lg-8">

            <span class="text-primary fw-semibold">
                Property Listings
            </span>

            <h1 class="fw-bold mt-2 mb-2">
                Find Your Perfect Property
            </h1>

            <p class="text-muted mb-0">
                Explore properties available for sale and rent.
            </p>

        </div>

        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">

            <span class="text-muted">
                {{ $properties->total() }} Properties Found
            </span>

        </div>

    </div>

</div>


</section>

{{-- =========================================================
SEARCH / FILTER
========================================================= --}}

<section class="py-4">


<div class="container">

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('properties.index') }}"
                method="GET"
            >

                <div class="row g-3">

                    {{-- Search --}}

                    <div class="col-lg-4">

                        <label class="form-label fw-semibold">
                            Search
                        </label>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="Search property title or code"
                        >

                    </div>


                    {{-- State --}}

                    <div class="col-md-6 col-lg-2">

                        <label class="form-label fw-semibold">
                            State
                        </label>

                        <select
                            name="state_id"
                            class="form-select"
                        >

                            <option value="">
                                All States
                            </option>

                            @foreach(
                                \App\Models\State::where('status', 1)
                                    ->orderBy('name')
                                    ->get()
                                as $state
                            )

                                <option
                                    value="{{ $state->id }}"
                                    @selected(
                                        request('state_id') == $state->id
                                    )
                                >
                                    {{ $state->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- City --}}

                    <div class="col-md-6 col-lg-2">

                        <label class="form-label fw-semibold">
                            City
                        </label>

                        <select
                            name="city_id"
                            class="form-select"
                        >

                            <option value="">
                                All Cities
                            </option>

                            @foreach(
                                \App\Models\City::where('status', 1)
                                    ->orderBy('name')
                                    ->get()
                                as $city
                            )

                                <option
                                    value="{{ $city->id }}"
                                    @selected(
                                        request('city_id') == $city->id
                                    )
                                >
                                    {{ $city->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Property Type --}}

                    <div class="col-md-6 col-lg-2">

                        <label class="form-label fw-semibold">
                            Property Type
                        </label>

                        <select
                            name="property_type_id"
                            class="form-select"
                        >

                            <option value="">
                                All Types
                            </option>

                            @foreach(
                                \App\Models\PropertyType::where('status', 1)
                                    ->orderBy('name')
                                    ->get()
                                as $type
                            )

                                <option
                                    value="{{ $type->id }}"
                                    @selected(
                                        request('property_type_id') == $type->id
                                    )
                                >
                                    {{ $type->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Buttons --}}

                    <div class="col-md-6 col-lg-2 d-flex align-items-end gap-2">

                        <button
                            type="submit"
                            class="btn btn-primary flex-grow-1"
                        >
                            <i class="bi bi-search"></i>
                            Search
                        </button>

                        <a
                            href="{{ route('properties.index') }}"
                            class="btn btn-outline-secondary"
                            title="Reset"
                        >
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>


</section>

{{-- =========================================================
PROPERTY LISTING
========================================================= --}}

<section class="pb-5">


<div class="container">

    @if($properties->count())

        <div class="row g-4">

            @foreach($properties as $property)

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


</section>

@endsection
