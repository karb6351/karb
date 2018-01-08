<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('inc.header.header')
<!-- Styles -->
<link href="{{ asset('css/backend.css') }}" rel="stylesheet">
@yield('css')

<body>
    <div id="app">
        @include('inc.nav.nav')
        <div class="columns m-top-10">
            <div class="column is-2 manage-left-panel">
                @include('inc.nav.sidebar_manage')
            </div>

            <div class="column is-9 manage-right-panel">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('js/backend.js') }}"></script>
    @include('inc.nav.js.nav_js')

    @yield('js')
</body>

</html>
