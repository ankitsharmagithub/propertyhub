<form method="POST" action="{{ route('profile.update') }}">

    @csrf
    @method('PATCH')

    <div>
        <x-input-label for="name" :value="__('Name')" />

        <x-text-input id="name" class="block mt-1.5 w-full" type="text" name="name" :value="old('name', $user->name)" required
            autofocus />

        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />

        <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email', $user->email)"
            required />

        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-input-label for="phone" :value="__('Phone Number')" />

        <x-text-input id="phone" class="block mt-1.5 w-full" type="tel" name="phone" :value="old('phone', $user->phone)"
            required maxlength="10" />

        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-primary-button>
            {{ __('Update Profile') }}
        </x-primary-button>
    </div>

</form>
