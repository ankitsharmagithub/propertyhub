<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Confirm Password') }} — {{ config('app.name', 'Laravel') }}</title>

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
        .key-badge {
            width: 56px; height: 56px;
            border-radius: 14px;
            background: rgba(186,255,41,0.12);
            border: 1px solid rgba(186,255,41,0.25);
            display: flex; align-items: center; justify-content: center;
        }
        .key-badge svg { width: 26px; height: 26px; }

        /* ---------- Left: form ---------- */
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

        <!-- Left: Confirm password form -->
        <div class="flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-20">
            <div class="mx-auto w-full max-w-sm">

                <div class="mb-12 flex items-center gap-2.5">
                    <span class="brand-mark"><span></span></span>
                    <span class="display text-[15px] font-semibold tracking-tight text-gray-900">Your App</span>
                </div>

                <h1 class="display text-[28px] font-semibold tracking-tight text-gray-900">Confirm your password</h1>
                <p class="mt-2 text-sm leading-relaxed text-gray-500">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>

                <form method="POST" action="{{ route('password.confirm') }}" class="mt-8 space-y-5">
                    @csrf

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1.5 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <button type="submit" class="mt-2 w-full rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
                        {{ __('Confirm') }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Right: Brand panel -->
        <div class="panel hidden lg:flex lg:flex-col lg:justify-between lg:p-14">
            <div class="accent-bar"></div>
            <div class="dotgrid"></div>

            <div class="relative z-10 flex items-center justify-between">
                <span class="display text-sm font-semibold tracking-tight text-white/90">Your App</span>
                <span class="pill">Identity check</span>
            </div>

            <div class="relative z-10 max-w-md">
                <div class="key-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#baff29" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2l8 4v6c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6l8-4z" />
                        <path d="M9.5 12l1.8 1.8L14.5 10" />
                    </svg>
                </div>
                <p class="display mt-6 text-2xl font-medium leading-snug text-white">
                    Just making sure it's really you.
                </p>
                <p class="mt-4 text-sm leading-relaxed text-white/60">
                    You're about to reach a sensitive part of your account. Re-entering your password keeps it protected, even if you stepped away.
                </p>
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