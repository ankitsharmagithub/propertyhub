@extends('layouts.app')

@section('title', 'Property Types')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">Property Types</h5>

        <a href="{{ route('admin.property-types.create') }}" class="btn btn-primary">
            Add Property Type
        </a>

    </div>

    <div class="card-body">

        <form method="GET" class="mb-3">

            <div class="row">

                <div class="col-md-4">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Search Property Type">

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary">
                        Search
                    </button>

                </div>

            </div>

        </form>

        <table class="table table-bordered">

            <thead>

            <tr>

                <th>ID</th>

                <th>Name</th>

                <th>Slug</th>

                <th>Status</th>

                <th>Action</th>

            </tr>

            </thead>

            <tbody>

            @forelse($propertyTypes as $propertyType)

                <tr>

                    <td>{{ $propertyType->id }}</td>

                    <td>{{ $propertyType->name }}</td>

                    <td>{{ $propertyType->slug }}</td>

                    <td>

                        @if($propertyType->status)

                            <span class="badge bg-success">Active</span>

                        @else

                            <span class="badge bg-danger">Inactive</span>

                        @endif

                    </td>

                    <td>

                        <a
                            href="{{ route('admin.property-types.edit',$propertyType->id) }}"
                            class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form
                            action="{{ route('admin.property-types.destroy',$propertyType->id) }}"
                            method="POST"
                            class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Delete this Property Type?')"
                                class="btn btn-sm btn-danger">

                                Delete

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" class="text-center">

                        No Record Found

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

        {{ $propertyTypes->links() }}

    </div>

</div>

@endsection