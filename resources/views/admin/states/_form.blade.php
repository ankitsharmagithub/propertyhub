<div class="mb-3">
    <label class="form-label">State Name</label>

    <input
        type="text"
        name="name"
        class="form-control"
        value="{{ old('name', $state->name ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label class="form-label">State Code</label>

    <input
        type="text"
        name="code"
        class="form-control"
        value="{{ old('code', $state->code ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label class="form-label">Status</label>

    <select name="status" class="form-select">

        <option value="1"
            {{ old('status', $state->status ?? 1) == 1 ? 'selected' : '' }}>
            Active
        </option>

        <option value="0"
            {{ old('status', $state->status ?? 1) == 0 ? 'selected' : '' }}>
            Inactive
        </option>

    </select>
</div>

<button type="submit" class="btn btn-primary">
    Save
</button>

<a href="{{ route('admin.states.index') }}" class="btn btn-secondary">
    Cancel
</a>