@extends('biopartnering::layouts.dashboard_layout')

@section('content')

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endpush

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                {!! $calendar->calendar() !!}
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    {!! Html::script(url('vendor/biopartnering/js/moment.min.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/fullcalendar.min.js')) !!}
    {!! $calendar->script() !!}
@endpush