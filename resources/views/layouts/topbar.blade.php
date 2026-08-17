<header class="topbar">

    <div>

        <h4 class="mb-0">

            @yield('title')

        </h4>

    </div>

    <div class="d-flex align-items-center gap-3">

        <i class="bi bi-bell fs-5"></i>

        <div class="dropdown">

            <a
                class="dropdown-toggle text-dark"
                href="#"
                data-bs-toggle="dropdown">

                {{ auth()->user()->name }}

            </a>

            <ul class="dropdown-menu dropdown-menu-end">

                <li>

                    <form
                        method="POST"
                        action="{{ route('logout') }}">

                        @csrf

                        <button
                            class="dropdown-item">

                            Logout

                        </button>

                    </form>

                </li>

            </ul>

        </div>

    </div>

</header>