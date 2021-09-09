@extends('layouts.coreui') @section('content')
<div class="container-fluid">
    @include('flash::message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>
                    Playlists
                    <a class="pull-right" href="#"
                        ><i class="fa fa-plus-square fa-lg"></i
                    ></a>
                </div>
                <div class="card-body">&nbsp;</div>
            </div>
        </div>
    </div>
</div>
@endsection
