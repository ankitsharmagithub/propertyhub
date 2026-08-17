@extends('layouts.frontend.app')

@section('title', $property->title . ' | Property Portal')

@section('meta_description', Str::limit(strip_tags($property->description ?? $property->title), 155))

@section('content')


<section class="py-3 border-bottom bg-light">


<div class="container">

    <nav aria-label="breadcrumb">

        <ol class="breadcrumb mb-0">

            <li class="breadcrumb-item">
                <a href="{{ route('home') }}">
                    Home
                </a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{ route('properties.index') }}">
                    Properties
                </a>
            </li>

            <li class="breadcrumb-item active">
                {{ $property->title }}
            </li>

        </ol>

    </nav>

</div>


</section>

<section class="py-5">


<div class="container">

  
    <div class="row g-3 mb-5">

        <div class="col-lg-8">

            @php

                $featuredImage = $property->featured_image
                    ? asset(
                        'storage/properties/featured/' .
                        $property->featured_image
                    )
                    : null;

            @endphp


            @if($featuredImage)

                <img
                    src="{{ $featuredImage }}"
                    alt="{{ $property->title }}"
                    class="img-fluid rounded shadow-sm w-100"
                    style="height: 500px; object-fit: cover;"
                >

            @else

                <div
                    class="bg-light rounded d-flex align-items-center justify-content-center"
                    style="height: 500px;"
                >

                    <div class="text-center text-muted">

                        <i class="bi bi-image fs-1"></i>

                        <p class="mb-0">
                            No Image Available
                        </p>

                    </div>

                </div>

            @endif

        </div>


        <div class="col-lg-4">

            <div class="row g-3">

                @if($property->images && $property->images->count())

                    @foreach($property->images->take(4) as $image)

                        <div class="col-6">

                            <img
                                src="{{ asset('storage/properties/gallery/' . $image->image) }}"
                                alt="{{ $property->title }}"
                                class="img-fluid rounded shadow-sm w-100"
                                style="height: 238px; object-fit: cover;"
                            >

                        </div>

                    @endforeach

                @else

                    @for($i = 0; $i < 4; $i++)

                        <div class="col-6">

                            <div
                                class="bg-light rounded d-flex align-items-center justify-content-center"
                                style="height: 238px;"
                            >

                                <i class="bi bi-image text-muted fs-3"></i>

                            </div>

                        </div>

                    @endfor

                @endif

            </div>

        </div>

    </div>


    <div class="row g-5">

     
        <div class="col-lg-8">

            {{-- Property Header --}}

            <div class="mb-4">

                <div class="d-flex flex-wrap gap-2 mb-3">

                    @if($property->availability)

                        <span class="badge bg-success">
                            {{ ucfirst($property->availability) }}
                        </span>

                    @endif

                    @if($property->featured)

                        <span class="badge bg-primary">
                            Featured
                        </span>

                    @endif

                </div>


                <h1 class="fw-bold mb-3">
                    {{ $property->title }}
                </h1>


                <p class="text-muted mb-2">

                    <i class="bi bi-geo-alt"></i>

                    {{ $property->city->name ?? '' }}

                    @if($property->city && $property->state)
                        ,
                    @endif

                    {{ $property->state->name ?? '' }}

                </p>


                @if($property->property_code)

                    <small class="text-muted">
                        Property Code:
                        <strong>
                            {{ $property->property_code }}
                        </strong>
                    </small>

                @endif

            </div>


            {{-- Price --}}

            @if($property->price)

                <div class="mb-4">

                    <h2 class="fw-bold text-primary mb-0">
                        ₹{{ number_format($property->price) }}
                    </h2>

                </div>

            @endif


            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body">

                    <h4 class="fw-bold mb-4">
                        Property Details
                    </h4>

                    <div class="row g-4">

                        @if($property->propertyType)

                            <div class="col-6 col-md-4">

                                <div class="text-muted small">
                                    Property Type
                                </div>

                                <div class="fw-semibold">
                                    {{ $property->propertyType->name }}
                                </div>

                            </div>

                        @endif


                        @if($property->category)

                            <div class="col-6 col-md-4">

                                <div class="text-muted small">
                                    Category
                                </div>

                                <div class="fw-semibold">
                                    {{ $property->category->name }}
                                </div>

                            </div>

                        @endif


                        @if($property->bedrooms)

                            <div class="col-6 col-md-4">

                                <div class="text-muted small">
                                    Bedrooms
                                </div>

                                <div class="fw-semibold">
                                    {{ $property->bedrooms }}
                                </div>

                            </div>

                        @endif


                        @if($property->bathrooms)

                            <div class="col-6 col-md-4">

                                <div class="text-muted small">
                                    Bathrooms
                                </div>

                                <div class="fw-semibold">
                                    {{ $property->bathrooms }}
                                </div>

                            </div>

                        @endif


                        @if($property->area)

                            <div class="col-6 col-md-4">

                                <div class="text-muted small">
                                    Area
                                </div>

                                <div class="fw-semibold">
                                    {{ number_format($property->area) }}
                                    sq.ft
                                </div>

                            </div>

                        @endif


                        @if($property->city)

                            <div class="col-6 col-md-4">

                                <div class="text-muted small">
                                    City
                                </div>

                                <div class="fw-semibold">
                                    {{ $property->city->name }}
                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            </div>


            {{-- Description --}}

            @if($property->description)

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body">

                        <h4 class="fw-bold mb-3">
                            Description
                        </h4>

                        <div class="text-muted">

                            {!! nl2br(e($property->description)) !!}

                        </div>

                    </div>

                </div>

            @endif


           

            @if($property->amenities && $property->amenities->count())

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body">

                        <h4 class="fw-bold mb-4">
                            Amenities
                        </h4>

                        <div class="row g-3">

                            @foreach($property->amenities as $amenity)

                                <div class="col-6 col-md-4">

                                    <div class="d-flex align-items-center">

                                        <i class="bi bi-check-circle-fill text-success me-2"></i>

                                        <span>
                                            {{ $amenity->name }}
                                        </span>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            @endif


    

            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body">

                    <h4 class="fw-bold mb-4">
                        Location
                    </h4>

                    <p class="mb-1">

                        <strong>City:</strong>

                        {{ $property->city->name ?? '-' }}

                    </p>

                    <p class="mb-1">

                        <strong>State:</strong>

                        {{ $property->state->name ?? '-' }}

                    </p>

                    @if($property->address)

                        <p class="mb-0">

                            <strong>Address:</strong>

                            {{ $property->address }}

                        </p>

                    @endif

                </div>

            </div>

        </div>


        <div class="col-lg-4">

            <div
                class="card border-0 shadow-sm sticky-lg-top"
                style="top: 90px;"
            >

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Interested in this property?
                    </h4>


                    {{-- Owner --}}

                    @if($property->user)

                        <div class="d-flex align-items-center mb-4">

                            <div
                                class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center me-3"
                                style="width: 50px; height: 50px;"
                            >

                                <i class="bi bi-person fs-4"></i>

                            </div>

                            <div>

                                <div class="fw-semibold">
                                    {{ $property->user->name }}
                                </div>

                                <small class="text-muted">
                                    Property Owner
                                </small>

                            </div>

                        </div>

                    @endif


                    {{-- Contact Buttons --}}

                    <div class="d-grid gap-2">

                        @if($property->user && $property->user->phone)

                            <a
                                href="tel:{{ $property->user->phone }}"
                                class="btn btn-primary"
                            >
                                <i class="bi bi-telephone me-2"></i>
                                Call Owner
                            </a>

                        @endif


                        <a
                            href="#"
                            class="btn btn-outline-primary"
                        >
                            <i class="bi bi-envelope me-2"></i>
                            Send Enquiry
                        </a>

                    </div>


                    <hr class="my-4">


                    <div class="small text-muted">

                        <div class="d-flex justify-content-between mb-2">

                            <span>
                                Property Code
                            </span>

                            <strong>
                                {{ $property->property_code ?? '-' }}
                            </strong>

                        </div>


                        <div class="d-flex justify-content-between">

                            <span>
                                Listed On
                            </span>

                            <strong>
                                {{ $property->created_at?->format('d M Y') }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


</section>


<section class="py-5 bg-light">

<div class="container">

    <div class="text-center">

        <h3 class="fw-bold">
            Looking for more properties?
        </h3>

        <p class="text-muted">
            Explore our complete property listings.
        </p>

        <a
            href="{{ route('properties.index') }}"
            class="btn btn-primary"
        >
            Browse All Properties
        </a>

    </div>

</div>


</section>

@endsection
