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
                @yield('content')
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
		<script>
			$(function() {

              let languages = {
                'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
              };

              $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn-md' })
              $.extend(true, $.fn.dataTable.defaults, {
                responsive: true,
                language: {
                  url: languages['{{ app()->getLocale() }}']
                },
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }, {
                    orderable: false,
                    searchable: false,
                    targets: -1
                }],
                select: {
                  style:    'multi+shift',
                  selector: 'td:first-child'
                },
                order: [],
                scrollX: true,
                pageLength: 100,
                dom: 'lBfrtip<"actions">',
                buttons: [
                  {
                    extend: 'selectAll',
                    className: 'btn-indigo',
                    text: selectAllButtonTrans,
                    exportOptions: {
                      columns: ':visible'
                    },
                    action: function(e, dt) {
                      e.preventDefault()
                      dt.rows().deselect();
                      dt.rows({ search: 'applied' }).select();
                    }
                  },
                  {
                    extend: 'selectNone',
                    className: 'btn-indigo',
                    text: selectNoneButtonTrans,
                    exportOptions: {
                      columns: ':visible'
                    }
                  },
                ]
              });
            });
        </script>
		
		@stack('scripts')
    </body>
</html>
