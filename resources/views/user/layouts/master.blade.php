<!DOCTYPE html>
<html lang="en">
@include('user.layouts.partials.head')
<body>
    
    @include('user.layouts.partials.top-bar')


    @include('user.layouts.partials.nav')


    @yield('content')


    @include('user.layouts.partials.footer')


    @include('user.layouts.partials.scripts')
</body>
</html>