<div class="card property-card h-100 border-0 shadow-sm overflow-hidden">

```
{{-- Property Image --}}
<a
    href="{{ route('properties.show', $property->slug) }}"
    class="text-decoration-none"
>

    @if($property->featured_image)

        <img
            src="{{ asset('storage/properties/featured/' . $property->featured_image) }}"
            alt="{{ $property->title }}"
            class="card-img-top w-100"
            style="height: 240px; object-fit: cover;"
        >

    @else

        <div
            class="bg-light d-flex align-items-center justify-content-center"
            style="height: 240px;"
        >
            <span class="text-muted">
                No Image Available
            </span>
        </div>

    @endif

</a>


{{-- Property Details --}}
<div class="card-body">

    {{-- Badges --}}
    <div class="d-flex justify-content-between align-items-center mb-2">

        @if($property->availability)

            <span class="badge
                @if($property->availability === 'available')
                    bg-success-subtle text-success
                @elseif($property->availability === 'sold')
                    bg-danger-subtle text-danger
                @elseif($property->availability === 'rented')
                    bg-warning-subtle text-warning-emphasis
                @else
                    bg-info-subtle text-info
                @endif
            ">
                {{ ucfirst($property->availability) }}
            </span>

        @endif

        @if($property->featured)

            <span class="badge bg-primary-subtle text-primary">
                Featured
            </span>

        @endif

    </div>


    {{-- Title --}}
    <h5 class="card-title fw-bold mb-2">

        <a
            href="{{ route('properties.show', $property->slug) }}"
            class="text-dark text-decoration-none"
        >
            {{ $property->title }}
        </a>

    </h5>


    {{-- Location --}}
    <p class="text-muted small mb-3">

        <i class="bi bi-geo-alt"></i>

        {{ $property->city->name ?? '' }}

        @if($property->city && $property->state)
            ,
        @endif

        {{ $property->state->name ?? '' }}

    </p>


    {{-- Property Type --}}
    @if($property->propertyType)

        <div class="mb-3">

            <span class="small text-muted">
                <i class="bi bi-building"></i>

                {{ $property->propertyType->name }}

            </span>

        </div>

    @endif


    {{-- Price --}}
    @if($property->price)

        <h5 class="fw-bold text-primary mb-3">

            ₹{{ number_format($property->price) }}

        </h5>

    @endif


    {{-- Property Features --}}
    <div class="d-flex flex-wrap gap-3 text-muted small">

        @if($property->bedrooms)

            <span>
                <i class="bi bi-door-open"></i>
                {{ $property->bedrooms }} Beds
            </span>

        @endif


        @if($property->bathrooms)

            <span>
                <i class="bi bi-droplet"></i>
                {{ $property->bathrooms }} Baths
            </span>

        @endif


        @if($property->area)

            <span>
                <i class="bi bi-rulers"></i>
                {{ number_format($property->area) }} sq.ft
            </span>

        @endif

    </div>

</div>
```

</div>
