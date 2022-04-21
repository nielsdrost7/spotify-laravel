@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">Tracks</div>

    <div class="card-body">
        <table
            class="
                table
                table-responsive-sm
                table-bordered
                table-striped
                table-hover
            "
            id="tracks_table"
        >
            <thead>
                <tr>
                    <th width="10"></th>
                    <th>Artist Name</th>
                    <th>Track Name</th>
                    <th>Spotify ID</th>
                    <th>Spotify Uri</th>
                    <th>API url</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
@push('scripts')
@parent
<script>
    $(function () {
      let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
      let deleteButtonTrans = 'Mass Delete';
      let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('api.tracks.multiDelete') }}",
        className: 'btn-danger',
        action: function (e, dt, node, config) {

          var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
              return entry.track_id
          });

          var spotifyUris = $.map(dt.rows({ selected: true }).data(), function (entry) {
              return entry.spotify_uri
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
              spotifyUris: spotifyUris,
              _method: 'POST'
            }
          })
          .done(function () { location.reload( null, false ) })

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
        ajax: "{{ route('api.tracks.dataTable') }}",
        columns: [
          { data: 'placeholder', name: 'placeholder', orderable: false, searchable: false,},
          { data: 'artist_name', name: 'artist_name', orderable: false, searchable: false,},
          { data: 'track_name', name: 'track_name', orderable: false, searchable: false,},
          { data: 'spotify_id', name: 'spotify_id', orderable: false, searchable: false,},
          { data: 'spotify_uri', name: 'spotify_uri', orderable: false, searchable: false,},
          { data: 'api_url', name: 'api_url', orderable: false, searchable: false,},
        ],
        pageLength: 25,
      };
      let table = $('#tracks_table').DataTable(dtOverrideGlobals);

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
