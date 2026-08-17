{{-- ========================================================= --}}
{{-- BASIC INFORMATION --}}
{{-- ========================================================= --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Please fix the following errors:</strong>

        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card mb-4 section-card">

    <div class="card-header">
        <h5 class="mb-0"><span class="header-icon"><i class="bi bi-info-circle"></i></span>Basic Information</h5>
    </div>

    <div class="card-body">

        <div class="row">

            {{-- Property Title --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Property Title
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="title"
                    class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $property->title ?? '') }}"
                >

                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Category --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Category
                    <span class="text-danger">*</span>
                </label>

                <select
                    name="category_id"
                    class="form-select @error('category_id') is-invalid @enderror"
                >

                    <option value="">Select Category</option>

                    @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $property->category_id ?? '') == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

                @error('category_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>


        <div class="row">

            {{-- Listing Type --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">
                    Listing Type
                    <span class="text-danger">*</span>
                </label>

                <select
                    name="listing_type"
                    id="listing_type"
                    class="form-select @error('listing_type') is-invalid @enderror"
                    required
                >
                    <option value="">Select Listing Type</option>

                    <option value="sale"
                        {{ old('listing_type', $property->listing_type ?? 'sale') === 'sale' ? 'selected' : '' }}>
                        For Sale
                    </option>

                    <option value="rent"
                        {{ old('listing_type', $property->listing_type ?? '') === 'rent' ? 'selected' : '' }}>
                        For Rent
                    </option>

                    <option value="lease"
                        {{ old('listing_type', $property->listing_type ?? '') === 'lease' ? 'selected' : '' }}>
                        For Lease
                    </option>
                </select>

                @error('listing_type')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Property Type --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Property Type
                    <span class="text-danger">*</span>
                </label>

                <select
                    name="property_type_id"
                    id="property_type_id"
                    class="form-select"
                >

                    <option value="">
                        Select Property Type
                    </option>

                    @foreach($propertyTypes as $type)

                        <option
                            value="{{ $type->id }}"
                            {{ old('property_type_id', $property->property_type_id ?? '') == $type->id ? 'selected' : '' }}
                        >
                            {{ $type->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- State --}}
            {{-- State --}}
    <div class="col-md-6 mb-3">

        <label for="state_id" class="form-label">
            State <span class="text-danger">*</span>
        </label>

        <select
            name="state_id"
            id="state_id"
            class="form-select"
            required
        >
            <option value="">Select State</option>

            @foreach($states as $state)

                <option
                    value="{{ $state->id }}"
                    @selected(
                        (string) old(
                            'state_id',
                            $property->state_id ?? ''
                        ) === (string) $state->id
                    )
                >
                    {{ $state->name }}
                </option>

            @endforeach

        </select>

        @error('state_id')
            <div class="text-danger small mt-1">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- City --}}
    <div class="col-md-6 mb-3">

        <label for="city_id" class="form-label">
            City <span class="text-danger">*</span>
        </label>

        <select
    name="city_id"
    id="city_id"
    class="form-select"
    required
    data-selected-city="{{ old('city_id', $property->city_id ?? '') }}"
>
    <option value="">Select City</option>
</select>

        @error('city_id')
            <div class="text-danger small mt-1">
                {{ $message }}
            </div>
        @enderror

        <div
            id="cityLoading"
            class="small text-muted mt-1 d-none"
        >
            Loading cities...
        </div>

    </div>


{{-- ========================================================= --}}
{{-- PRICE & AREA --}}
{{-- ========================================================= --}}

<div class="card mb-4 section-card">

    <div class="card-header">
        <h5 class="mb-0"><span class="header-icon"><i class="bi bi-currency-rupee"></i></span>Price & Area</h5>
    </div>

    <div class="card-body">

        <div class="row">

            {{-- Price --}}
            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Price
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="price"
                    class="form-control"
                    value="{{ old('price', $property->price ?? '') }}"
                >

            </div>


            {{-- Area --}}
            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Area
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="area"
                    class="form-control"
                    value="{{ old('area', $property->area ?? '') }}"
                >

            </div>


            {{-- Area Unit --}}
            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Area Unit
                </label>

                <select
                    name="area_unit"
                    class="form-select"
                >

                    <option
                        value="Sq Ft"
                        {{ old('area_unit', $property->area_unit ?? '') == 'Sq Ft' ? 'selected' : '' }}
                    >
                        Sq Ft
                    </option>

                    <option
                        value="Sq Yard"
                        {{ old('area_unit', $property->area_unit ?? '') == 'Sq Yard' ? 'selected' : '' }}
                    >
                        Sq Yard
                    </option>

                    <option
                        value="Sq Meter"
                        {{ old('area_unit', $property->area_unit ?? '') == 'Sq Meter' ? 'selected' : '' }}
                    >
                        Sq Meter
                    </option>

                    <option
                        value="Acre"
                        {{ old('area_unit', $property->area_unit ?? '') == 'Acre' ? 'selected' : '' }}
                    >
                        Acre
                    </option>

                </select>

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- PROPERTY DETAILS --}}
{{-- ========================================================= --}}

<div class="card mb-4 section-card" id="propertyDetailsCard">

    <div class="card-header">
        <h5 class="mb-0"><span class="header-icon"><i class="bi bi-house-door"></i></span>Property Details</h5>
    </div>

    <div class="card-body">

        <div class="row">

            {{-- Bedrooms --}}
            <div class="col-md-3 mb-3">

                <label class="form-label">
                    Bedrooms
                </label>

                <input
                    type="number"
                    name="bedrooms"
                    class="form-control"
                    value="{{ old('bedrooms', $property->bedrooms ?? 0) }}"
                >

            </div>


            {{-- Bathrooms --}}
            <div class="col-md-3 mb-3">

                <label class="form-label">
                    Bathrooms
                </label>

                <input
                    type="number"
                    name="bathrooms"
                    class="form-control"
                    value="{{ old('bathrooms', $property->bathrooms ?? 0) }}"
                >

            </div>


            {{-- Balconies --}}
            <div class="col-md-3 mb-3">

                <label class="form-label">
                    Balconies
                </label>

                <input
                    type="number"
                    name="balconies"
                    class="form-control"
                    value="{{ old('balconies', $property->balconies ?? 0) }}"
                >

            </div>


            {{-- Parking --}}
            <div class="col-md-3 mb-3">

                <label class="form-label">
                    Parking
                </label>

                <input
                    type="number"
                    name="parking"
                    class="form-control"
                    value="{{ old('parking', $property->parking ?? 0) }}"
                >

            </div>

        </div>


        <div class="row">

            {{-- Floor --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Floor
                </label>

                <input
                    type="number"
                    name="floor"
                    class="form-control"
                    value="{{ old('floor', $property->floor ?? '') }}"
                >

            </div>


            {{-- Total Floors --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Total Floors
                </label>

                <input
                    type="number"
                    name="total_floors"
                    class="form-control"
                    value="{{ old('total_floors', $property->total_floors ?? '') }}"
                >

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- PROJECT DETAILS --}}
{{-- ========================================================= --}}

<div class="card mb-4 section-card" id="projectDetailsCard">

    <div class="card-header">
        <h5 class="mb-0"><span class="header-icon"><i class="bi bi-buildings"></i></span>Project Details</h5>
    </div>

    <div class="card-body">

        <div class="row">

            {{-- Developer --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Developer
                </label>

                <div class="input-group">

                    <select name="developer_id" class="form-select">
    <option value="">Select Developer</option>

    @foreach($developers as $developer)
        <option value="{{ $developer->id }}"
            @selected(old('developer_id', $property->developer_id ?? '') == $developer->id)>
            {{ $developer->name }}
        </option>
    @endforeach
</select>


                 
                </div>


                @error('developer_id')

                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Project Status --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Project Status
                </label>

                <select
                    name="project_status"
                    class="form-select"
                >

                    <option value="">
                        Select Project Status
                    </option>

                    <option
                        value="upcoming"
                        {{ old('project_status', $property->project_status ?? '') == 'upcoming' ? 'selected' : '' }}
                    >
                        Upcoming
                    </option>

                    <option
                        value="under_construction"
                        {{ old('project_status', $property->project_status ?? '') == 'under_construction' ? 'selected' : '' }}
                    >
                        Under Construction
                    </option>

                    <option
                        value="ready_to_move"
                        {{ old('project_status', $property->project_status ?? '') == 'ready_to_move' ? 'selected' : '' }}
                    >
                        Ready to Move
                    </option>

                </select>

            </div>


            {{-- Possession Date --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Possession Date
                </label>

                <input
                    type="date"
                    name="possession_date"
                    class="form-control"
                    value="{{ old('possession_date', isset($property->possession_date) ? $property->possession_date->format('Y-m-d') : '') }}"
                >

            </div>


            {{-- RERA Number --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    RERA Number
                </label>

                <input
                    type="text"
                    name="rera_number"
                    class="form-control"
                    value="{{ old('rera_number', $property->rera_number ?? '') }}"
                    placeholder="Enter RERA number"
                >

            </div>


            {{-- RERA Status --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    RERA Status
                </label>

                <select
                    name="rera_status"
                    class="form-select"
                >

                    <option value="">
                        Select RERA Status
                    </option>

                    <option
                        value="registered"
                        {{ old('rera_status', $property->rera_status ?? '') == 'registered' ? 'selected' : '' }}
                    >
                        Registered
                    </option>

                    <option
                        value="applied"
                        {{ old('rera_status', $property->rera_status ?? '') == 'applied' ? 'selected' : '' }}
                    >
                        Applied
                    </option>

                    <option
                        value="not_registered"
                        {{ old('rera_status', $property->rera_status ?? '') == 'not_registered' ? 'selected' : '' }}
                    >
                        Not Registered
                    </option>

                    <option
                        value="not_applicable"
                        {{ old('rera_status', $property->rera_status ?? '') == 'not_applicable' ? 'selected' : '' }}
                    >
                        Not Applicable
                    </option>

                </select>

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- ADDRESS --}}
{{-- ========================================================= --}}

<div class="card mb-4 section-card">

    <div class="card-header">
        <h5 class="mb-0"><span class="header-icon"><i class="bi bi-geo-alt"></i></span>Address</h5>
    </div>

    <div class="card-body">

        <div class="mb-3">

            <label class="form-label">
                Address
            </label>

            <input
                type="text"
                name="address"
                class="form-control"
                value="{{ old('address', $property->address ?? '') }}"
            >

        </div>


        <div class="row">

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Pincode
                </label>

                <input
                    type="text"
                    name="pincode"
                    class="form-control"
                    value="{{ old('pincode', $property->pincode ?? '') }}"
                >

            </div>


            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Latitude
                </label>

                <input
                    type="text"
                    name="latitude"
                    class="form-control"
                    value="{{ old('latitude', $property->latitude ?? '') }}"
                >

            </div>


            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Longitude
                </label>

                <input
                    type="text"
                    name="longitude"
                    class="form-control"
                    value="{{ old('longitude', $property->longitude ?? '') }}"
                >

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- DESCRIPTION --}}
{{-- ========================================================= --}}

<div class="card mb-4 section-card">

    <div class="card-header">
        <h5 class="mb-0"><span class="header-icon"><i class="bi bi-file-text"></i></span>Description</h5>
    </div>

    <div class="card-body">

        <div class="mb-3">

            <label class="form-label">
                Short Description
            </label>

            <textarea
                name="short_description"
                rows="3"
                class="form-control"
            >{{ old('short_description', $property->short_description ?? '') }}</textarea>

        </div>


        <div class="mb-3">

            <label class="form-label">
                Description
                <span class="text-danger">*</span>
            </label>

            <textarea
                id="description"
                name="description"
                rows="8"
                class="form-control"
            >{{ old('description', $property->description ?? '') }}</textarea>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- FEATURED IMAGE --}}
{{-- ========================================================= --}}

<div class="card mb-4 section-card">

    <div class="card-header">
        <h5 class="mb-0"><span class="header-icon"><i class="bi bi-image"></i></span>Featured Image</h5>
    </div>

    <div class="card-body">

        @if(!empty($property->featured_image))

            <div class="mb-3 featured-preview">

                <img
                    src="{{ asset('storage/properties/featured/'.$property->featured_image) }}"
                    class="img-thumbnail"
                    style="height:180px;"
                >

            </div>

        @endif


        <input
            type="file"
            name="featured_image"
            class="form-control"
            accept="image/*"
        >

        <small class="text-muted">
            JPG, PNG, WEBP
        </small>

    </div>

</div>


{{-- ========================================================= --}}
{{-- GALLERY --}}
{{-- ========================================================= --}}

{{-- ========================================================= --}}
{{-- GALLERY --}}
{{-- ========================================================= --}}

<div class="card mb-4 section-card">

    <div class="card-header">

        <h5 class="mb-0">

            <span class="header-icon">
                <i class="bi bi-images"></i>
            </span>

            Gallery Images

        </h5>

    </div>

    <div class="card-body">

        <div class="mb-3">

            <label class="form-label">
                Property Gallery
            </label>

            <input
                type="file"
                name="images[]"
                class="form-control"
                multiple
                accept="image/jpeg,image/png,image/webp"
            >

            <small class="text-muted">
                Optional. You can upload multiple JPG, PNG or WEBP images.
            </small>

            @error('images')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

            @error('images.*')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- Existing Gallery Images --}}
        @if(isset($property))

            <hr>

            <h6 class="mb-3">
                Existing Gallery Images
            </h6>

            <div class="row">

                @forelse($property->images as $image)

                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                        <div class="card h-100 gallery-thumb">

                            <img
                                src="{{ asset('storage/properties/gallery/'.$image->image) }}"
                                class="card-img-top"
                                style="height:180px;object-fit:cover;"
                                alt="Property Gallery Image"
                            >

                            <div class="card-body p-2">

                                <label class="form-check">

                                    <input
                                        type="checkbox"
                                        name="delete_gallery[]"
                                        value="{{ $image->id }}"
                                        class="form-check-input"
                                    >

                                    <span class="form-check-label text-danger">
                                        Remove image
                                    </span>

                                </label>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="alert alert-light border mb-0">
                            No gallery images uploaded yet.
                        </div>

                    </div>

                @endforelse

            </div>

        @endif

    </div>

</div>


{{-- ========================================================= --}}
{{-- AMENITIES --}}
{{-- ========================================================= --}}

<div class="card mb-4 section-card">

    <div class="card-header">
        <h5 class="mb-0"><span class="header-icon"><i class="bi bi-check2-square"></i></span>Amenities</h5>
    </div>

    <div class="card-body">

        <div class="row">

            @foreach($amenities as $amenity)

                <div class="col-lg-3 col-md-4 col-6 mb-3">

                    <div class="form-check">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="amenities[]"
                            value="{{ $amenity->id }}"
                            id="amenity{{ $amenity->id }}"
                            {{ isset($property) && $property->amenities->contains($amenity->id) ? 'checked' : '' }}
                        >

                        <label
                            class="form-check-label"
                            for="amenity{{ $amenity->id }}"
                        >

                            @if($amenity->icon)

                                <i class="{{ $amenity->icon }}"></i>

                            @endif

                            {{ $amenity->name }}

                        </label>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>
{{-- ========================================================= --}}
{{-- SPECIFICATIONS --}}
{{-- ========================================================= --}}

<div class="card mb-4 section-card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <span class="header-icon"><i class="bi bi-list-columns"></i></span>
            Specifications
        </h5>

        <button
            type="button"
            class="btn btn-sm btn-primary"
            id="addSpecification"
        >
            <i class="bi bi-plus-circle"></i>
            Add Specification
        </button>

    </div>

    <div class="card-body">

        <div id="specificationsWrapper">

            @if(isset($property) && $property->specifications->count())

                @foreach($property->specifications as $index => $specification)

                    <div class="specification-item border rounded p-3 mb-3">

                        <div class="row">

                            <div class="col-md-3 mb-3">

                                <label class="form-label">
                                    Title
                                </label>

                                <input
                                    type="text"
                                    name="specifications[{{ $index }}][title]"
                                    class="form-control"
                                    value="{{ old(
                                        'specifications.'.$index.'.title',
                                        $specification->title
                                    ) }}"
                                    placeholder="e.g. Flooring"
                                >

                            </div>


                            <div class="col-md-3 mb-3">

                                <label class="form-label">
                                    Value
                                </label>

                                <input
                                    type="text"
                                    name="specifications[{{ $index }}][value]"
                                    class="form-control"
                                    value="{{ old(
                                        'specifications.'.$index.'.value',
                                        $specification->value
                                    ) }}"
                                    placeholder="e.g. Italian Marble"
                                >

                            </div>


                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Description
                                </label>

                                <input
                                    type="text"
                                    name="specifications[{{ $index }}][description]"
                                    class="form-control"
                                    value="{{ old(
                                        'specifications.'.$index.'.description',
                                        $specification->description
                                    ) }}"
                                    placeholder="Optional description"
                                >

                            </div>


                            <div class="col-md-1 mb-3">

                                <label class="form-label">
                                    Order
                                </label>

                                <input
                                    type="number"
                                    name="specifications[{{ $index }}][sort_order]"
                                    class="form-control"
                                    value="{{ old(
                                        'specifications.'.$index.'.sort_order',
                                        $specification->sort_order
                                    ) }}"
                                    min="0"
                                >

                            </div>


                            <div class="col-md-1 mb-3">

                                <label class="form-label">
                                    Status
                                </label>

                                <div class="form-check mt-2">

                                    <input
                                        type="hidden"
                                        name="specifications[{{ $index }}][status]"
                                        value="0"
                                    >

                                    <input
                                        type="checkbox"
                                        name="specifications[{{ $index }}][status]"
                                        value="1"
                                        class="form-check-input"
                                        {{ $specification->status ? 'checked' : '' }}
                                    >

                                </div>

                            </div>

                        </div>


                        <div class="text-end">

                            <button
                                type="button"
                                class="btn btn-sm btn-outline-danger removeSpecification"
                            >
                                <i class="bi bi-trash"></i>
                                Remove
                            </button>

                        </div>

                    </div>

                @endforeach

            @endif

        </div>


        @if(!isset($property) || !$property->specifications->count())

            <div
                id="noSpecifications"
                class="text-muted text-center py-3 empty-state-block"
            >
                No specifications added.
            </div>

        @endif

    </div>

</div>
<div class="card mb-4 section-card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <span class="header-icon"><i class="bi bi-diagram-3"></i></span>
            Floor Plans
        </h5>

        <button
            type="button"
            class="btn btn-sm btn-primary"
            id="addFloorPlan"
        >
            <i class="bi bi-plus-circle"></i>
            Add Floor Plan
        </button>

    </div>


    <div class="card-body">

        <div id="floorPlansWrapper">

            {{-- Existing Floor Plans --}}
            @if(isset($property) && $property->floorPlans->count())

                @foreach($property->floorPlans as $index => $floorPlan)

                    <div class="floor-plan-item border rounded p-3 mb-3">

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <h6 class="mb-0">
                                Floor Plan #{{ $index + 1 }}
                            </h6>

                            <button
                                type="button"
                                class="btn btn-sm btn-outline-danger remove-floor-plan"
                            >
                                <i class="bi bi-trash"></i>
                                Remove
                            </button>

                        </div>


                        <div class="row">

                            {{-- Title --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Title
                                </label>

                                <input
                                    type="text"
                                    name="floor_plans[{{ $index }}][title]"
                                    class="form-control"
                                    value="{{ old(
                                        'floor_plans.'.$index.'.title',
                                        $floorPlan->title
                                    ) }}"
                                    placeholder="e.g. Type A"
                                >

                            </div>


                            {{-- Configuration --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Configuration
                                </label>

                                <input
                                    type="text"
                                    name="floor_plans[{{ $index }}][configuration]"
                                    class="form-control"
                                    value="{{ old(
                                        'floor_plans.'.$index.'.configuration',
                                        $floorPlan->configuration
                                    ) }}"
                                    placeholder="e.g. 2 BHK"
                                >

                            </div>


                            {{-- Area --}}
                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Area
                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    name="floor_plans[{{ $index }}][area]"
                                    class="form-control"
                                    value="{{ old(
                                        'floor_plans.'.$index.'.area',
                                        $floorPlan->area
                                    ) }}"
                                >

                            </div>


                            {{-- Area Unit --}}
                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Area Unit
                                </label>

                                <select
                                    name="floor_plans[{{ $index }}][area_unit]"
                                    class="form-select"
                                >

                                    <option value="sqft"
                                        @selected(
                                            old(
                                                'floor_plans.'.$index.'.area_unit',
                                                $floorPlan->area_unit
                                            ) === 'sqft'
                                        )
                                    >
                                        Sq. Ft.
                                    </option>

                                    <option value="sqm"
                                        @selected(
                                            old(
                                                'floor_plans.'.$index.'.area_unit',
                                                $floorPlan->area_unit
                                            ) === 'sqm'
                                        )
                                    >
                                        Sq. Meter
                                    </option>

                                    <option value="sqyd"
                                        @selected(
                                            old(
                                                'floor_plans.'.$index.'.area_unit',
                                                $floorPlan->area_unit
                                            ) === 'sqyd'
                                        )
                                    >
                                        Sq. Yard
                                    </option>

                                </select>

                            </div>


                            {{-- Price --}}
                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Price
                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    name="floor_plans[{{ $index }}][price]"
                                    class="form-control"
                                    value="{{ old(
                                        'floor_plans.'.$index.'.price',
                                        $floorPlan->price
                                    ) }}"
                                >

                            </div>


                            {{-- Image --}}
                            <div class="col-md-8 mb-3">

                                <label class="form-label">
                                    Floor Plan Image
                                </label>

                                <input
                                    type="file"
                                    name="floor_plans[{{ $index }}][image]"
                                    class="form-control"
                                    accept="image/*"
                                >

                                @if($floorPlan->image)

                                    <div class="mt-2">

                                        <img
                                            src="{{ asset(
                                                'storage/properties/floor-plans/'.$floorPlan->image
                                            ) }}"
                                            alt="{{ $floorPlan->title }}"
                                            style="
                                                width:120px;
                                                height:80px;
                                                object-fit:cover;
                                            "
                                            class="rounded border"
                                        >

                                    </div>

                                @endif

                            </div>


                            {{-- Sort Order --}}
                            <div class="col-md-2 mb-3">

                                <label class="form-label">
                                    Sort Order
                                </label>

                                <input
                                    type="number"
                                    name="floor_plans[{{ $index }}][sort_order]"
                                    class="form-control"
                                    value="{{ old(
                                        'floor_plans.'.$index.'.sort_order',
                                        $floorPlan->sort_order ?? ($index + 1)
                                    ) }}"
                                >

                            </div>


                            {{-- Status --}}
                            <div class="col-md-2 mb-3">

                                <label class="form-label d-block">
                                    Status
                                </label>

                                <div class="form-check form-switch mt-2">

                                    <input
                                        type="hidden"
                                        name="floor_plans[{{ $index }}][status]"
                                        value="0"
                                    >

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="floor_plans[{{ $index }}][status]"
                                        value="1"
                                        @checked(
                                            old(
                                                'floor_plans.'.$index.'.status',
                                                $floorPlan->status
                                            )
                                        )
                                    >

                                    <label class="form-check-label">
                                        Active
                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            @endif

        </div>


        {{-- Empty State --}}
        <div
            id="noFloorPlans"
            class="text-center text-muted py-4 empty-state-block"
            @if(isset($property) && $property->floorPlans->count())
                style="display:none;"
            @endif
        >
            <i class="bi bi-layout-text-window-reverse fs-3"></i>

            <p class="mb-0 mt-2">
                No floor plans added yet.
            </p>
        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- SEO --}}
{{-- ========================================================= --}}

<div class="card mb-4 section-card">

    <div class="card-header">
        <h5 class="mb-0"><span class="header-icon"><i class="bi bi-search"></i></span>SEO Information</h5>
    </div>

    <div class="card-body">

        <div class="mb-3">

            <label class="form-label">
                Meta Title
            </label>

            <input
                type="text"
                name="meta_title"
                class="form-control"
                value="{{ old('meta_title', $property->meta_title ?? '') }}"
            >

        </div>


        <div class="mb-3">

            <label class="form-label">
                Meta Description
            </label>

            <textarea
                name="meta_description"
                rows="4"
                class="form-control"
            >{{ old('meta_description', $property->meta_description ?? '') }}</textarea>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- PROPERTY SETTINGS --}}
{{-- ========================================================= --}}

<div class="card mb-4 section-card">

    <div class="card-header">

        <h5 class="mb-0">
            <span class="header-icon"><i class="bi bi-sliders"></i></span>
            Property Settings
        </h5>

    </div>


    <div class="card-body">

        <div class="row">

            {{-- Availability --}}
            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Availability
                    <span class="text-danger">*</span>
                </label>

                <select
                    name="availability"
                    id="availability"
                    class="form-select @error('availability') is-invalid @enderror"
                    required
                >

                    <option
                        value="available"
                        {{ old('availability', $property->availability ?? 'available') == 'available' ? 'selected' : '' }}
                    >
                        Available
                    </option>

                    <option
                        value="unavailable"
                        {{ old('availability', $property->availability ?? '') == 'unavailable' ? 'selected' : '' }}
                    >
                        Unavailable
                    </option>

                </select>

                @error('availability')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Status --}}
            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Status
                </label>

                <select
                    name="status"
                    class="form-select"
                >

                    <option
                        value="1"
                        {{ old('status', $property->status ?? 1) == '1' ? 'selected' : '' }}
                    >
                        Active
                    </option>

                    <option
                        value="0"
                        {{ old('status', $property->status ?? '') == '0' ? 'selected' : '' }}
                    >
                        Inactive
                    </option>

                </select>

            </div>


            {{-- Featured --}}
            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Featured Property
                </label>

                <select
                    name="featured"
                    class="form-select"
                >

                    <option
                        value="0"
                        {{ old('featured', $property->featured ?? 0) == '0' ? 'selected' : '' }}
                    >
                        No
                    </option>

                    <option
                        value="1"
                        {{ old('featured', $property->featured ?? '') == '1' ? 'selected' : '' }}
                    >
                        Yes
                    </option>

                </select>

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- SUBMIT --}}
{{-- ========================================================= --}}

<div class="card mb-4 section-card submit-bar bg-white">

    <div class="card-body">

        <div class="d-flex justify-content-end">

            <a
                href="{{ $indexRoute }}"
                class="btn btn-secondary me-2"
            >
                Cancel
            </a>


            <button
                type="submit"
                class="btn btn-primary"
            >

                @if(isset($property))

                    Update Property

                @else

                    Save Property

                @endif

            </button>

        </div>

    </div>

</div>




{{-- ========================================================= --}}
{{-- CITY AJAX --}}
{{-- ========================================================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const wrapper =
        document.getElementById('floorPlansWrapper');

    const addButton =
        document.getElementById('addFloorPlan');

    const emptyState =
        document.getElementById('noFloorPlans');


    if (!wrapper || !addButton) {
        return;
    }


    let floorPlanIndex =
        wrapper.querySelectorAll('.floor-plan-item').length;


    function updateEmptyState() {

        const items =
            wrapper.querySelectorAll('.floor-plan-item');

        if (emptyState) {

            emptyState.style.display =
                items.length ? 'none' : 'block';

        }

    }


    function createFloorPlan(index) {

        const item =
            document.createElement('div');

        item.className =
            'floor-plan-item border rounded p-3 mb-3';


        item.innerHTML = `

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h6 class="mb-0">
                    Floor Plan
                </h6>

                <button
                    type="button"
                    class="btn btn-sm btn-outline-danger remove-floor-plan"
                >
                    <i class="bi bi-trash"></i>
                    Remove
                </button>

            </div>


            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Title
                    </label>

                    <input
                        type="text"
                        name="floor_plans[${index}][title]"
                        class="form-control"
                        placeholder="e.g. Type A"
                    >

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Configuration
                    </label>

                    <input
                        type="text"
                        name="floor_plans[${index}][configuration]"
                        class="form-control"
                        placeholder="e.g. 2 BHK"
                    >

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Area
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="floor_plans[${index}][area]"
                        class="form-control"
                    >

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Area Unit
                    </label>

                    <select
                        name="floor_plans[${index}][area_unit]"
                        class="form-select"
                    >

                        <option value="sqft">
                            Sq. Ft.
                        </option>

                        <option value="sqm">
                            Sq. Meter
                        </option>

                        <option value="sqyd">
                            Sq. Yard
                        </option>

                    </select>

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Price
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="floor_plans[${index}][price]"
                        class="form-control"
                    >

                </div>


                <div class="col-md-8 mb-3">

                    <label class="form-label">
                        Floor Plan Image
                    </label>

                    <input
                        type="file"
                        name="floor_plans[${index}][image]"
                        class="form-control"
                        accept="image/*"
                    >

                </div>


                <div class="col-md-2 mb-3">

                    <label class="form-label">
                        Sort Order
                    </label>

                    <input
                        type="number"
                        name="floor_plans[${index}][sort_order]"
                        class="form-control"
                        value="${index + 1}"
                    >

                </div>


                <div class="col-md-2 mb-3">

                    <label class="form-label d-block">
                        Status
                    </label>

                    <div class="form-check form-switch mt-2">

                        <input
                            type="hidden"
                            name="floor_plans[${index}][status]"
                            value="0"
                        >

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="floor_plans[${index}][status]"
                            value="1"
                            checked
                        >

                        <label class="form-check-label">
                            Active
                        </label>

                    </div>

                </div>

            </div>

        `;


        wrapper.appendChild(item);

        updateEmptyState();

    }


    addButton.addEventListener(
        'click',
        function () {

            createFloorPlan(
                floorPlanIndex
            );

            floorPlanIndex++;

        }
    );


    wrapper.addEventListener(
        'click',
        function (event) {

            const removeButton =
                event.target.closest(
                    '.remove-floor-plan'
                );


            if (!removeButton) {
                return;
            }


            const item =
                removeButton.closest(
                    '.floor-plan-item'
                );


            if (item) {

                item.remove();

                updateEmptyState();

            }

        }
    );


    updateEmptyState();

});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const stateSelect = document.getElementById('state_id');
    const citySelect = document.getElementById('city_id');

    if (!stateSelect || !citySelect) {
        return;
    }

    const selectedCity = String(
        citySelect.dataset.selectedCity || ''
    );

    async function loadCities(stateId, selectedCityId = '') {

        citySelect.innerHTML =
            '<option value="">Loading cities...</option>';

        if (!stateId) {
            citySelect.innerHTML =
                '<option value="">Select City</option>';
            return;
        }

        try {

            /*
             * IMPORTANT:
             * Named route use nahi kar rahe.
             */
            const url =
                "{{ url('/admin/ajax/get-cities') }}/" + stateId

            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                throw new Error(
                    'HTTP ' + response.status
                );
            }

            const cities = await response.json();

            citySelect.innerHTML =
                '<option value="">Select City</option>';

            if (!Array.isArray(cities)) {
                throw new Error(
                    'Invalid city response'
                );
            }

            cities.forEach(function (city) {

                const option =
                    document.createElement('option');

                option.value = String(city.id);
                option.textContent = city.name;

                if (
                    selectedCityId &&
                    String(city.id) ===
                    String(selectedCityId)
                ) {
                    option.selected = true;
                }

                citySelect.appendChild(option);
            });

        } catch (error) {

            console.error(
                'City loading error:',
                error
            );

            citySelect.innerHTML =
                '<option value="">Unable to load cities</option>';
        }
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT PAGE
    |--------------------------------------------------------------------------
    */

    const initialState = stateSelect.value;

    if (initialState) {

        loadCities(
            initialState,
            selectedCity
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STATE CHANGE
    |--------------------------------------------------------------------------
    */

    stateSelect.addEventListener(
        'change',
        function () {

            loadCities(
                this.value,
                ''
            );

        }
    );

});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const wrapper = document.getElementById('specificationsWrapper');
    const addButton = document.getElementById('addSpecification');
    const emptyState = document.getElementById('noSpecifications');

    if (!wrapper || !addButton) {
        return;
    }

    let specificationIndex =
        wrapper.querySelectorAll('.specification-item').length;

    function updateEmptyState() {

        const items =
            wrapper.querySelectorAll('.specification-item');

        if (emptyState) {
            emptyState.style.display =
                items.length ? 'none' : 'block';
        }
    }

    function createSpecification(index) {

        const item =
            document.createElement('div');

        item.className =
            'specification-item border rounded p-3 mb-3';

        item.innerHTML = `
            <div class="row">

                <div class="col-md-3 mb-3">
                    <label class="form-label">
                        Title
                    </label>

                    <input
                        type="text"
                        name="specifications[${index}][title]"
                        class="form-control"
                        placeholder="e.g. Flooring"
                    >
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">
                        Value
                    </label>

                    <input
                        type="text"
                        name="specifications[${index}][value]"
                        class="form-control"
                        placeholder="e.g. Italian Marble"
                    >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        Description
                    </label>

                    <input
                        type="text"
                        name="specifications[${index}][description]"
                        class="form-control"
                        placeholder="Optional description"
                    >
                </div>

                <div class="col-md-1 mb-3">
                    <label class="form-label">
                        Order
                    </label>

                    <input
                        type="number"
                        name="specifications[${index}][sort_order]"
                        class="form-control"
                        value="${index + 1}"
                        min="0"
                    >
                </div>

                <div class="col-md-1 mb-3">
                    <label class="form-label">
                        Status
                    </label>

                    <div class="form-check mt-2">

                        <input
                            type="hidden"
                            name="specifications[${index}][status]"
                            value="0"
                        >

                        <input
                            type="checkbox"
                            name="specifications[${index}][status]"
                            value="1"
                            class="form-check-input"
                            checked
                        >

                    </div>
                </div>

            </div>

            <div class="text-end">

                <button
                    type="button"
                    class="btn btn-sm btn-outline-danger removeSpecification"
                >
                    <i class="bi bi-trash"></i>
                    Remove
                </button>

            </div>
        `;

        wrapper.appendChild(item);

        updateEmptyState();
    }


    addButton.addEventListener('click', function () {

        createSpecification(
            specificationIndex
        );

        specificationIndex++;
    });


    wrapper.addEventListener('click', function (event) {

        const removeButton =
            event.target.closest(
                '.removeSpecification'
            );

        if (!removeButton) {
            return;
        }

        const item =
            removeButton.closest(
                '.specification-item'
            );

        if (item) {
            item.remove();
            updateEmptyState();
        }

    });


    updateEmptyState();

});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const propertyTypeSelect = document.getElementById('property_type_id');

    if (!propertyTypeSelect) {
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Property Type Conditional Fields
    |--------------------------------------------------------------------------
    |
    | We use the actual Property Type name instead of hard-coded database IDs.
    | This keeps the form safe if property type IDs change.
    |
    */

    const fieldNames = {
        bedrooms: 'bedrooms',
        bathrooms: 'bathrooms',
        balconies: 'balconies',
        floor: 'floor',
        total_floors: 'total_floors',
        parking: 'parking'
    };

    function getFieldColumn(fieldName) {
        const field = document.querySelector('[name="' + fieldName + '"]');

        if (!field) {
            return null;
        }

        return field.closest('.col-md-3, .col-md-4, .col-md-6, .mb-3');
    }

    function setFieldVisible(fieldName, visible) {
        const column = getFieldColumn(fieldName);

        if (!column) {
            return;
        }

        column.style.display = visible ? '' : 'none';

        const field = document.querySelector('[name="' + fieldName + '"]');

        if (field) {
            field.disabled = !visible;
        }
    }

    function updatePropertyTypeFields() {

        const selectedOption =
            propertyTypeSelect.options[propertyTypeSelect.selectedIndex];

        const typeName =
            selectedOption
                ? selectedOption.textContent.trim().toLowerCase()
                : '';

        /*
        |--------------------------------------------------------------------------
        | Default
        |--------------------------------------------------------------------------
        */

        Object.keys(fieldNames).forEach(function (fieldName) {
            setFieldVisible(fieldName, true);
        });

        /*
        |--------------------------------------------------------------------------
        | Plot / Land
        |--------------------------------------------------------------------------
        |
        | Plot/Land normally doesn't need bedroom, bathroom, balcony,
        | floor or total-floor fields.
        |
        */

        const isPlotOrLand =
            typeName.includes('plot') ||
            typeName.includes('land') ||
            typeName.includes('residential plot') ||
            typeName.includes('commercial plot');

        if (isPlotOrLand) {

            setFieldVisible('bedrooms', false);
            setFieldVisible('bathrooms', false);
            setFieldVisible('balconies', false);
            setFieldVisible('floor', false);
            setFieldVisible('total_floors', false);

        }

        /*
        |--------------------------------------------------------------------------
        | Commercial
        |--------------------------------------------------------------------------
        |
        | Commercial properties generally don't use bedroom,
        | bathroom and balcony fields in the same way as residential.
        | Floor information remains useful.
        |
        */

        const isCommercial =
            typeName.includes('commercial') ||
            typeName.includes('office') ||
            typeName.includes('shop') ||
            typeName.includes('showroom') ||
            typeName.includes('warehouse') ||
            typeName.includes('retail');

        if (isCommercial && !isPlotOrLand) {

            setFieldVisible('bedrooms', false);
            setFieldVisible('bathrooms', false);
            setFieldVisible('balconies', false);

        }

        /*
        |--------------------------------------------------------------------------
        | Open Land / Agricultural
        |--------------------------------------------------------------------------
        */

        const isAgricultural =
            typeName.includes('agricultural') ||
            typeName.includes('farm land') ||
            typeName.includes('farmland');

        if (isAgricultural) {

            setFieldVisible('bedrooms', false);
            setFieldVisible('bathrooms', false);
            setFieldVisible('balconies', false);
            setFieldVisible('floor', false);
            setFieldVisible('total_floors', false);
            setFieldVisible('parking', false);

        }
    }

    propertyTypeSelect.addEventListener(
        'change',
        updatePropertyTypeFields
    );

    /*
    |--------------------------------------------------------------------------
    | Initial state
    |--------------------------------------------------------------------------
    */

    updatePropertyTypeFields();

});
</script>