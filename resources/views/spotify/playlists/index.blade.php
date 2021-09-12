@extends('layouts.app') @section('content')
<div class="container-fluid">
    @include('flash::message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Playlists</div>
                <div class="card-body">
                    <dl>
                        @foreach($playlists as $key => $playlist)
                        <dt>
                            <a
                                href="{{ route('spotify.playlists.tracks', ['playlistId' => $playlist['id']]) }}"
                                >{{ $playlist["name"] }}</a
                            >
                        </dt>
                        @endforeach
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
