@extends('layouts.app') @section('content')
<div class="container-fluid">
    @include('flash::message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Now Playing</div>
                <div class="card-body">
                    <div>

                        @if(!$nowPlaying)
                        @else
                            @dd($nowPlaying)
                        @endif
                        <h1
                            class="
                                font-medium
                                text-dimmed text-sm
                                uppercase
                                tracking-wide
                            "
                        >
                            Currently Playing
                        </h1>
                        <div class="flex items-center justify-center">
                            <img
                                class="w-32 h-32 rounded"
                                src="#"
                                alt="Album Pic"
                            />
                        </div>
                        <div
                            class="
                                self-center
                                font-bold
                                text-xl
                                tracking-wide
                                leading-none
                            "
                        >
                            {{ $nowPlaying['trackName'] }}
                        </div>
                        <div>
                            <div
                                class="
                                    flex
                                    w-full
                                    justify-center
                                    space-x-4
                                    items-center
                                "
                            >
                                <span class="text-xs text-dimmed">
                                    {{
                                        $nowPlaying['trackArtist']
                                    }}
                                </span>
                                <span class="text-xs text-dimmed">
                                    {{
                                        $nowPlaying['trackHref']
                                    }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
