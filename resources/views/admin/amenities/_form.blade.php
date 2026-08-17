<div class="mb-3">
    <label class="form-label">Amenity Name</label>

    <input
        type="text"
        name="name"
        class="form-control"
        value="{{ old('name', $amenity->name ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label class="form-label">Icon Class</label>

    <input
        type="text"
        name="icon"
        class="form-control"
        value="{{ old('icon', $amenity->icon ?? '') }}"
        placeholder="Example: bi bi-car-front">
</div>

<div class="mb-3">
    <label class="form-label">Status</label>

    <select name="status" class="form-select">

        <option value="1"
            {{ old('status', $amenity->status ?? 1) == 1 ? 'selected' : '' }}>
            Active
        </option>

        <option value="0"
            {{ old('status', $amenity->status ?? 1) == 0 ? 'selected' : '' }}>
            Inactive
        </option>

    </select>
</div>

<button class="btn btn-primary">
    Save
</button>

<a href="{{ route('admin.amenities.index') }}" class="btn btn-secondary">
    Cancel
</a>