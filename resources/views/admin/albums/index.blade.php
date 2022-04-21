@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">Albums</div>

    <div class="card-body">
        <table
            class="
                table
                table-responsive-sm
                table-bordered
                table-striped
                table-hover
            "
            id="albums_table"
        >
            <thead>
                <tr>
                    {{-- <th width="10"></th> --}}
                    <th>Id</th>
                    <th>Name</th>
                    <th>Spotify ID</th>
                    <th>Spotify Uri</th>
                    <th>API url</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
@push('scripts') @parent
<script>
    $(function () {
      let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
      let deleteButtonTrans = 'Mass Delete';
      let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('api.albums.multiDelete') }}",
        className: 'btn-danger',
        action: function (e, dt, node, config) {
          var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
              return entry.id
          });
          var spotifyIds = $.map(dt.rows({ selected: true }).data(), function (entry) {
              return entry.spotify_id
          });

          if (ids.length === 0) {
            alert('{{ trans('global.datatables.zero_selected') }}')

            return
          }


          $.ajax({
            headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            method: 'POST',
            url: config.url,
            data: {
              ids: ids,
              spotifyIds: spotifyIds,
              _method: 'POST'
            }})
            //.done(function () { location.reload() })

        }
      }
      dtButtons.push(deleteButton)
      let dtOverrideGlobals = {
        buttons: dtButtons,
        processing: true,
        serverSide: true,
        retrieve: true,
        bStateSave: true,
        fnStateSave: function (oSettings, oData) {
            localStorage.setItem( 'DataTables', JSON.stringify(oData) );
        },
        fnStateLoad: function (oSettings) {
            return JSON.parse( localStorage.getItem('DataTables') );
        },
        aaSorting: [],
        ajax: "{{ route('api.albums.dataTable') }}",
        columns: [
          { data: 'placeholder', name: 'placeholder', orderable: false, searchable: false,},
          { data: 'name', name: 'name' },
          { data: 'spotify_id', name: 'spotify_id' },
          { data: 'spotify_uri', name: 'spotify_uri' },
          { data: 'api_url', name: 'api_url' },
        ],
        pageLength: 25,
      };
      let table = $('#albums_table').DataTable(dtOverrideGlobals);

      $('#tracks_table tbody').on('click', 'tr td:not(:nth-child(1))', function () {
        table.row(this.closest('tr')).select();
      });

      $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
          $($.fn.dataTable.tables(true)).DataTable()
              .columns.adjust();
      });

    });
</script>
@endpush
