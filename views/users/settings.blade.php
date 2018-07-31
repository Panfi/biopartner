@php
    $email = Auth::user()->email;
@endphp

@extends('biopartnering::layouts.dashboard_layout')

@section('content')

@push('style')
    {!! Html::style(url('vendor/biopartnering/css/bootstrap-datetimepicker.min.css')) !!}
@endpush

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body card-block">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security" aria-selected="true">Security</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="availability-tab" data-toggle="tab" href="#availability" role="tab" aria-controls="availability" aria-selected="false">Availability</a>
                    </li>
                </ul>
                <div class="tab-content mt-4" id="myTabContent">
                    <div class="tab-pane fade show active" id="security" role="tabpanel" aria-labelledby="security-tab">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header bg-secondary text-white">
                                        Change Password
                                    </div>
                                    <div class="card-body">
                                        {!! Form::open(['id' => 'password-form']) !!}
                                        <div class="form-group">
                                            <label for="old_password" class="form-control-label">Old Password</label>
                                            <input type="password" id="old_password" name="old_password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password" class="form-control-label">New Password</label>
                                            <input type="password" id="new_password" name="new_password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_new_password" class="form-control-label">Confirm New Password</label>
                                            <input type="password" id="confirm_new_password" name="confirm_new_password" class="form-control">
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-lg-4 offset-lg-4">
                                                <button type="button" class="btn btn-outline-secondary btn-block" onclick="change_password()">
                                                    <i class="fa fa-check"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header bg-secondary text-white">
                                        Change Email
                                    </div>
                                    <div class="card-body">
                                        {!! Form::open(['id' => 'email-form']) !!}
                                        <div class="form-group">
                                            <label for="old_email" class="form-control-label">Old Email</label>
                                            <input type="email" id="old_email" name="old_email" class="form-control" value="{!! $email !!}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="new_email" class="form-control-label">New Email</label>
                                            <input type="email" id="new_email" name="new_email" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_new_email" class="form-control-label">Confirm New Email</label>
                                            <input type="email" id="confirm_new_email" name="confirm_new_email" class="form-control">
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-lg-4 offset-lg-4">
                                                <button type="button" class="btn btn-outline-secondary btn-block" onclick="change_email()">
                                                    <i class="fa fa-check"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="availability" role="tabpanel" aria-labelledby="availability-tab">
                        {!! Form::open(['id' => 'availability-form']) !!}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col col-md-2">
                                        <label class="form-control-label"><b>Select Date</b></label>
                                    </div>
                                    <div class="col-12 col-md-10">
                                        <div class='input-group date' id='date_timepicker'>
                                            <input type="text" id="date" name="date" class="form-control">
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                        </div>
                                    </div>               
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-secondary text-white">
                                    Update Availability
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col col-md-3 text-info mt-1">
                                            <span>All Day</span>
                                            <label class="switch switch-3d switch-success mx-2">
                                                <input type="checkbox" class="switch-input" id="duration" onchange="show_hide_availability_flags(this)">
                                                <span class="switch-label"></span>
                                                <span class="switch-handle"></span>
                                            </label>
                                            <span>Specific hours</span>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <div class="row">
                                                <div class="col-md-5" style="display: none" id="availability_flags">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class='input-group date' id='from_timepicker'>
                                                                <input type="text" id="from_time" name="from_time" class="form-control" placeholder="From">
                                                                <span class="input-group-addon">
                                                                    <span class="fa fa-clock"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class='input-group date' id='to_timepicker'>
                                                                <input type="text" id="to_time" name="to_time" class="form-control" placeholder="To">
                                                                <span class="input-group-addon">
                                                                    <span class="fa fa-clock"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mt-1 text-center">
                                                    <span>Not Availability</span>
                                                    <label class="switch switch-3d switch-success mx-2">
                                                        <input type="checkbox" class="switch-input" id="status" onchange="set_status(this)">
                                                        <span class="switch-label"></span>
                                                        <span class="switch-handle"></span>
                                                    </label>
                                                    <span>Availability</span>
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="button" class="btn btn-outline-secondary btn-block" onclick="save_availability_details()">
                                                        <i class="fa fa-check"></i> Update Availability
                                                    </button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                        
                        <div id="availability-grid">
                            <!-- @include('biopartnering::users.availability') -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    {!! Html::script(url('vendor/biopartnering/js/user.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/moment.min.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/bootstrap-datetimepicker.js')) !!}

    <script type="text/javascript">        
        $(function () 
        {
            $('#date_timepicker').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#from_timepicker').datetimepicker({
                //format: 'hh:mmA'
                format: 'hh:mm'
            });
            $('#to_timepicker').datetimepicker({
                //format: 'hh:mmA'
                format: 'hh:mm'
            });
        });

        $("form#password-form").validate({
            onkeyup: false,
            rules: {
                old_password: { required: true, minlength: 8, pwcheck: true },
                new_password: { required: true, minlength: 8, pwcheck: true },
                confirm_new_password: { equalTo: "#new_password" },
            },
            messages: {
                old_password: {
                    pwcheck: "Password must contain at least one lowercase and uppercase character, one digit and symbol."
                },
                new_password: {
                    pwcheck: "Password must contain at least one lowercase and uppercase character, one digit and symbol."
                }
            },
            tooltip_options: {
                old_password: { placement: 'right' },
                new_password: { placement: 'right' },
                confirm_new_password: { placement: 'right' },
            }
        });

        $.validator.addMethod("pwcheck", function(value) 
        {
            return /[A-Z]/.test(value) // has a uppercase letter
                && /[a-z]/.test(value) // has a lowercase letter
                && /\d/.test(value) // has a digit
                && /[-@._*!-&~#$%^&*()+=]/.test(value) // has a symbol
        });

        $("form#email-form").validate({
            onkeyup: false,
            rules: {
                old_email: { required: true, email: true },
                new_email: { required: true, email: true },
                confirm_new_email: { equalTo: "#new_email" },
            },
            tooltip_options: {
                old_email: { placement: 'left' },
                new_email: { placement: 'left' },
                confirm_new_email: { placement: 'left' },
            }
        });

        $("form#availability-form").validate({
            onkeyup: false,
            rules: {
                date: { required: true },
                //from_time: { required: true },
                //to_time: { required: true },
            },
            tooltip_options: {
                date: { placement: 'top' },
                //from_time: { placement: 'top' },
                //to_time: { placement: 'top' },
            }
        });
    </script>
@endpush