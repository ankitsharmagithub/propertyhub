@extends('layouts.frontend.app')

@section('title', ($property->meta_title ?: $property->title) . ' | Property Portal')

@section(
    'meta_description',
    $property->meta_description
        ?: Str::limit(
            strip_tags($property->description ?? $property->title),
            155
        )
)

@section('content')

{{-- =========================================================
BREADCRUMB
========================================================= --}}

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


{{-- =========================================================
PROPERTY DETAIL
========================================================= --}}

<section class="py-5">

    <div class="container">


        {{-- =====================================================
        IMAGE GALLERY
        ===================================================== --}}

        <div class="row g-3 mb-5">

            {{-- Featured Image --}}

            <div class="col-lg-8">

                @if($property->featured_image)

                    <img
                        src="{{ asset(
                            'storage/properties/featured/' .
                            $property->featured_image
                        ) }}"
                        alt="{{ $property->title }}"
                        class="img-fluid rounded shadow-sm w-100"
                        style="
                            height:500px;
                            object-fit:cover;
                        "
                    >

                @else

                    <div
                        class="bg-light rounded d-flex align-items-center justify-content-center"
                        style="height:500px;"
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


            {{-- Gallery --}}

            <div class="col-lg-4">

               {{-- =========================================================
PROPERTY IMAGE GALLERY
========================================================= --}}

@php
    $galleryImages = $property->images ?? collect();
@endphp

<div class="row g-3 mb-5">

    {{-- Main Featured Image --}}
    <div class="col-lg-8">

        @if($property->featured_image)

            <a
                href="#propertyGalleryModal"
                data-bs-toggle="modal"
                data-bs-slide-to="0"
                class="d-block"
            >
                <img
                    src="{{ asset(
                        'storage/properties/featured/' .
                        $property->featured_image
                    ) }}"
                    alt="{{ $property->title }}"
                    class="img-fluid rounded shadow-sm w-100"
                    style="
                        height:500px;
                        object-fit:cover;
                        cursor:pointer;
                    "
                >
            </a>

        @else

            <div
                class="bg-light rounded d-flex align-items-center justify-content-center"
                style="height:500px;"
            >
                <i class="bi bi-image text-muted fs-1"></i>
            </div>

        @endif

    </div>


    {{-- Gallery Images --}}
    <div class="col-lg-4">

        <div class="row g-3">

            @forelse($galleryImages->take(4) as $index => $image)

                @php
                    $totalGalleryImages = $galleryImages->count();
                    $remainingImages = $totalGalleryImages - 4;
                @endphp

                <div class="col-6">

                    <a
                        href="#propertyGalleryModal"
                        data-bs-toggle="modal"
                        data-bs-slide-to="{{ $index + 1 }}"
                        class="position-relative d-block overflow-hidden rounded"
                    >

                        <img
                            src="{{ asset(
                                'storage/properties/gallery/' .
                                $image->image
                            ) }}"
                            alt="{{ $property->title }}"
                            class="img-fluid rounded shadow-sm w-100"
                            style="
                                height:238px;
                                object-fit:cover;
                                cursor:pointer;
                            "
                            loading="lazy"
                        >


                        {{-- Plus Overlay --}}
                        @if($index === 3 && $remainingImages > 0)

                            <span
                                class="position-absolute top-50 start-50 translate-middle
                                       bg-dark bg-opacity-75 text-white
                                       rounded-pill px-3 py-2 fw-semibold"
                                style="
                                    font-size:15px;
                                    backdrop-filter:blur(4px);
                                "
                            >

                                <i class="bi bi-plus-lg"></i>

                                {{ $remainingImages }}

                            </span>

                        @endif

                    </a>

                </div>

            @empty

                @for($i = 0; $i < 4; $i++)

                    <div class="col-6">

                        <div
                            class="bg-light rounded d-flex align-items-center justify-content-center"
                            style="height:238px;"
                        >

                            <i class="bi bi-image text-muted fs-3"></i>

                        </div>

                    </div>

                @endfor

            @endforelse

        </div>

    </div>

</div>

            </div>

        </div>


        {{-- =====================================================
        MAIN CONTENT
        ===================================================== --}}

        <div class="row g-5">


            {{-- =================================================
            LEFT COLUMN
            ================================================= --}}

            <div class="col-lg-8">


                {{-- =================================================
                PROPERTY HEADER
                ================================================= --}}

                <div class="mb-4">

                    <div class="d-flex flex-wrap gap-2 mb-3">

                        @if($property->availability)

                            <span class="badge bg-success">
                                {{ ucfirst($property->availability) }}
                            </span>

                        @endif


@isset($property->listing_type)
    <span class="badge bg-dark">
        {{ [
            'sale'  => 'For Sale',
            'rent'  => 'For Rent',
            'lease' => 'For Lease',
        ][$property->listing_type] ?? ucfirst($property->listing_type) }}
    </span>
@endisset


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


                {{-- =================================================
                PRICE
                ================================================= --}}

                @if($property->price !== null)

                    <div class="mb-4">

                        <h2 class="fw-bold text-primary mb-0">

                            ₹{{ number_format($property->price) }}

                        </h2>

                    </div>

                @endif


                {{-- =================================================
                PROPERTY DETAILS
                ================================================= --}}

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


                            @if($property->bedrooms !== null)

                                <div class="col-6 col-md-4">

                                    <div class="text-muted small">
                                        Bedrooms
                                    </div>

                                    <div class="fw-semibold">
                                        {{ $property->bedrooms }}
                                    </div>

                                </div>

                            @endif


                            @if($property->bathrooms !== null)

                                <div class="col-6 col-md-4">

                                    <div class="text-muted small">
                                        Bathrooms
                                    </div>

                                    <div class="fw-semibold">
                                        {{ $property->bathrooms }}
                                    </div>

                                </div>

                            @endif


                            @if($property->balconies !== null)

                                <div class="col-6 col-md-4">

                                    <div class="text-muted small">
                                        Balconies
                                    </div>

                                    <div class="fw-semibold">
                                        {{ $property->balconies }}
                                    </div>

                                </div>

                            @endif


                            @if($property->parking !== null)

                                <div class="col-6 col-md-4">

                                    <div class="text-muted small">
                                        Parking
                                    </div>

                                    <div class="fw-semibold">
                                        {{ $property->parking }}
                                    </div>

                                </div>

                            @endif


                            @if($property->floor !== null)

                                <div class="col-6 col-md-4">

                                    <div class="text-muted small">
                                        Floor
                                    </div>

                                    <div class="fw-semibold">
                                        {{ $property->floor }}
                                    </div>

                                </div>

                            @endif


                            @if($property->total_floors !== null)

                                <div class="col-6 col-md-4">

                                    <div class="text-muted small">
                                        Total Floors
                                    </div>

                                    <div class="fw-semibold">
                                        {{ $property->total_floors }}
                                    </div>

                                </div>

                            @endif


                            @if($property->area !== null)

                                <div class="col-6 col-md-4">

                                    <div class="text-muted small">
                                        Area
                                    </div>

                                    <div class="fw-semibold">

                                        {{ number_format($property->area) }}

                                        {{ $property->area_unit ?: 'sq.ft' }}

                                    </div>

                                </div>

                            @endif


                            @if($property->availability)

                                <div class="col-6 col-md-4">

                                    <div class="text-muted small">
                                        Availability
                                    </div>

                                    <div class="fw-semibold">
                                        {{ ucfirst($property->availability) }}
                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- =================================================
                DESCRIPTION
                ================================================= --}}

                @if($property->short_description)

                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-body">

                            <h4 class="fw-bold mb-3">
                                Overview
                            </h4>

                            <p class="text-muted mb-0">
                                {{ $property->short_description }}
                            </p>

                        </div>

                    </div>

                @endif


                @if($property->description)

                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-body">

                            <h4 class="fw-bold mb-3">
                                Description
                            </h4>

                            <div class="text-muted">

                                {!! nl2br(
                                    e($property->description)
                                ) !!}

                            </div>

                        </div>

                    </div>

                @endif


                {{-- =================================================
                AMENITIES
                ================================================= --}}

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

                                            <i
                                                class="bi bi-check-circle-fill text-success me-2"
                                            ></i>

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


                {{-- =================================================
                SPECIFICATIONS
                ================================================= --}}

                @if($property->specifications && $property->specifications->count())

                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-body">

                            <h4 class="fw-bold mb-4">
                                Specifications
                            </h4>

                            <div class="table-responsive">

                                <table class="table table-bordered align-middle mb-0">

                                    <tbody>

                                        @foreach($property->specifications as $specification)

                                            <tr>

                                                <th style="width:30%;">

                                                    {{ $specification->title }}

                                                </th>

                                                <td>

                                                    {{ $specification->value }}

                                                    @if($specification->description)

                                                        <div class="small text-muted mt-1">

                                                            {{ $specification->description }}

                                                        </div>

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


                {{-- =================================================
                DEVELOPER / PROJECT
                ================================================= --}}

                @if(
                    $property->developer ||
                    $property->project_status ||
                    $property->possession_date ||
                    $property->rera_number ||
                    $property->rera_status
                )

                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-body">

                            <h4 class="fw-bold mb-4">
                                Project Information
                            </h4>

                            <div class="row g-4">


                                @if($property->developer)

                                    <div class="col-md-6">

                                        <div class="text-muted small">
                                            Developer
                                        </div>

                                        <div class="fw-semibold">
                                            {{ $property->developer->name }}
                                        </div>

                                    </div>

                                @endif


                                @if($property->project_status)

                                    <div class="col-md-6">

                                        <div class="text-muted small">
                                            Project Status
                                        </div>

                                        <div class="fw-semibold">
                                            {{ $property->project_status }}
                                        </div>

                                    </div>

                                @endif


                                @if($property->possession_date)

                                    <div class="col-md-6">

                                        <div class="text-muted small">
                                            Possession Date
                                        </div>

                                        <div class="fw-semibold">

                                            {{ \Carbon\Carbon::parse(
                                                $property->possession_date
                                            )->format('d M Y') }}

                                        </div>

                                    </div>

                                @endif


                                @if($property->rera_number)

                                    <div class="col-md-6">

                                        <div class="text-muted small">
                                            RERA Number
                                        </div>

                                        <div class="fw-semibold">
                                            {{ $property->rera_number }}
                                        </div>

                                    </div>

                                @endif


                                @if($property->rera_status)

                                    <div class="col-md-6">

                                        <div class="text-muted small">
                                            RERA Status
                                        </div>

                                        <div class="fw-semibold">

                                            {{ $property->rera_status }}

                                        </div>

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>

                @endif


                {{-- =================================================
                FLOOR PLANS
                ================================================= --}}

                @if($property->floorPlans && $property->floorPlans->count())

                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-body">

                            <h4 class="fw-bold mb-4">
                                Floor Plans
                            </h4>

                            <div class="row g-4">

                                @foreach($property->floorPlans as $floorPlan)

                                    <div class="col-md-6">

                                        <div class="border rounded p-3 h-100">

                                            @if($floorPlan->image)

                                                <img
                                                    src="{{ asset(
                                                        'storage/properties/floor-plans/' .
                                                        $floorPlan->image
                                                    ) }}"
                                                    alt="{{ $floorPlan->title }}"
                                                    class="img-fluid rounded mb-3 w-100"
                                                    style="
                                                        height:220px;
                                                        object-fit:cover;
                                                    "
                                                    loading="lazy"
                                                >

                                            @endif


                                            @if($floorPlan->title)

                                                <h5 class="fw-bold mb-2">
                                                    {{ $floorPlan->title }}
                                                </h5>

                                            @endif


                                            @if($floorPlan->configuration)

                                                <div class="small text-muted mb-1">

                                                    Configuration:

                                                    <strong>
                                                        {{ $floorPlan->configuration }}
                                                    </strong>

                                                </div>

                                            @endif


                                            @if($floorPlan->area)

                                                <div class="small text-muted mb-1">

                                                    Area:

                                                    <strong>

                                                        {{ number_format(
                                                            $floorPlan->area
                                                        ) }}

                                                        {{ $floorPlan->area_unit }}

                                                    </strong>

                                                </div>

                                            @endif


                                            @if($floorPlan->price !== null)

                                                <div class="small text-muted">

                                                    Price:

                                                    <strong>

                                                        ₹{{ number_format(
                                                            $floorPlan->price
                                                        ) }}

                                                    </strong>

                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                @endif


                {{-- =================================================
                PAYMENT PLANS
                ================================================= --}}

                @if($property->paymentPlans && $property->paymentPlans->count())

                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-body">

                            <h4 class="fw-bold mb-4">
                                Payment Plans
                            </h4>

                            <div class="row g-3">

                                @foreach($property->paymentPlans as $paymentPlan)

                                    <div class="col-md-6">

                                        <div class="border rounded p-3">

                                            @if($paymentPlan->title)

                                                <h6 class="fw-bold">
                                                    {{ $paymentPlan->title }}
                                                </h6>

                                            @endif


                                            @if($paymentPlan->description)

                                                <p class="small text-muted mb-0">

                                                    {{ $paymentPlan->description }}

                                                </p>

                                            @endif

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                @endif


                {{-- =================================================
                LANDMARKS
                ================================================= --}}

                @if($property->landmarks && $property->landmarks->count())

                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-body">

                            <h4 class="fw-bold mb-4">
                                Nearby Landmarks
                            </h4>

                            <div class="row g-3">

                                @foreach($property->landmarks as $landmark)

                                    <div class="col-md-6">

                                        <div class="d-flex align-items-start">

                                            <i
                                                class="bi bi-geo-alt-fill text-primary me-2 mt-1"
                                            ></i>

                                            <div>

                                                <div class="fw-semibold">

                                                    {{ $landmark->name ?? $landmark->title }}

                                                </div>

                                                @if(isset($landmark->distance) && $landmark->distance)

                                                    <div class="small text-muted">

                                                        {{ $landmark->distance }}

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


                {{-- =================================================
                LOCATION
                ================================================= --}}

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body">

                        <h4 class="fw-bold mb-4">
                            Location
                        </h4>


                        @if($property->city)

                            <p class="mb-2">

                                <strong>City:</strong>

                                {{ $property->city->name }}

                            </p>

                        @endif


                        @if($property->state)

                            <p class="mb-2">

                                <strong>State:</strong>

                                {{ $property->state->name }}

                            </p>

                        @endif


                        @if($property->address)

                            <p class="mb-2">

                                <strong>Address:</strong>

                                {{ $property->address }}

                            </p>

                        @endif


                        @if($property->pincode)

                            <p class="mb-2">

                                <strong>Pincode:</strong>

                                {{ $property->pincode }}

                            </p>

                        @endif


                        @if($property->latitude || $property->longitude)

                            <div class="small text-muted mt-3">

                                @if($property->latitude)

                                    Latitude:
                                    {{ $property->latitude }}

                                @endif

                                @if($property->longitude)

                                    &nbsp; | &nbsp;

                                    Longitude:
                                    {{ $property->longitude }}

                                @endif

                            </div>

                        @endif

                    </div>

                </div>


                {{-- =================================================
                DOCUMENTS
                ================================================= --}}

                @if($property->documents && $property->documents->count())

                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-body">

                            <h4 class="fw-bold mb-4">
                                Documents
                            </h4>

                            <div class="list-group">

                                @foreach($property->documents as $document)

                                    @php

                                        $documentFile =
                                            $document->file ??
                                            $document->document ??
                                            $document->path ??
                                            null;

                                    @endphp

                                    @if($documentFile)

                                        <a
                                            href="{{ asset(
                                                'storage/properties/documents/' .
                                                $documentFile
                                            ) }}"
                                            target="_blank"
                                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                        >

                                            <span>

                                                <i class="bi bi-file-earmark-text me-2"></i>

                                                {{ $document->title
                                                    ?? $document->name
                                                    ?? 'Property Document' }}

                                            </span>

                                            <i class="bi bi-box-arrow-up-right"></i>

                                        </a>

                                    @endif

                                @endforeach

                            </div>

                        </div>

                    </div>

                @endif


            </div>


            {{-- =================================================
            RIGHT COLUMN - OWNER / CONTACT
            ================================================= --}}

            <div class="col-lg-4">

                <div
                    class="card border-0 shadow-sm sticky-lg-top"
                    style="top:90px;"
                >

                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-4">
                            Interested in this property?
                        </h4>


                        {{-- =========================================
                        PROPERTY OWNER / LISTER
                        ========================================= --}}

                        @if($property->user)

                            <div class="d-flex align-items-center mb-4">

                                <div
                                    class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center me-3"
                                    style="
                                        width:50px;
                                        height:50px;
                                    "
                                >

                                    <i class="bi bi-person fs-4"></i>

                                </div>


                                <div>

                                    <div class="fw-semibold">

                                        {{ $property->user->name }}

                                    </div>

                                    <small class="text-muted">
                                        Property Lister
                                    </small>

                                </div>

                            </div>


                            {{-- Owner Phone --}}

                            @if($property->user->phone)

                                <div class="mb-3">

                                    <div class="small text-muted">
                                        Contact Number
                                    </div>

                                    <div class="fw-semibold">

                                        {{ $property->user->phone }}

                                    </div>

                                </div>

                            @endif


                            {{-- Owner Email --}}

                            @if($property->user->email)

                                <div class="mb-4">

                                    <div class="small text-muted">
                                        Email
                                    </div>

                                    <div class="fw-semibold text-break">

                                        {{ $property->user->email }}

                                    </div>

                                </div>

                            @endif

                        @endif


                        {{-- =================================================
                        CONTACT BUTTONS
                        ================================================= --}}

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


                            @if($property->user && $property->user->email)

                                <a
                                    href="mailto:{{ $property->user->email }}?subject={{ urlencode('Property Enquiry - ' . $property->title) }}"
                                    class="btn btn-outline-primary"
                                >

                                    <i class="bi bi-envelope me-2"></i>

                                    Send Email

                                </a>

                            @endif

                        </div>


                        <hr class="my-4">


                        {{-- =================================================
                        QUICK PROPERTY INFO
                        ================================================= --}}

                        <div class="small text-muted">


                            <div class="d-flex justify-content-between mb-2">

                                <span>
                                    Property Code
                                </span>

                                <strong>
                                    {{ $property->property_code ?? '-' }}
                                </strong>

                            </div>


                            <div class="d-flex justify-content-between mb-2">

                                <span>
                                    Listing Type
                                </span>

                                <strong>

                                    @isset($property->listing_type)
    <span class="badge bg-dark">
        {{ [
            'sale'  => 'For Sale',
            'rent'  => 'For Rent',
            'lease' => 'For Lease',
        ][$property->listing_type] ?? ucfirst($property->listing_type) }}
    </span>
@endisset

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


{{-- =========================================================
BROWSE MORE
========================================================= --}}

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

{{-- =========================================================
PROPERTY GALLERY MODAL
========================================================= --}}

<div
    class="modal fade"
    id="propertyGalleryModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered modal-xl">

        <div class="modal-content bg-dark border-0">

            <div class="modal-header border-0">

                <h5 class="modal-title text-white">
                    {{ $property->title }}
                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            <div class="modal-body p-0">

                <div
                    id="propertyGalleryCarousel"
                    class="carousel slide"
                    data-bs-interval="false"
                >

                    <div class="carousel-inner">

                        {{-- Featured Image --}}
                        @if($property->featured_image)

                            <div class="carousel-item active">

                                <div
                                    class="d-flex align-items-center justify-content-center"
                                    style="height:75vh;"
                                >

                                    <img
                                        src="{{ asset(
                                            'storage/properties/featured/' .
                                            $property->featured_image
                                        ) }}"
                                        alt="{{ $property->title }}"
                                        class="img-fluid"
                                        style="
                                            max-height:75vh;
                                            max-width:95%;
                                            object-fit:contain;
                                        "
                                    >

                                </div>

                            </div>

                        @endif


                        {{-- Gallery Images --}}
                        @foreach($galleryImages as $image)

                            <div class="carousel-item">

                                <div
                                    class="d-flex align-items-center justify-content-center"
                                    style="height:75vh;"
                                >

                                    <img
                                        src="{{ asset(
                                            'storage/properties/gallery/' .
                                            $image->image
                                        ) }}"
                                        alt="{{ $property->title }}"
                                        class="img-fluid"
                                        style="
                                            max-height:75vh;
                                            max-width:95%;
                                            object-fit:contain;
                                        "
                                    >

                                </div>

                            </div>

                        @endforeach

                    </div>


                    {{-- Previous --}}
                    <button
                        class="carousel-control-prev"
                        type="button"
                        data-bs-target="#propertyGalleryCarousel"
                        data-bs-slide="prev"
                    >

                        <span
                            class="carousel-control-prev-icon"
                            aria-hidden="true"
                        ></span>

                        <span class="visually-hidden">
                            Previous
                        </span>

                    </button>


                    {{-- Next --}}
                    <button
                        class="carousel-control-next"
                        type="button"
                        data-bs-target="#propertyGalleryCarousel"
                        data-bs-slide="next"
                    >

                        <span
                            class="carousel-control-next-icon"
                            aria-hidden="true"
                        ></span>

                        <span class="visually-hidden">
                            Next
                        </span>

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection