<style>
    body {
        margin: 0;
        font-family: sans-serif;
    }

    .sidebar {
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        background-color: #343a40;
        color: #fff;
        overflow-y: auto;
        padding: 20px 15px;
        z-index: 1000;
        box-sizing: border-box;
    }

    .main-content {
        margin-left: 250px;
        padding: 20px;
        width: calc(100% - 250px);
        min-height: 100vh;
        background-color: #f8f9fa;
        box-sizing: border-box;
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            position: relative;
            height: auto;
        }

        .main-content {
            margin-left: 0;
            width: 100%;
        }
    }
</style>
<aside class="sidebar">
    <div class="sidebar-logo">
        <i class="bi bi-buildings"></i>
        Property Portal
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>
        </li>
        <li class="menu-title">Masters</li>
        <li>
            <a href="{{ route('admin.categories.index') }}"
                class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-grid"></i>
                Developers
            </a>
        </li>
        <li>
            <a href="{{ route('admin.property-types.index') }}"
                class="{{ request()->routeIs('admin.property-types.*') ? 'active' : '' }}">
                <i class="bi bi-grid"></i>
                Property Types
            </a>
        </li>
        <li>
            <a href="{{ route('admin.states.index') }}"
                class="{{ request()->routeIs('admin.states.*') ? 'active' : '' }}">
                <i class="bi bi-geo-alt"></i>
                States
            </a>
        </li>
        <li>
            <a href="{{ route('admin.cities.index') }}"
                class="{{ request()->routeIs('admin.cities.*') ? 'active' : '' }}">
                <i class="bi bi-geo-alt"></i>
                Cities
            </a>
        </li>
        <li>
            <a href="{{ route('admin.amenities.index') }}"
                class="{{ request()->routeIs('admin.amenities.*') ? 'active' : '' }}">
                <i class="bi bi-geo-alt"></i>
                Amenities
            </a>
        </li>
        <li class="menu-title">Properties</li>
        <li>
            <a href="{{ route('admin.properties.index') }}"
                class="{{ request()->routeIs('admin.properties.*') ? 'active' : '' }}">
                <i class="bi bi-geo-alt"></i>
                Properties
            </a>
        </li>
        <li class="menu-title">CMS</li>
        <li>
            <a href="{{ route('admin.users.index') }}">
                <i class="bi bi-people"></i>
                <span>Users</span>
            </a>
        </li>
        <li class="menu-title">Settings</li>
        <li>
            <a href="#">
                <i class="bi bi-gear"></i>
                General Settings
            </a>
        </li>
    </ul>
</aside>
