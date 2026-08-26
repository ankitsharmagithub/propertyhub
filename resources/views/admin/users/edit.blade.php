@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

    <div class="card">

        <div class="card-header">
            <h4 class="mb-0">Edit User</h4>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('admin.users.update', $user) }}">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Name
                        </label>

                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Phone
                        </label>

                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $user->phone) }}">

                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status" class="form-select @error('status') is-invalid @enderror">

                            <option value="1" @selected(old('status', $user->status) == 1)>
                                Active
                            </option>

                            <option value="0" @selected(old('status', $user->status) == 0)>
                                Inactive
                            </option>

                        </select>

                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                <button type="submit" class="btn btn-primary">
                    Update User
                </button>

                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

@endsection
