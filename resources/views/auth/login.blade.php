<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-RealState Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
                <p class="text-muted small m-0">Delhi NCR Private Property Portal</p>
            </div>

            <!-- Role Selection Tabs (User / Agent / Admin) -->
            <div class="auth-role-tabs mb-4 p-1 rounded-pill d-flex bg-paper">
                <button type="button" class="tab-btn active flex-fill rounded-pill py-2 border-0 small fw-semibold"
                    data-role="user" onclick="switchRole('user', this)">
                    <i class="bi bi-person me-1"></i> User
                </button>
                <button type="button" class="tab-btn flex-fill rounded-pill py-2 border-0 small fw-semibold"
                    data-role="agent" onclick="switchRole('agent', this)">
                    <i class="bi bi-briefcase me-1"></i> Agent
                </button>
                <button type="button" class="tab-btn flex-fill rounded-pill py-2 border-0 small fw-semibold"
                    data-role="admin" onclick="switchRole('admin', this)">
                    <i class="bi bi-shield-lock me-1"></i> Admin
                </button>
            </div>

            <!-- Title Section -->
            <div class="text-center mb-4">
                <h1 class="h4 fw-bold text-ink mb-1" id="authTitle">Welcome back</h1>

            </div>

            <!-- Session Status Component -->
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <input type="hidden" name="user_type" id="userTypeInput" value="user">

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold text-ink-soft">Email address</label>
                    <div class="position-relative input-wrapper">
                        <input id="email" class="form-control custom-input @error('email') is-invalid @enderror"
                            type="email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="you@example.com" />
                        <i class="bi bi-envelope field-icon"></i>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1 small text-danger" />
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="password" class="form-label small fw-semibold text-ink-soft m-0">Password</label>
                        @if (Route::has('password.request'))
                            <a class="extra-small text-decoration-none text-gold fw-semibold hover-underline"
                                href="{{ route('password.request') }}">
                                Forgot?
                            </a>
                        @endif
                    </div>
                    <div class="position-relative input-wrapper">
                        <input id="password" class="form-control custom-input @error('password') is-invalid @enderror"
                            type="password" name="password" required placeholder="••••••••" />
                        <i class="bi bi-lock field-icon"></i>
                        <button type="button" class="toggle-password" id="togglePasswordBtn"
                            onclick="togglePasswordVisibility()">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 small text-danger" />
                </div>

                <!-- Remember Me -->
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check custom-checkbox">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label small text-grey ms-1" style="cursor: pointer;">
                            Remember me
                        </label>
                    </div>
                </div>

                <!-- Submit CTA Button -->
                <button type="submit"
                    class="btn btn-luxury w-100 d-flex align-items-center justify-content-center gap-2 py-2"
                    id="submitBtn">
                    <span>Sign In</span>
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>

            <!-- Social Logins (Hidden when Admin tab selected) -->


            <!-- Registration Route CTA -->
            @if (Route::has('register'))
                <p class="text-center small text-grey mt-4 mb-0" id="registerCta">
                    New to Estate?
                    <a href="{{ route('register') }}"
                        class="fw-bold text-ink text-decoration-none border-bottom border-dark pb-1 ms-1">
                        Create account
                    </a>
                </p>
            @endif


        </div>
    </div>
    <!-- <div class="split">


        <div class="flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-20">
            <div class="mx-auto w-full max-w-sm">

                <div class="mb-12 flex items-center gap-2.5">
                    <span class="brand-mark"><span></span></span>
                    <span class="display text-[15px] font-semibold tracking-tight text-gray-900">Your App</span>
                </div>

                <h1 class="display text-[28px] font-semibold tracking-tight text-gray-900">Welcome back</h1>
                <p class="mt-2 text-sm text-gray-500">Sign in to pick up right where you left off.</p>


                <x-auth-session-status class="mt-6" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="mt-9 space-y-5">
                    @csrf


                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>


                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1.5 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>


                    <div class="flex items-center justify-between pt-1">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-gray-900 shadow-sm focus:ring-gray-900" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
<a class="text-sm text-gray-500 underline hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
@endif
                    </div>

                    <button type="submit" class="mt-2 w-full rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
                        {{ __('Log in') }}
                    </button>
                </form>

                @if (Route::has('register'))
<p class="mt-8 text-center text-sm text-gray-500">
                        {{ __("Don't have an account?") }}
                        <a href="{{ route('register') }}" class="font-medium text-gray-900 underline">{{ __('Sign up') }}</a>
                    </p>
@endif
            </div>
        </div>


        <div class="panel hidden lg:flex lg:flex-col lg:justify-between lg:p-14">
            <div class="accent-bar"></div>
            <div class="dotgrid"></div>

            <div class="relative z-10 flex items-center justify-between">
                <span class="display text-sm font-semibold tracking-tight text-white/90">Your App</span>
                <span class="pill">v2.0 — Now live</span>
            </div>

            <div class="relative z-10 max-w-md">
                <span class="quote-mark">&ldquo;</span>
                <p class="display -mt-2 text-2xl font-medium leading-snug text-white">
                    Switching to this changed how our whole team ships. Setup took ten minutes.
                </p>
                <div class="mt-6 flex items-center gap-3">
                    <div class="h-9 w-9 rounded-full bg-white/10 ring-1 ring-white/20"></div>
                    <div>
                        <p class="text-sm font-medium text-white">Sarah Klein</p>
                        <p class="text-xs text-white/50">Head of Ops, Northwind</p>
                    </div>
                </div>
            </div>

            <div class="relative z-10 flex items-center gap-8 text-xs text-white/40">
                <span>&copy; {{ date('Y') }} Your App</span>
                <span>Privacy</span>
                <span>Terms</span>
            </div>
        </div>

    </div> -->



</body>

<script>
    function switchRole(role, element) {
        // Update Active Tab Class
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        element.classList.add('active');

        // Update Hidden Input Value
        document.getElementById('userTypeInput').value = role;

        // UI Content References
        const title = document.getElementById('authTitle');
        const subtitle = document.getElementById('authSubtitle');
        const socialSection = document.getElementById('socialAuthSection');

        // Dynamic Title Updates
        if (role === 'user') {
            title.innerText = 'Welcome back';
            subtitle.innerText = 'Sign in to continue discovering curated properties.';
            socialSection.style.display = 'block';
        } else if (role === 'agent') {
            title.innerText = 'Agent Portal';
            subtitle.innerText = 'Access your listings, client leads, and market analytics.';
            socialSection.style.display = 'block';
        } else if (role === 'admin') {
            title.innerText = 'System Administration';
            subtitle.innerText = 'Secure access for platform control and site management.';
            socialSection.style.display = 'none'; // Hide social options for high-privilege accounts
        }
    }

    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>

</html>
