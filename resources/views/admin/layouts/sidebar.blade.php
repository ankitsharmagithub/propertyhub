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

            Masters

        </li>

        <li>

            <a href="{{ route('admin.categories.index') }}"
   class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
    <i class="bi bi-grid"></i>
    Categories
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

        <li class="menu-title">

            Properties

        </li>

        <li>

            <a href="#">

                

                <a href="{{ route('admin.properties.index') }}"
class="{{ request()->routeIs('admin.properties.*') ? 'active' : '' }}">
    <i class="bi bi-geo-alt"></i>
    Properties
</a>


            </a>

        </li>

        <li class="menu-title">

            CMS

        </li>

        <li>

            <a href="#">

                <i class="bi bi-journal-text"></i>

                Blogs

            </a>

        </li>

        <li>

            <a href="#">

                <i class="bi bi-file-earmark-text"></i>

                Pages

            </a>

        </li>

        <li class="menu-title">

            Settings

        </li>

        <li>

            <a href="#">

                <i class="bi bi-gear"></i>

                General Settings

            </a>

        </li>

    </ul>

</aside>