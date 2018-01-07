<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('inc.header.header')
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@yield('css')

<body>
    <div id="app">

        @include('inc.nav.nav')
        @yield('content')

    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @include('inc.nav.js.nav_js')
    @yield('js')
</body>

</html>
