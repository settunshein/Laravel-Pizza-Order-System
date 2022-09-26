<!-- Navbar Start -->
<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="{{ route('user#home') }}" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-dark bg-light px-2">PIZZA</span>
                    <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">HUB</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{ route('user#home') }}" class="nav-item nav-link active">HOME</a>
                        <a href="{{ route('user#contactPage') }}" class="nav-item nav-link">CONTACT</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <div class="dropdown d-inline-block">
                            <a class="btn btn-warning dropdown-toggle px-4" href="#" role="button" data-bs-toggle="dropdown">
                                <span data-feather="user" class="text-light" width="20px" height="20px"></span>&nbsp;
                                <span class="text-light">{{ Auth::user()->name }}</span>
                                <i class="fas fa-caret-down text-light ms-2"></i>
                            </a>
                          
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item my-2" href="{{ route('user#showEditProfilePage') }}">Account</a></li>
                                <li><a class="dropdown-item my-2" href="{{ route('user#changePasswordPage') }}">Change Password</a></li>
                                <li><a class="dropdown-item my-2" href="{{ route('auth#logout') }}">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->
