<!DOCTYPE html>
<html lang="id">

<head>
    <title>@yield('title') | Shop</title>
    @include('frontend.partials.head')
    @yield('css')

</head>

<body>

    <!-- Navbar -->
    @include('frontend.partials.navbar')

    {{-- content --}}
    @yield('content')

    {{-- footer --}}
    @include('frontend.partials.footer')

    {{-- script --}}
   @include('frontend.partials.script')


   @yield('js')


</body>

</html>
