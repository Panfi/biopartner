@extends('biopartnering::layouts.public_layout')

@section('content')

<div class="login-wrap">
    <div class="login-content">
        <div class="login-logo">
            <a href="{!! url('/') !!}">
                <img src="{!! asset('vendor/biopartnering/img/logo.png') !!}" alt="CoolAdmin">
            </a>
        </div>
        <div class="login-form">
            {!! Form::open(['url' => url('/password/reset'), 'novalidate', 'id' => 'pass-reset-form']) !!}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                {!! Form::label('email', 'E-Mail Address') !!}
                {!! Form::text('email', old('email'), ['class' => 'au-input au-input--full', 'placeholder' => 'Your email address']) !!}

                @if ($errors->has('email'))
                    <span class="help-block">
                        {!! $errors->first('email') !!}
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                {!! Form::label('password') !!}
                {!! Form::password('password', ['class' => 'au-input au-input--full', 'placeholder' => 'Your password']) !!}

                @if ($errors->has('password'))
                    <span class="help-block">
                        {!! $errors->first('password') !!}
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                {!! Form::label('password_confirmation', 'Confirm Password') !!}
                {!! Form::password('password_confirmation', ['class' => 'au-input au-input--full', 'placeholder' => 'Confirm your password']) !!}

                @if ($errors->has('password'))
                    <span class="help-block">
                        {!! $errors->first('password') !!}
                    </span>
                @endif
            </div>
            
            {!! Form::submit('Reset Password', ['class' => 'au-btn au-btn--block au-btn--green m-b-20']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script type="text/javascript">
        $("form#pass-reset-form").validate({
            onkeyup: false,
            rules: {
                email: { required: true, email: true },
                password: { required: true, minlength: 8, pwcheck: true },
                password_confirmation: { equalTo: "#password" },
            },
            messages: {
                password: {
                    pwcheck: "Password must contain at least one lowercase and uppercase character, one digit and symbol."
                }
            },
            tooltip_options: {
                email: { placement: 'right' },
                password: { placement: 'right' },
                password_confirmation: { placement: 'right' },
            }
        });

        $.validator.addMethod("pwcheck", function(value) 
        {
            return /[A-Z]/.test(value) // has a uppercase letter
                && /[a-z]/.test(value) // has a lowercase letter
                && /\d/.test(value) // has a digit
                && /[-@._*!-&~#$%^&*()+=]/.test(value) // has a symbol
        });
    </script>
@endpush