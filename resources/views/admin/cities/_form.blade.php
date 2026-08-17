<div class="mb-3">
    <label class="form-label">State</label>

    <select name="state_id" class="form-select" required>

        <option value="">Select State</option>

        @foreach($states as $state)

            <option
                value="{{ $state->id }}"
                {{ old('state_id', $city->state_id ?? '') == $state->id ? 'selected' : '' }}>

                {{ $state->name }}

            </option>

        @endforeach

    </select>

</div>

<div class="mb-3">

    <label class="form-label">City Name</label>

    <input
        type="text"
        name="name"
        class="form-control"
        value="{{ old('name', $city->name ?? '') }}"
        required>

</div>

<div class="mb-3">

    <label class="form-label">Status</label>

    <select name="status" class="form-select">

        <option value="1"
            {{ old('status', $city->status ?? 1) == 1 ? 'selected' : '' }}>

            Active

        </option>

        <option value="0"
            {{ old('status', $city->status ?? 1) == 0 ? 'selected' : '' }}>

            Inactive

        </option>

    </select>

</div>

<button class="btn btn-primary">
    Save
</button>

<a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">
    Cancel
</a>