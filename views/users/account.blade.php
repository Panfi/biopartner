@extends('biopartnering::layouts.dashboard_layout')

@section('content')

@php
    $user_details = (Auth::user()->details->count()) ? array_pluck(Auth::user()->details, 'detail_value', 'detail_key') : [];
    $first_name = isset($user_details['first_name']) ? $user_details['first_name'] : '';
    $last_name = isset($user_details['last_name']) ? $user_details['last_name'] : '';
    $gender = isset($user_details['gender']) ? $user_details['gender'] : 'Male';
    $department = isset($user_details['department']) ? $user_details['department'] : '';
    $job_title = isset($user_details['job_title']) ? $user_details['job_title'] : '';
    $job_description = isset($user_details['job_description']) ? $user_details['job_description'] : '';
    $address = isset($user_details['address']) ? $user_details['address'] : '';
    $twitter_handle = isset($user_details['twitter_handle']) ? $user_details['twitter_handle'] : '';
    $facebook_handle = isset($user_details['facebook_handle']) ? $user_details['facebook_handle'] : '';
    $linkedin_handle = isset($user_details['linkedin_handle']) ? $user_details['linkedin_handle'] : '';
    $google_plus_handle = isset($user_details['google_plus_handle']) ? $user_details['google_plus_handle'] : '';
@endphp

{!! Form::open(['id' => 'account-form']) !!}
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body card-block">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="first_name" class="form-control-label">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="form-control" value="{!! $first_name !!}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="last_name" class="form-control-label">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="form-control" value="{!! $last_name !!}">
                        </div>
                    </div>
                </div>

                <div class="form-check-inline form-check mb-4">
                    <label class="form-check-label mr-5">Gender</label>
                    <label class="form-check-label ">
                        <input type="radio" id="gender" name="gender" value="Male" class="form-check-input" {!! ($gender == 'Male') ? 'checked' : '' !!}>Male
                    </label>
                    <label class="form-check-label pl-5">
                        <input type="radio" id="gender" name="gender" value="Female" class="form-check-input" {!! ($gender == 'Female') ? 'checked' : '' !!}>Female
                    </label>
                </div>

                <div class="form-group">
                    <label for="department" class="form-control-label">Department</label>
                    <input type="text" id="department" name="department" class="form-control" value="{!! $department !!}">
                </div>

                <div class="form-group">
                    <label for="job_title" class="form-control-label">Job Title</label>
                    <input type="text" id="job_title" name="job_title" class="form-control" value="{!! $job_title !!}">
                </div>

                <div class="form-group">
                    <label for="job_description" class="form-control-label">Job Description</label>
                    <textarea id="job_description" name="job_description" class="form-control">{!! $job_description !!}</textarea>
                </div>

                <div class="form-group">
                    <label for="address" class="form-control-label">Address</label>
                    <textarea id="address" name="address" class="form-control" rows="4">{!! $address !!}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-4 offset-lg-4">
                        <button type="button" class="btn btn-outline-secondary btn-block" onclick="save_account_details()">
                            <i class="fa fa-check"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                Avatar
            </div>
            <div class="card-body card-block">
                <input type="file">
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-secondary text-white">
                Social Media
            </div>
            <div class="card-body card-block">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <spam class="btn btn-primary">
                                <i class="fa fa-twitter"></i>
                            </spam>
                        </div>
                        <input type="text" id="twitter_handle" name="twitter_handle" class="form-control" placeholder="Twitter" value="{!! $twitter_handle !!}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <spam class="btn btn-primary">
                                <i class="fa fa-facebook-square"></i>
                            </spam>
                        </div>
                        <input type="text" id="facebook_handle" name="facebook_handle" class="form-control" placeholder="Facebook" value="{!! $facebook_handle !!}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <spam class="btn btn-primary">
                                <i class="fa fa-linkedin"></i>
                            </spam>
                        </div>
                        <input type="text" id="linkedin_handle" name="linkedin_handle" class="form-control" placeholder="Linkedin" value="{!! $linkedin_handle !!}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <spam class="btn btn-primary">
                                <i class="fa fa-google-plus-square"></i>
                            </spam>
                        </div>
                        <input type="text" id="google_plus_handle" name="google_plus_handle" class="form-control" placeholder="Google plus" value="{!! $google_plus_handle !!}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

@endsection

@push('scripts')
    {!! Html::script(url('vendor/biopartnering/js/user.js')) !!}

    <script type="text/javascript">
        $("form#account-form").validate({
            onkeyup: false,
            rules: {
                first_name: { required: true},
                last_name: { required: true},
                department: { required: true},
                job_title: { required: true},
                job_description: { required: true},
            },
            tooltip_options: {
                first_name: { placement: 'top' },
                last_name: { placement: 'top' },
                department: { placement: 'top' },
                job_title: { placement: 'top' },
                job_description: { placement: 'top' },
            }
        });
    </script>
@endpush