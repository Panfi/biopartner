@extends('biopartnering::layouts.dashboard_layout')

@section('content')

@push('style')
    {!! Html::style(url('vendor/biopartnering/css/bootstrap-datetimepicker.min.css')) !!}
@endpush

@php
$recipients = array_pluck(Msg::recipients(), 'email', 'id');
$room_numbers = [];

for($i = 1; $i <=28; $i++)
{
    $room_numbers[$i] = "Room $i";
}
@endphp

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                New Meeting Request
            </div>
            <div class="card-body">
                {!! Form::open(['url' => url('user/meeting/add'), 'novalidate', 'id' => 'login-form']) !!}
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="recipient" class="form-control-label">Recipient</label>
                        </div>
                        <div class="col-12 col-md-9">
                            {!! Form::select('recipient', $recipients, '', ['class' => 'form-control', 'id' => 'recipient']) !!}
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="room_number" class="form-control-label">Room Number</label>
                        </div>
                        <div class="col-12 col-md-9">
                            {!! Form::select('room_number', $room_numbers, '', ['class' => 'form-control', 'id' => 'room_number']) !!}
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="subject" class=" form-control-label">Subject</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="subject" name="subject" placeholder="Subject" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="start_date" class=" form-control-label">Start Date</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class='input-group date' id='start_date_timepicker'>
                                <input type="text" id="start_date" name="start_date" placeholder="Start Date" class="form-control">
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="end_date" class="form-control-label">End Date</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class='input-group date' id='end_date_timepicker'>
                                <input type="text" id="end_date" name="end_date" placeholder="End Date" class="form-control">
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="body" class=" form-control-label">Body</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea name="body" id="body" rows="9" placeholder="Body" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-4 offset-lg-8">
                                <button type="submit" class="btn btn-outline-secondary btn-block">
                                    <i class="fa fa-check"></i> Send
                                </button>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    {!! Html::script(url('vendor/biopartnering/js/moment.min.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/bootstrap-datetimepicker.js')) !!}

    <script type="text/javascript">        
        $(function () 
        {
            $('#start_date_timepicker').datetimepicker({
                format: 'YYYY-MM-DD hh:mm'
            });

            $('#end_date_timepicker').datetimepicker({
                format: 'YYYY-MM-DD hh:mm'
            });
        });
    </script>
@endpush