@extends('biopartnering::layouts.dashboard_layout')

@section('content')

@php($recipients = array_pluck(Msg::recipients(), 'email', 'id'))

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
                            <input type="date" id="start_date" name="start_date" placeholder="Start Date" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="end_date" class="form-control-label">End Date</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="date" id="end_date" name="end_date" placeholder="End Date" class="form-control">
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

@endpush