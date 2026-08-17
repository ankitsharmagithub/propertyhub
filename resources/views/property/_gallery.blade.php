<h5 class="mb-3">

    Property Gallery

</h5>

<form action="{{  $galleryStoreRoute }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div class="mb-3">

        <input type="file"
               name="images[]"
               class="form-control"
               multiple
               accept="image/*">

    </div>

    <button class="btn btn-primary">

        Upload Images

    </button>

</form>

<hr>

<div class="row">

@forelse($property->images as $image)

<div class="col-md-3 mb-4">

    <div class="card">

        <img src="{{ asset('storage/properties/gallery/'.$image->image) }}"
             class="card-img-top"
             style="height:180px;object-fit:cover;">

        <div class="card-body p-2">

            <form action="{{ route($galleryDeleteRoute,$image->id) }}"
                  method="POST">

                @csrf
                @method('DELETE')

                <button
                    class="btn btn-danger btn-sm w-100">

                    Delete

                </button>

            </form>

        </div>

    </div>

</div>

@empty

<div class="col-12">

    <div class="alert alert-info">

        No Gallery Images Uploaded.

    </div>

</div>

@endforelse

</div>