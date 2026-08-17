<div class="mb-3">

    <label>Name</label>

    <input
        type="text"
        name="name"
        class="form-control"
        value="{{ old('name', $propertyType->name ?? '') }}">

</div>

<div class="mb-3">

    <label>Sort Order</label>

    <input
        type="number"
        name="sort_order"
        class="form-control"
        value="{{ old('sort_order', $propertyType->sort_order ?? 0) }}">

</div>

<div class="mb-3">

    <label>Status</label>

    <select name="status" class="form-select">

        <option value="1"
            {{ old('status', $propertyType->status ?? 1) == 1 ? 'selected' : '' }}>
            Active
        </option>

        <option value="0"
            {{ old('status', $propertyType->status ?? 1) == 0 ? 'selected' : '' }}>
            Inactive
        </option>

    </select>

</div>

<button class="btn btn-primary">

    Save

</button>

<a href="{{ route('admin.property-types.index') }}" class="btn btn-secondary">

    Cancel

</a>