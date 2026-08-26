@extends('layouts.app')

@section('title', 'Developers')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>Developers</h3>

        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            + Add Developers
        </a>

    </div>

    <form method="GET" class="mb-3">

        <div class="row">

            <div class="col-md-4">

                <input type="text" name="search" class="form-control" placeholder="Search Developer..."
                    value="{{ request('search') }}">

            </div>

            <div class="col-md-2">

                <button class="btn btn-dark">
                    Search
                </button>

            </div>

        </div>

    </form>

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-bordered align-middle">

                <thead>

                    <tr>

                        <th width="70">ID</th>

                        <th>Name</th>

                        <th>Slug</th>

                        <th>Status</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($categories as $category)
                        <tr>

                            <td>{{ $category->id }}</td>

                            <td>{{ $category->name }}</td>

                            <td>{{ $category->slug }}</td>

                            <td>

                                @if ($category->status)
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

                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Delete this category?')" class="btn btn-danger btn-sm">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center">
                                No Developer Found
                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

            {{ $categories->links() }}

        </div>

    </div>

@endsection
