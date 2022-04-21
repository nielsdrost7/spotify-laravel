<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
        />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Spoti</title>
        <link
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            rel="stylesheet"
        />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
            rel="stylesheet"
        />
        <link
            href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
            rel="stylesheet"
        />
        <link
            href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"
            rel="stylesheet"
        />
        <link
            href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"
            rel="stylesheet"
        />
        <link
            href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css"
            rel="stylesheet"
        />
        <link
            href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css"
            rel="stylesheet"
        />
        <link
            href="https://unpkg.com/@coreui/coreui@2.1.16/dist/css/coreui.min.css"
            rel="stylesheet"
        />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
            rel="stylesheet"
        />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css"
            rel="stylesheet"
        />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
            rel="stylesheet"
        />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css"
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
                <div class="container-fluid" style="padding-top: 20px">
                    @yield('content')
                </div>
            </main>
        </div>
        @include('partials.footer')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://unpkg.com/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
        <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

        <script>
            $(function() {
            	let selectAllButtonTrans = '{{ trans('global.select_all') }}'
            	let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

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
            		targets: 0,
            		orderable: false,
                    'checkboxes': {
                        'selectRow': true
                    },
            		className: 'select-checkbox'
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
            	//scrollX: true,
            	pageLength: 100,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    ["10", "25", "50", "100", "Show all"],
                ],
            	dom: 'lBtrip<"actions">',
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
