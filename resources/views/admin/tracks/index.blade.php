@extends('layouts.coreui')
@section('content')
<div class="container-fluid">
    @include('flash::message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>
                    Tracks
                </div>
                <div class="card-body">
                    <table
                        class="
                            table
                            table-responsive-sm
                            table-striped
                            table-bordered
                        "
                        id="tracks_table"
                    >
                        <thead>
                            <th>Name</th>
                            <th>Href</th>
                            <th>Action</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $("#tracks_table").DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "asc"]],
        ajax: "{{ route('tracks.dataTable') }}",
        columnDefs: [
            {
                targets: [2],
                orderable: false,
                className: "text-center",
                width: "5%",
            },
        ],
        dom: 'lrtip<"actions">',
        lengthMenu: [
            [ 10, 25, 50, 100, -1 ],
            [ '10', '25', '50', '100', 'Show all' ]
        ],
        columns: [
            { data: "name", name: "name" },
            { data: "href", name: "href" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });
</script>
@endpush
