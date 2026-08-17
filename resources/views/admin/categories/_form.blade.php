<div class="card shadow-sm">
    <div class="card-body">

        <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name', $category->name ?? '') }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Icon</label>
            <input type="text"
                   name="icon"
                   class="form-control"
                   value="{{ old('icon', $category->icon ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file"
                   name="image"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number"
                   name="sort_order"
                   class="form-control"
                   value="{{ old('sort_order', $category->sort_order ?? 0) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>

            <select name="status" class="form-select">
                <option value="1"
                    {{ old('status', $category->status ?? 1) == 1 ? 'selected' : '' }}>
                    Active
                </option>

                <option value="0"
                    {{ old('status', $category->status ?? 1) == 0 ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>
        </div>

        <button class="btn btn-primary">
            Save Category
        </button>

        <a href="{{ route('admin.categories.index') }}"
           class="btn btn-secondary">
            Cancel
        </a>

    </div>
</div>