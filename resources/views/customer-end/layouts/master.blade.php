<!DOCTYPE html>
<html lang="en">
    <head>
         @yield('head')
    </head>
    <body>
    @include('customer-end.includes.header')
    @yield('content')
    @include('customer-end.includes.footer')
    @include('sweetalert::alert')
    </body>

</html>
