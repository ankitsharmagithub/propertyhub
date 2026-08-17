<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Log in') }} — {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html, body { height: 100%; }
        body {
            margin: 0;
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
            background: #ffffff;
        }
        .display { font-family: 'Space Grotesk', ui-sans-serif, system-ui, sans-serif; }

        .split {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr;
        }
        @media (min-width: 1024px) {
            .split { grid-template-columns: 1fr 1fr; }
        }

        /* ---------- Right: brand panel ---------- */
        .panel {
            position: relative;
            background: #101014;
            color: #f5f5f4;
            overflow: hidden;
        }
        .panel .dotgrid {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255,255,255,0.09) 1px, transparent 1px);
            background-size: 26px 26px;
            mask-image: radial-gradient(circle at 30% 30%, black 0%, transparent 70%);
        }
        .panel .accent-bar {
            position: absolute;
            top: 0; left: 0;
            width: 4px;
            height: 100%;
            background: #baff29;
        }
        .panel .quote-mark {
            font-family: 'Space Grotesk', serif;
            font-size: 4rem;
            line-height: 1;
            color: #baff29;
        }
        .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.02em;
            color: #101014;
            background: #baff29;
            padding: 5px 12px;
            border-radius: 999px;
        }

        /* ---------- Left: form ---------- */
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #101014 !important;
            box-shadow: 0 0 0 3px rgba(16,16,20,0.08) !important;
        }
        .brand-mark {
            width: 30px; height: 30px;
            border-radius: 8px;
            background: #101014;
            display: flex; align-items: center; justify-content: center;
        }
        .brand-mark span {
            width: 10px; height: 10px;
            border-radius: 3px;
            background: #baff29;
        }
    </style>
</head>
<body class="antialiased">

    <div class="split">

        <!-- Left: Login form -->
        <div class="flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-20">
            <div class="mx-auto w-full max-w-sm">

                <div class="mb-12 flex items-center gap-2.5">
                    <span class="brand-mark"><span></span></span>
                    <span class="display text-[15px] font-semibold tracking-tight text-gray-900">Your App</span>
                </div>

                <h1 class="display text-[28px] font-semibold tracking-tight text-gray-900">Welcome back</h1>
                <p class="mt-2 text-sm text-gray-500">Sign in to pick up right where you left off.</p>

                <!-- Session Status -->
                <x-auth-session-status class="mt-6" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="mt-9 space-y-5">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1.5 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
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

        <!-- Right: Brand panel -->
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

    </div>

</body>
</html>