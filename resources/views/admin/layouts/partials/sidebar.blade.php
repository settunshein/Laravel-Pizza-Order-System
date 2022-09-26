<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-1 text-muted">
            <span>GENERAL</span>
            <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link @yield('dashboard-active')" href="{{ route('dashboard') }}">
                    <span data-feather="airplay"></span>
                    Dashboard
                </a>
            </li>   

            <li class="nav-item">
                <a class="nav-link @yield('category-active')" href="{{ route('category#index') }}">
                    <span data-feather="align-left"></span>
                    Category
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link @yield('product-active')" href="{{ route('product#index') }}">
                    <span data-feather="triangle" style="transform: rotate(12deg);"></span>
                    Product
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @yield('order-active')" href="{{ route('order#index') }}">
                    <span data-feather="file-text"></span>
                    Order
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @yield('admin-active')" href="{{ route('admin#index') }}">
                    <span data-feather="users"></span>
                    Admins
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @yield('customer-active')" href="{{ route('customer#index') }}">
                    <span data-feather="users"></span>
                    Customers
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @yield('contact-active')" href="{{ route('contact#index') }}">
                    <span data-feather="mail"></span>
                    Contact
                </a>
            </li>
        </ul>
        
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>SETTINGS</span>
            <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link @yield('profile-active')" href="{{ route('admin#profilePage') }}">
                    <span data-feather="user"></span>
                    Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @yield('password-active')" href="{{ route('admin#changePasswordPage') }}">
                    <span data-feather="lock"></span>
                    Change Password
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('auth#logout') }}">
                    <span data-feather="log-out"></span>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>