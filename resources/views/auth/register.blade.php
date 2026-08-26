<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Register') }} — {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/frontend/main.css'])


    <style>
        :root {
            /* ---- Color tokens ---- */
            --ink: #0a1411;
            --ink-soft: #182823;

            --paper: #f2f7f5;
            --paper-deep: #e1ede8;

            --surface: #ffffff;

            --gold: #082f91;
            --gold-bright: #ff6b35;

            --olive: #1e3a8a;

            --grey: #526560;
            --grey-light: #94a3b8;

            --line: rgba(10, 20, 17, 0.12);
            --line-soft: rgba(10, 20, 17, 0.06);
            --line-on-dark: rgba(242, 247, 245, 0.18);

            --font-display: "Poppins", sans-serif;
            --font-body: "Manrope", sans-serif;

            --radius-s: 6px;
            --radius-m: 12px;
            --radius-l: 22px;
            --ease: cubic-bezier(0.22, 1, 0.36, 1);
            --dur: 0.6s;
        }

        body {
            font-family: var(--font-body);
            color: var(--ink);
            background-color: var(--ink);
        }

        /* Background Layout & Dynamic Overlays */
        .auth-hero-wrapper {
            min-height: 100vh;
            position: relative;
            overflow: hidden;
            background-image: url('https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?q=80&w=2075&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }

        .auth-bg-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(10, 20, 17, 0.85) 0%, rgba(8, 47, 145, 0.65) 100%);
            z-index: 1;
        }

        .auth-ambient-glow {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 107, 53, 0.25) 0%, rgba(0, 0, 0, 0) 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            animation: pulseGlow 8s infinite alternate ease-in-out;
        }

        /* Glassmorphism Card Container */
        .auth-card-centered {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: var(--radius-l);
            padding: 2.5rem 2rem;
        }

        /* Branding Styles */
        .brand-logo {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            color: var(--ink);
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 1.25rem;
        }

        .brand-icon {
            color: var(--gold-bright);
            font-size: 1.5rem;
        }

        /* Role Selection Tabs */
        .auth-role-tabs {
            background-color: var(--paper);
            border: 1px solid var(--line-soft);
        }

        .tab-btn {
            background: transparent;
            color: var(--grey);
            transition: all 0.3s var(--ease);
        }

        .tab-btn.active {
            background: var(--surface);
            color: var(--gold);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        /* Form Customizations */
        .custom-input {
            border-radius: var(--radius-m);
            border: 1px solid var(--line);
            padding: 0.65rem 1rem 0.65rem 2.5rem;
            font-size: 0.9rem;
            transition: all 0.25s var(--ease);
        }

        .custom-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(8, 47, 145, 0.12);
        }

        .field-icon {
            position: absolute;
            left: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--grey-light);
        }

        .toggle-password {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: var(--grey);
        }

        .btn-luxury {
            background-color: var(--gold);
            color: var(--surface);
            border-radius: var(--radius-m);
            font-weight: 600;
            border: none;
            transition: all 0.3s var(--ease);
        }

        .btn-luxury:hover {
            background-color: var(--olive);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(8, 47, 145, 0.3);
        }

        .btn-social {
            border: 1px solid var(--line);
            border-radius: var(--radius-m);
            background: var(--surface);
            padding: 0.5rem 1rem;
            color: var(--ink-soft);
            transition: all 0.25s var(--ease);
        }

        .btn-social:hover {
            background: var(--paper);
            border-color: var(--grey-light);
        }

        .extra-small {
            font-size: 0.75rem;
        }

        /* Animations */
        @keyframes pulseGlow {
            0% {
                transform: translate(-50%, -50%) scale(0.8);
                opacity: 0.5;
            }

            100% {
                transform: translate(-50%, -50%) scale(1.2);
                opacity: 0.9;
            }
        }

        .animate-fade-up {
            animation: fadeUp var(--dur) var(--ease) forwards;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="antialiased">


    <div class="auth-hero-wrapper d-flex align-items-center justify-content-center p-3 p-md-4">
        <!-- Animated Overlay Elements -->
        <div class="auth-bg-overlay"></div>
        <div class="auth-ambient-glow"></div>

        <!-- Centered Glass Card -->
        <div class="auth-card-centered shadow-lg animate-fade-up">

            <!-- Header / Brand Logo -->
            <div class="text-center mb-4">
                <a href="/" class="brand-logo justify-content-center mb-2">
                    <span class="brand-icon me-2">
                        <i class="bi bi-buildings-fill"></i>
                    </span>
                    <span class="brand-text">ESTATE</span>
                </a>

            </div>

            <!-- Role Selection Tabs (User / Agent / Admin) -->


            <!-- Title Section -->
            <div class="text-center mb-4">
                <h1 class="h4 fw-bold text-ink mb-1" id="authTitle">Create your account</h1>

            </div>

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                <!-- Hidden Input for Selected Role -->
                <input type="hidden" name="user_type" id="userTypeInput" value="user">

                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label small fw-semibold text-ink-soft">Full Name</label>
                    <div class="position-relative input-wrapper">
                        <input id="name" class="form-control custom-input @error('name') is-invalid @enderror"
                            type="text" name="name" value="{{ old('name') }}" required autofocus
                            autocomplete="name" placeholder="John Doe" />
                        <i class="bi bi-person field-icon"></i>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-1 small text-danger" />
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold text-ink-soft">Email address</label>
                    <div class="position-relative input-wrapper">
                        <input id="email" class="form-control custom-input @error('email') is-invalid @enderror"
                            type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                            placeholder="you@example.com" />
                        <i class="bi bi-envelope field-icon"></i>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1 small text-danger" />
                </div>

                <!-- Phone Field -->
                <div class="mb-3">
                    <label for="phone" class="form-label small fw-semibold text-ink-soft">Phone Number</label>
                    <div class="position-relative input-wrapper">
                        <input id="phone" class="form-control custom-input @error('phone') is-invalid @enderror"
                            type="tel" name="phone" value="{{ old('phone') }}" required autocomplete="tel"
                            placeholder="+91 98765 43210" />
                        <i class="bi bi-telephone field-icon"></i>
                    </div>
                    <x-input-error :messages="$errors->get('phone')" class="mt-1 small text-danger" />
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <label for="password" class="form-label small fw-semibold text-ink-soft">Password</label>
                    <div class="position-relative input-wrapper">
                        <input id="password" class="form-control custom-input @error('password') is-invalid @enderror"
                            type="password" name="password" required autocomplete="new-password"
                            placeholder="••••••••" />
                        <i class="bi bi-lock field-icon"></i>
                        <button type="button" class="toggle-password"
                            onclick="togglePasswordVisibility('password', 'toggleIcon1')">
                            <i class="bi bi-eye" id="toggleIcon1"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 small text-danger" />
                </div>

                <!-- Confirm Password Field -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label small fw-semibold text-ink-soft">Confirm
                        Password</label>
                    <div class="position-relative input-wrapper">
                        <input id="password_confirmation"
                            class="form-control custom-input @error('password_confirmation') is-invalid @enderror"
                            type="password" name="password_confirmation" required autocomplete="new-password"
                            placeholder="••••••••" />
                        <i class="bi bi-shield-check field-icon"></i>
                        <button type="button" class="toggle-password"
                            onclick="togglePasswordVisibility('password_confirmation', 'toggleIcon2')">
                            <i class="bi bi-eye" id="toggleIcon2"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 small text-danger" />
                </div>

                <!-- Submit CTA Button -->
                <button type="submit"
                    class="btn btn-luxury w-100 d-flex align-items-center justify-content-center gap-2 py-2"
                    id="submitBtn">
                    <span>Create account</span>
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>

            <!-- Login Route CTA -->
            <p class="text-center small text-grey mt-4 mb-0">
                Already registered?
                <a href="{{ route('login') }}"
                    class="fw-bold text-ink text-decoration-none border-bottom border-dark pb-1 ms-1">
                    Log in
                </a>
            </p>

        </div>
    </div>


    <!--
    <div class="split">


        <div class="flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-20">
            <div class="mx-auto w-full max-w-sm">

                <div class="mb-12 flex items-center gap-2.5">
                    <span class="brand-mark"><span></span></span>
                    <span class="display text-[15px] font-semibold tracking-tight text-gray-900">Your App</span>
                </div>

                <h1 class="display text-[28px] font-semibold tracking-tight text-gray-900">Create your account</h1>
                <p class="mt-2 text-sm text-gray-500">Takes about a minute. No credit card required.</p>

                <form method="POST" action="{{ route('register') }}" class="mt-9 space-y-5">
                    @csrf


                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1.5 w-full" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>


                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email"
                            :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="phone" :value="__('Phone Number')" />

                        <x-text-input id="phone" class="block mt-1.5 w-full" type="tel" name="phone"
                            :value="old('phone')" required autocomplete="tel" />

                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>


                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1.5 w-full" type="password" name="password"
                            required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>


                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1.5 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <button type="submit"
                        class="mt-2 w-full rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
                        {{ __('Create account') }}
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-gray-500">
                    {{ __('Already registered?') }}
                    <a href="{{ route('login') }}"
                        class="font-medium text-gray-900 underline">{{ __('Log in') }}</a>
                </p>
            </div>
        </div>




    </div>
-->


</body>

</html>
