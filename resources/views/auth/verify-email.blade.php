<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Verify Email') }} — {{ config('app.name', 'Laravel') }}</title>

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

        /* ---------- Left ---------- */
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
        .envelope-badge {
            width: 52px; height: 52px;
            border-radius: 14px;
            background: #f4f4f5;
            display: flex; align-items: center; justify-content: center;
        }
        .envelope-badge svg { width: 24px; height: 24px; }
        .status-banner {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            border-radius: 10px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            padding: 12px 14px;
        }
        .status-banner .dot {
            margin-top: 3px;
            flex: none;
            width: 16px; height: 16px;
            border-radius: 999px;
            background: #22c55e;
            display: flex; align-items: center; justify-content: center;
        }
    </style>
</head>
<body class="antialiased">

    <div class="split">

        <!-- Left: Verify email -->
        <div class="flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-20">
            <div class="mx-auto w-full max-w-sm">

                <div class="mb-10 flex items-center gap-2.5">
                    <span class="brand-mark"><span></span></span>
                    <span class="display text-[15px] font-semibold tracking-tight text-gray-900">Your App</span>
                </div>

                <div class="envelope-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#101014" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="5" width="18" height="14" rx="2" />
                        <path d="M3 7l9 6 9-6" />
                    </svg>
                </div>

                <h1 class="display mt-5 text-[28px] font-semibold tracking-tight text-gray-900">Check your inbox</h1>
                <p class="mt-2 text-sm leading-relaxed text-gray-500">
                    {{ __("Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.") }}
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="status-banner mt-6">
                        <span class="dot">
                            <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                        </span>
                        <p class="text-sm font-medium text-green-700">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </p>
                    </div>
                @endif

                <div class="mt-8 flex items-center justify-between">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
                            {{ __('Resend Verification Email') }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-500 underline hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right: Brand panel -->
        <div class="panel hidden lg:flex lg:flex-col lg:justify-between lg:p-14">
            <div class="accent-bar"></div>
            <div class="dotgrid"></div>

            <div class="relative z-10 flex items-center justify-between">
                <span class="display text-sm font-semibold tracking-tight text-white/90">Your App</span>
                <span class="pill">One step left</span>
            </div>

            <div class="relative z-10 max-w-md">
                <div class="key-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#baff29" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="5" width="18" height="14" rx="2" />
                        <path d="M3 7l9 6 9-6" />
                    </svg>
                </div>
                <p class="display mt-6 text-2xl font-medium leading-snug text-white">
                    Almost there — just confirm it's you.
                </p>
                <p class="mt-4 text-sm leading-relaxed text-white/60">
                    Verifying your email keeps your account recoverable and protects you from anyone signing up with an address that isn't theirs.
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