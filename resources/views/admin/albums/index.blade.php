@extends('layouts.coreui')
@push('stylesheets')
<link
    type="text/css"
    href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css"
    rel="stylesheet"
/>
<link
    type="text/css"
    href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css"
    rel="stylesheet"
/>

@endpush @section('content')
<div class="container-fluid">

        @include('flash::message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                        Albums
                    </div>
                    <div class="card-body">
                        <table
                            class="
                                table
                                table-responsive-sm
                                table-striped
                                table-bordered
                            "
                            id="albums-table"
                        >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>PlayCount</th>
                                    <th>Website</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <div class="mr-3 pull-right"></div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection @push('scripts')
<script
    type="text/javascript"
    src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"
></script>
<script
    type="text/javascript"
    src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"
></script>

<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        var table = $("#albums-table").DataTable({
           processing: true,
           serverSide: true,
           ajax: "{{ route('albums.dataTable') }}",
           columns: [
               { data: "name", name: "name" },
               { data: "playcount", name: "playcount" },
               { data: "uri", name: "uri" },
               {
                   data: "action",
                   name: "action",
                   orderable: false,
                   searchable: false
               }
           ]
        });
    });
</script>
@endpush
