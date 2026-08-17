@extends('layouts.app')

@section('title', 'Properties')

@section('content')

<div class="card shadow-sm">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">Property Management</h5>

        <a href="{{ route('admin.properties.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Property
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
                    placeholder="Search by Property Code or Title">

            </div>

            <div class="col-md-2">

                <button class="btn btn-primary">
                    Search
                </button>

            </div>

            <div class="col-md-2">

                <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">
                    Reset
                </a>

            </div>

        </form>

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light">

                <tr>

                    <th>Code</th>

                    <th>Title</th>

                    <th>Category</th>

                    <th>Type</th>

                    <th>Location</th>

                    <th>Availability</th>

                    <th>Status</th>

                    <th width="180">Action</th>

                </tr>

                </thead>

                <tbody>

                @forelse($properties as $property)

                    <tr>

                        <td>{{ $property->property_code }}</td>

                        <td>{{ $property->title }}</td>

                        <td>{{ $property->category->name ?? '-' }}</td>

                        <td>{{ $property->propertyType->name ?? '-' }}</td>

                        <td>
                            {{ $property->city->name ?? '-' }},
                            {{ $property->state->name ?? '-' }}
                        </td>

                        <td>

                            @switch($property->availability)

                                @case('available')
                                    <span class="badge bg-success">Available</span>
                                    @break

                                @case('sold')
                                    <span class="badge bg-danger">Sold</span>
                                    @break

                                @case('rented')
                                    <span class="badge bg-warning text-dark">Rented</span>
                                    @break

                                @case('booked')
                                    <span class="badge bg-info">Booked</span>
                                    @break

                            @endswitch

                        </td>

                        <td>

                            @if($property->status)

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Inactive
                                </span>

                            @endif

                        </td>

                        <td>

                            <a
                                href="{{ route('admin.properties.edit',$property->id) }}"
                                class="btn btn-sm btn-warning">

                                Edit

                            </a>

                            <form
                                action="{{ route('admin.properties.destroy',$property->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this property?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="text-center">

                            No Properties Found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $properties->links() }}

        </div>

    </div>

</div>

@endsection