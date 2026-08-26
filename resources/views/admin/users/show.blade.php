@extends('layouts.app')

@section('title', 'User Details')

@section('content')

    <div class="row">

        {{-- User Information --}}
        <div class="col-md-4">

            <div class="card">

                <div class="card-header">
                    <h5 class="mb-0">User Details</h5>
                </div>

                <div class="card-body">

                    <div class="mb-3">
                        <strong>Name:</strong>
                        <div>{{ $user->name }}</div>
                    </div>

                    <div class="mb-3">
                        <strong>Email:</strong>
                        <div>{{ $user->email }}</div>
                    </div>

                    <div class="mb-3">
                        <strong>Phone:</strong>
                        <div>{{ $user->phone ?? '-' }}</div>
                    </div>

                    <div class="mb-3">
                        <strong>Status:</strong>

                        <div>
                            @if ($user->status)
                                <span class="badge bg-success">
                                    Active
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    Inactive
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <strong>Registered:</strong>
                        <div>
                            {{ $user->created_at?->format('d M Y, h:i A') }}
                        </div>
                    </div>

                    <div>
                        <strong>Total Properties:</strong>
                        <div>
                            {{ $user->properties->count() }}
                        </div>
                    </div>

                </div>

                <div class="card-footer">

                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                        Edit User
                    </a>

                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        Back
                    </a>

                </div>

            </div>

        </div>


        {{-- User Properties --}}
        <div class="col-md-8">

            <div class="card">

                <div class="card-header">
                    <h5 class="mb-0">User Properties</h5>
                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($user->properties as $property)
                                    <tr>

                                        <td>
                                            {{ $property->title }}
                                        </td>

                                        <td>
                                            @if ($property->status === 'published')
                                                <span class="badge bg-success">
                                                    Published
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    Draft
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $property->created_at?->format('d M Y') }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="3" class="text-center">
                                            No properties found.
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
