<!DOCTYPE HTML>
<html lang="en">
@include('admin.layouts.partials.head')
<body>
    
    @isset($auth)

        @yield('content')

    @else

        @include('admin.layouts.partials.nav')
        <div class="container-fluid">
            <div class="row">
                @include('admin.layouts.partials.sidebar')
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>
        
    @endisset
    
    @include('admin.layouts.partials.scripts')
</body>
</html>