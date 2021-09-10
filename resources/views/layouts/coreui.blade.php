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
        <link
            rel="icon"
            type="image/png"
            href="/img/favicon-32x32.png"
            sizes="32x32"
        />
        <link
            rel="icon"
            type="image/png"
            href="/img/favicon-16x16.png"
            sizes="16x16"
        />

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
        <link
            href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"
            rel="stylesheet"
        />
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
                @yield('content') @include('profile.userprofile')
            </main>
        </div>
        @include('partials.footer')

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
        <script
            src="{{ mix('/js/custom.js') }}"
            type="text/javascript"
        ></script>
        <script>
            let loggedInUserId = "{{ getLoggedInUserId() }}";
            let usersUrl = "{{ url('users') }}/";
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
        <script src="{{ mix('/js/profile/userprofile.js') }}"></script>
        @stack('scripts')
    </body>
</html>
