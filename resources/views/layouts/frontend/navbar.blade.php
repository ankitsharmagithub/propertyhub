<nav class="navbar navbar-expand-lg bg-white border-bottom">

    <div class="container">

        <a
            class="navbar-brand fw-bold"
            href="{{ url('/') }}"
        >
            Property Portal
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#frontendNavbar"
            aria-controls="frontendNavbar"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div
            class="collapse navbar-collapse"
            id="frontendNavbar"
        >

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="{{ url('/') }}"
                    >
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="#"
                    >
                        Properties
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="#"
                    >
                        Cities
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="#"
                    >
                        Blog
                    </a>
                </li>

                @auth

                    <li class="nav-item ms-lg-2">

                        <a
                            href="{{ route('dashboard') }}"
                            class="btn btn-primary"
                        >
                            Dashboard
                        </a>

                    </li>

                @else

                    <li class="nav-item ms-lg-2">

                        <a
                            href="{{ route('login') }}"
                            class="btn btn-primary"
                        >
                            Login
                        </a>

                    </li>

                @endauth

            </ul>

        </div>

    </div>

</nav>