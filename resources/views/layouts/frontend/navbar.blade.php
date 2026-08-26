<header class="site-header is-dark" id="siteHeader">
    <div class="container-xl">
        <a href="{{ route('home') }}" class="brand">
            <span class="brand-mark">A</span>ureate<small>&nbsp;Estates</small>
        </a>

        @php
            // =========================================================
            // FOR BUYER (Sale) – States with cities having sale properties
            // =========================================================
            $statesForBuyer = \App\Models\State::where('status', 1)
                ->whereHas('cities.properties', function ($q) {
                    $q->where('status', 1)->where('listing_type', 'sale');
                })
                ->with([
                    'cities' => function ($q) {
                        $q->whereHas('properties', function ($p) {
                            $p->where('status', 1)->where('listing_type', 'sale');
                        })->limit(6); // Max 6 cities per state
                    },
                ])
                ->limit(4) // Max 4 states (columns)
                ->get();

            // If no states with sale properties, fallback to all states (without filter)
            if ($statesForBuyer->isEmpty()) {
                $statesForBuyer = \App\Models\State::where('status', 1)
                    ->with([
                        'cities' => function ($q) {
                            $q->limit(6);
                        },
                    ])
                    ->limit(4)
                    ->get();
            }

            // =========================================================
            // FOR RENTS (Rent) – States with cities having rent properties
            // =========================================================
            $statesForRent = \App\Models\State::where('status', 1)
                ->whereHas('cities.properties', function ($q) {
                    $q->where('status', 1)->where('listing_type', 'rent');
                })
                ->with([
                    'cities' => function ($q) {
                        $q->whereHas('properties', function ($p) {
                            $p->where('status', 1)->where('listing_type', 'rent');
                        })->limit(6);
                    },
                ])
                ->limit(4)
                ->get();

            if ($statesForRent->isEmpty()) {
                $statesForRent = \App\Models\State::where('status', 1)
                    ->with([
                        'cities' => function ($q) {
                            $q->limit(6);
                        },
                    ])
                    ->limit(4)
                    ->get();
            }

            // Property Types for Features menu
            $propertyTypes = \App\Models\PropertyType::where('status', 1)->limit(5)->get();
        @endphp





        {{-- Header Actions --}}

        <nav class="main-nav" aria-label="Primary">
            <!-- For Buyer Mega Menu -->
            <div class="nav-item">
                <a href="{{ route('properties.index', ['listing_type' => 'sale']) }}" class="nav-link">
                    For Buyer <i class="fa-solid fa-chevron-down chev"></i>
                </a>
                <div class="mega-menu">
                    @forelse($statesForBuyer as $state)
                        <div class="mega-col">
                            <div class="mega-col-title">
                                <a href="{{ route('properties.index', ['state_id' => $state->id, 'listing_type' => 'sale']) }}"
                                    class="text-decoration-none text-dark fw-bold">
                                    {{ $state->name }}
                                </a>
                            </div>
                            <ul class="list-unstyled mb-0">
                                @forelse($state->cities as $city)
                                    <li>
                                        <a href="{{ route('properties.city', $city->slug) }}?listing_type=sale">
                                            Properties in {{ $city->name }}
                                        </a>
                                    </li>
                                @empty
                                    <li>
                                        <a
                                            href="{{ route('properties.index', ['state_id' => $state->id, 'listing_type' => 'sale']) }}">
                                            No cities available
                                        </a>
                                    </li>
                                @endforelse
                                <li class="mt-2">
                                    <a href="{{ route('properties.index', ['state_id' => $state->id, 'listing_type' => 'sale']) }}"
                                        class="text-primary fw-bold">
                                        View All →
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @empty
                        <div class="mega-col">
                            <div class="mega-col-title">No States Available</div>
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="{{ route('properties.index', ['listing_type' => 'sale']) }}">
                                        View All Properties
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- For Rents Mega Menu -->
            <div class="nav-item">
                <a href="{{ route('properties.index', ['listing_type' => 'rent']) }}" class="nav-link">
                    For Rents <i class="fa-solid fa-chevron-down chev"></i>
                </a>
                <div class="mega-menu">
                    @forelse($statesForRent as $state)
                        <div class="mega-col">
                            <div class="mega-col-title">
                                <a href="{{ route('properties.index', ['state_id' => $state->id, 'listing_type' => 'rent']) }}"
                                    class="text-decoration-none text-dark fw-bold">
                                    {{ $state->name }}
                                </a>
                            </div>
                            <ul class="list-unstyled mb-0">
                                @forelse($state->cities as $city)
                                    <li>
                                        <a href="{{ route('properties.city', $city->slug) }}?listing_type=rent">
                                            Rent in {{ $city->name }}
                                        </a>
                                    </li>
                                @empty
                                    <li>
                                        <a
                                            href="{{ route('properties.index', ['state_id' => $state->id, 'listing_type' => 'rent']) }}">
                                            No cities available
                                        </a>
                                    </li>
                                @endforelse
                                <li class="mt-2">
                                    <a href="{{ route('properties.index', ['state_id' => $state->id, 'listing_type' => 'rent']) }}"
                                        class="text-primary fw-bold">
                                        View All →
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @empty
                        <div class="mega-col">
                            <div class="mega-col-title">No States Available</div>
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="{{ route('properties.index', ['listing_type' => 'rent']) }}">
                                        View All Rentals
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Features Mega Menu -->
            <div class="nav-item">
                <a href="#" class="nav-link">Features <i class="fa-solid fa-chevron-down chev"></i></a>
                <div class="mega-menu">
                    <div class="mega-col">
                        <div class="mega-col-title fw-bold">Developers</div>
                        <ul class="list-unstyled mb-0">
                            @forelse($developers as $developer)
                                <li>
                                    <a href="{{ url('/developer/' . $developer->slug) }}">
                                        {{ ucfirst($developer->name) }}
                                    </a>
                                </li>
                            @empty
                                <li><a href="#">No Developers Available</a></li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="mega-col">
                        <div class="mega-col-title fw-bold">Property Types</div>
                        <ul class="list-unstyled mb-0">
                            @forelse($propertyTypes as $type)
                                <li>
                                    <a href="{{ route('property.type', $type->slug) }}">
                                        {{ ucfirst($type->name) }}
                                    </a>
                                </li>
                            @empty
                                <li><a href="{{ route('properties.index') }}">All Properties</a></li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="header-actions">
            <button class="icon-btn d-search d-lg-none" aria-label="Search properties" data-bs-toggle="offcanvas"
                data-bs-target="#mobileMenu"><i class="fa-solid fa-magnifying-glass"></i></button>

            @auth
                {{-- नाम (Desktop पर दिखेगा) --}}
                <span class="text-white fw-bold me-2 d-none d-md-inline">
                    <i class="fa-solid fa-user me-1"></i>{{ auth()->user()->name }}
                </span>

                {{-- लॉगआउट बटन (सबके लिए) --}}
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm d-none d-md-inline-flex">
                        <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ url('/login') }}" class="btn btn-gold btn-sm d-none d-md-inline-flex text-white"><i
                        class="fa-solid fa-user"></i> Login</a>
            @endguest

            <button class="icon-btn d-lg-none" aria-label="Open menu" data-bs-toggle="offcanvas"
                data-bs-target="#mobileMenu"><i class="fa-solid fa-bars"></i></button>
        </div>
    </div>
</header>

{{-- =========================================================
MOBILE OFFCANVAS – Dynamic (All States)
========================================================= --}}
<div class="offcanvas offcanvas-end aureate-offcanvas" tabindex="-1" id="mobileMenu">
    <div class="offcanvas-header">
        <a href="{{ route('home') }}" class="brand"><span class="brand-mark">A</span>ureate</a>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="accordion mobile-accordion" id="mobileAccordion">
            {{-- For Buyer Accordion --}}
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#mBuyer">
                        For Buyer
                    </button>
                </h2>
                <div id="mBuyer" class="accordion-collapse collapse" data-bs-parent="#mobileAccordion">
                    <div class="accordion-body">
                        <a href="{{ route('properties.index', ['listing_type' => 'sale']) }}" class="fw-bold">All
                            Properties</a>
                        @foreach ($statesForBuyer as $state)
                            <a href="{{ route('properties.index', ['state_id' => $state->id]) }}"
                                class="fw-bold">{{ $state->name }}</a>
                            @foreach ($state->cities as $city)
                                <a href="{{ route('properties.city', $city->slug) }}"
                                    style="padding-left: 15px;">{{ $city->name }}</a>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- For Rents Accordion --}}
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#mRents">
                        For Rents
                    </button>
                </h2>
                <div id="mRents" class="accordion-collapse collapse" data-bs-parent="#mobileAccordion">
                    <div class="accordion-body">
                        <a href="{{ route('properties.index', ['listing_type' => 'rent']) }}" class="fw-bold">All
                            Rentals</a>
                        @foreach ($statesForRent as $state)
                            <a href="{{ route('properties.index', ['state_id' => $state->id, 'listing_type' => 'rent']) }}"
                                class="fw-bold">{{ $state->name }}</a>
                            @foreach ($state->cities as $city)
                                <a href="{{ route('properties.city', $city->slug) }}?listing_type=rent"
                                    style="padding-left: 15px;">{{ $city->name }}</a>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Features Accordion --}}
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#mFeatures">
                        Features
                    </button>
                </h2>
                <div id="mFeatures" class="accordion-collapse collapse" data-bs-parent="#mobileAccordion">
                    <div class="accordion-body">
                        <a href="{{ route('properties.index', ['listing_type' => 'sale']) }}">For Sale</a>
                        <a href="{{ route('properties.index', ['listing_type' => 'rent']) }}">For Rent</a>
                        <a href="{{ route('properties.index', ['availability' => 'New Launch']) }}">New Launch</a>
                        <a href="{{ route('properties.index', ['availability' => 'Ready to Move']) }}">Ready to
                            Move</a>
                        <a href="{{ route('properties.index', ['availability' => 'Under Construction']) }}">Under
                            Construction</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-cta">
            <a href="#" class="btn btn-gold">Schedule a Visit</a>
            <a href="#" class="btn btn-outline-light">List Your Property</a>
        </div>
    </div>
</div>




<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navItems = document.querySelectorAll('.main-nav .nav-item');

        navItems.forEach(item => {
            const link = item.querySelector('.nav-link');
            const menu = item.querySelector('.mega-menu');

            if (!menu) return;

            let timeout;

            // Hover handling
            item.addEventListener('mouseenter', () => {
                clearTimeout(timeout);
                // Close other active menus
                document.querySelectorAll('.mega-menu.dropdown-active').forEach(openMenu => {
                    if (openMenu !== menu) openMenu.classList.remove('dropdown-active');
                });
                menu.classList.add('dropdown-active');
            });

            item.addEventListener('mouseleave', () => {
                timeout = setTimeout(() => {
                    menu.classList.remove('dropdown-active');
                }, 150);
            });

            // Click handling for mobile/tablet support
            if (link) {
                link.addEventListener('click', (e) => {
                    // Prevent navigation if screen width is mobile or user toggling menu
                    if (window.innerWidth <= 992) {
                        e.preventDefault();
                        menu.classList.toggle('dropdown-active');
                    }
                });
            }
        });

        // Close open menus on outside click
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.main-nav')) {
                document.querySelectorAll('.mega-menu.dropdown-active').forEach(menu => {
                    menu.classList.remove('dropdown-active');
                });
            }
        });
    });
</script>
