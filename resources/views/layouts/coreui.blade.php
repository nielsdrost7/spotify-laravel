<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
        />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Spotify-Laravel</title>
                {{--
                <script
                src="https://code.jquery.com/jquery-3.1.1.min.js"
                --}}
                {{--crossorigin="anonymous"
                ></script>
                --}}
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        @stack('styles')
    </head>
    <body
        class="
            app
            header-fixed
            sidebar-fixed
            aside-menu-fixed
            sidebar-lg-show
            footer-fixed
        "
    >
        @include('partials.header')
        <div class="app-body">
            @include('partials.sidebar')
            <main class="main">
                @yield('content')
            </main>
        </div>
        @include('partials.footer')

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        @stack('scripts')
    </body>
</html>
