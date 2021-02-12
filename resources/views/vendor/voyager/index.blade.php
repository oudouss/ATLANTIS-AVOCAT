@extends('voyager::master')

@section('content')
<div class="page-content">
    @include('voyager::alerts')
    @include('voyager::dimmers')
    <!-- add stats to dashboard -->
    <div class="analytics-container">
        <div class="clearfix container-fluid row">
            <div class="col-md-4"> </div>
        </div>
    </div>
</div>
@stop
