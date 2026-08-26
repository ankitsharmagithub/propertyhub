@extends('layouts.app')


@section('content')
    <div class="container">

        <h1>User Profile</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">

            @csrf
            @method('PATCH')

            <div>
                <x-input-label for="name" :value="__('Name')" />

                <x-text-input id="name" class="block mt-1.5 w-full" type="text" name="name" :value="old('name', $user->name)"
                    required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email', $user->email)"
                    required readonly />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="phone" :value="__('Phone Number')" />

                <x-text-input id="phone" class="block mt-1.5 w-full" type="tel" name="phone" :value="old('phone', $user->phone)"
                    required maxlength="10" />

                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="profile_image" :value="__('Profile Image')" />

                @if ($user->profile_image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" width="100"
                            height="100" style="object-fit: cover; border-radius: 50%;">
                    </div>
                @endif

                <input id="profile_image" class="block mt-1.5 w-full" type="file" name="profile_image"
                    accept="image/*" />

                <x-input-error :messages="$errors->get('profile_image')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-primary-button>
                    {{ __('Update Profile') }}
                </x-primary-button>
            </div>

        </form>
    </div>
@endsection
