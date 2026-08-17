@extends('layouts.app')

@section('title', 'Amenities')

@section('content')

<div class="card shadow-sm">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">Amenity Management</h5>

        <a href="{{ route('admin.amenities.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Amenity
        </a>

    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" class="row mb-4">

            <div class="col-md-4">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    value="{{ request('search') }}"
                    placeholder="Search Amenity">

            </div>

            <div class="col-md-2">

                <button class="btn btn-primary">
                    Search
                </button>

            </div>

            <div class="col-md-2">

                <a href="{{ route('admin.amenities.index') }}" class="btn btn-secondary">
                    Reset
                </a>

            </div>

        </form>

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th width="60">ID</th>

                        <th>Name</th>

                        <th>Icon</th>

                        <th width="120">Status</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($amenities as $amenity)

                        <tr>

                            <td>{{ $amenity->id }}</td>

                            <td>{{ $amenity->name }}</td>

                            <td>
                                @if($amenity->icon)
                                    <i class="{{ $amenity->icon }}"></i>
                                    <small>{{ $amenity->icon }}</small>
                                @else
                                    -
                                @endif
                            </td>

                            <td>

                                @if($amenity->status)

                                    <span class="badge bg-success">Active</span>

                                @else

                                    <span class="badge bg-danger">Inactive</span>

                                @endif

                            </td>

                            <td>

                                <a href="{{ route('admin.amenities.edit',$amenity->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('admin.amenities.destroy',$amenity->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this amenity?')">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center">
                                No Amenities Found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $amenities->links() }}

        </div>

    </div>

</div>

@endsection