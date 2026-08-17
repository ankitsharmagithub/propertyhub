<aside class="sidebar">

    <div class="sidebar-logo">
        <i class="bi bi-buildings"></i>
        Property Portal
    </div>

    <ul class="sidebar-menu">

        <li>
            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>
        </li>

        <li class="menu-title">
            My Account
        </li>

        <li>
            <a href="{{ route('user.properties.index') }}"
               class="{{ request()->routeIs('user.properties.*') ? 'active' : '' }}">
                <i class="bi bi-building"></i>
                My Properties
            </a>
        </li>

        <li>
            <a href="{{ route('user.properties.create') }}"
               class="{{ request()->routeIs('user.properties.create') ? 'active' : '' }}">
                <i class="bi bi-plus-circle"></i>
                Add Property
            </a>
        </li>

        <li>
            <a href="{{ route('profile.edit') }}"
               class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <i class="bi bi-person"></i>
                My Profile
            </a>
        </li>

        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="btn btn-link text-decoration-none text-start w-100 px-0">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        </li>

    </ul>

</aside>