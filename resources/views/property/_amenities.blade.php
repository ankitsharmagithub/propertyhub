<h5 class="mb-4">

    Property Amenities

</h5>

<form action="{{ route('admin.properties.update',$property->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="row">

        @foreach($amenities as $amenity)

            <div class="col-md-3 mb-3">

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="amenities[]"
                        value="{{ $amenity->id }}"
                        id="amenity{{ $amenity->id }}"

                        {{ $property->amenities->contains($amenity->id) ? 'checked' : '' }}>

                    <label
                        class="form-check-label"
                        for="amenity{{ $amenity->id }}">

                        @if($amenity->icon)

                            <i class="{{ $amenity->icon }}"></i>

                        @endif

                        {{ $amenity->name }}

                    </label>

                </div>

            </div>

        @endforeach

    </div>

    <button class="btn btn-primary">

        Save Amenities

    </button>

</form>