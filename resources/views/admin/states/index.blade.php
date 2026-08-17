@extends('layouts.app')

@section('title', 'States')

@section('content')

<div class="card shadow-sm">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            State Management
        </h5>

        <a href="{{ route('admin.states.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Add State
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
                    placeholder="Search State">

            </div>

            <div class="col-md-2">

                <button class="btn btn-primary">
                    Search
                </button>

            </div>

            <div class="col-md-2">

                <a href="{{ route('admin.states.index') }}" class="btn btn-secondary">

                    Reset

                </a>

            </div>

        </form>

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light">

                <tr>

                    <th width="70">#</th>

                    <th>State Name</th>

                    <th width="120">Code</th>

                    <th width="120">Status</th>

                    <th width="180">Action</th>

                </tr>

                </thead>

                <tbody>

                @forelse($states as $state)

                    <tr>

                        <td>{{ $state->id }}</td>

                        <td>{{ $state->name }}</td>

                        <td>{{ $state->code }}</td>

                        <td>

                            @if($state->status)

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
                                href="{{ route('admin.states.edit',$state->id) }}"
                                class="btn btn-sm btn-warning">

                                Edit

                            </a>

                            <form
                                action="{{ route('admin.states.destroy',$state->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this state?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center">

                            No States Found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $states->links() }}

        </div>

    </div>

</div>

@endsection