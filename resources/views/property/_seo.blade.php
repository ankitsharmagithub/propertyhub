<h5 class="mb-4">SEO Settings</h5>

<form action="{{ route('admin.properties.update', $property->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label class="form-label">Meta Title</label>

        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $property->meta_title) }}">

    </div>

    <div class="mb-3">

        <label class="form-label">Meta Description</label>

        <textarea name="meta_description" rows="5" class="form-control">{{ old('meta_description', $property->meta_description) }}</textarea>

    </div>

    <button class="btn btn-success">

        Save SEO

    </button>

</form>
