@extends('layouts.app')


@section('title', 'Users')

@section('content')

    <div class="card">

        <div class="card-header">
            <h4 class="mb-0">Users</h4>
        </div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Properties</th>
                            <th>Status</th>
                            <th>Registered</th>
                            <th width="220">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($users as $user)
                            <tr>

                                <td>
                                    {{ $users->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    {{ $user->name }}
                                </td>

                                <td>
                                    {{ $user->email }}
                                </td>

                                <td>
                                    {{ $user->phone ?? '-' }}
                                </td>

                                <td>
                                    {{ $user->properties_count }}
                                </td>

                                <td>

                                    @if ($user->status)
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
                                    {{ $user->created_at?->format('d M Y') }}
                                </td>

                                <td>

                                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-info">
                                        View
                                    </a>

                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.users.status', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn btn-sm btn-secondary">
                                            {{ $user->status ? 'Deactivate' : 'Activate' }}
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="text-center">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                {{ $users->links() }}
            </div>

        </div>

    </div>

@endsection
