@extends('layouts.app') @section('content')
<div class="container-fluid">
    @include('flash::message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Now Playing</div>
                <div class="card-body">
                    <div>
                        @if($isPlaying)
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
                            {{ $trackName }}
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
                                        implode(
                                            ", ",
                                            array_column($artists ?? [], "name")
                                        )
                                    }}
                                </span>
                            </div>
                        </div>
                        @else
                        <div class="flex">
                            <div class="w-full pt-8 bt-0">
                                <div
                                    class="
                                        flex
                                        justify-center
                                        text-2xl text-grey-darkest
                                        font-medium
                                    "
                                >
                                    <h2>Spotify is not currently playing :(</h2>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
