@extends('layouts.coreui')
@section('content')
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
                        id="albums_table"
                    >
                        <thead>
                            <th>Name</th>
                            <th>Playcount</th>
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
    $("#albums_table").DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "asc"]],
        ajax: "{{ route('albums.dataTable') }}",
        columnDefs: [
            {
                targets: [2],
                orderable: false,
                className: "text-center",
                width: "5%",
            },
        ],
        columns: [
            { data: "name", name: "name" },
            { data: "playcount", name: "playcount" },
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
