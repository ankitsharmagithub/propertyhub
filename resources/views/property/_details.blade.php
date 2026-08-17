<h5 class="mb-4">Property Details</h5>

<form action="{{ route('admin.properties.update',$property->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="row">

        <div class="col-md-4 mb-3">
            <label class="form-label">Price</label>
            <input type="number"
                   name="price"
                   class="form-control"
                   value="{{ old('price',$property->price) }}">
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">Bedrooms</label>
            <input type="number"
                   name="bedrooms"
                   class="form-control"
                   value="{{ old('bedrooms',$property->bedrooms) }}">
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">Bathrooms</label>
            <input type="number"
                   name="bathrooms"
                   class="form-control"
                   value="{{ old('bathrooms',$property->bathrooms) }}">
        </div>

    </div>

    <div class="row">

        <div class="col-md-4 mb-3">
            <label class="form-label">Balconies</label>
            <input type="number"
                   name="balconies"
                   class="form-control"
                   value="{{ old('balconies',$property->balconies) }}">
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">Parking</label>
            <input type="number"
                   name="parking"
                   class="form-control"
                   value="{{ old('parking',$property->parking) }}">
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">Floor</label>
            <input type="number"
                   name="floor"
                   class="form-control"
                   value="{{ old('floor',$property->floor) }}">
        </div>

    </div>

    <div class="row">

        <div class="col-md-4 mb-3">
            <label class="form-label">Total Floors</label>
            <input type="number"
                   name="total_floors"
                   class="form-control"
                   value="{{ old('total_floors',$property->total_floors) }}">
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">Area</label>
            <input type="number"
                   step="0.01"
                   name="area"
                   class="form-control"
                   value="{{ old('area',$property->area) }}">
        </div>

        <div class="col-md-4 mb-3">

            <label class="form-label">Area Unit</label>

            <select name="area_unit" class="form-select">

                <option value="Sq Ft" {{ $property->area_unit=='Sq Ft'?'selected':'' }}>Sq Ft</option>

                <option value="Sq Yard" {{ $property->area_unit=='Sq Yard'?'selected':'' }}>Sq Yard</option>

                <option value="Sq Meter" {{ $property->area_unit=='Sq Meter'?'selected':'' }}>Sq Meter</option>

                <option value="Acre" {{ $property->area_unit=='Acre'?'selected':'' }}>Acre</option>

                <option value="Hectare" {{ $property->area_unit=='Hectare'?'selected':'' }}>Hectare</option>

            </select>

        </div>

    </div>

    <div class="mb-3">

        <label class="form-label">Address</label>

        <input type="text"
               name="address"
               class="form-control"
               value="{{ old('address',$property->address) }}">

    </div>

    <div class="row">

        <div class="col-md-4 mb-3">

            <label class="form-label">Pincode</label>

            <input type="text"
                   name="pincode"
                   class="form-control"
                   value="{{ old('pincode',$property->pincode) }}">

        </div>

        <div class="col-md-4 mb-3">

            <label class="form-label">Latitude</label>

            <input type="text"
                   name="latitude"
                   class="form-control"
                   value="{{ old('latitude',$property->latitude) }}">

        </div>

        <div class="col-md-4 mb-3">

            <label class="form-label">Longitude</label>

            <input type="text"
                   name="longitude"
                   class="form-control"
                   value="{{ old('longitude',$property->longitude) }}">

        </div>

    </div>

    <div class="mb-3">

        <label class="form-label">Short Description</label>

        <textarea name="short_description"
                  rows="3"
                  class="form-control">{{ old('short_description',$property->short_description) }}</textarea>

    </div>

    <div class="mb-3">

        <label class="form-label">Description</label>

        <textarea name="description"
                  rows="8"
                  class="form-control">{{ old('description',$property->description) }}</textarea>

    </div>

    <button class="btn btn-primary">

        Save Details

    </button>

</form>