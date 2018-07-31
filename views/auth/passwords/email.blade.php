@extends('biopartnering::layouts.public_layout')

@section('content')

<div class="login-wrap">
    <div class="login-content">
        <div class="login-logo">
            <a href="{!! url('/') !!}">
                <img src="{!! asset('vendor/biopartnering/img/logo.png') !!}" alt="CoolAdmin">
            </a>
        </div>
        <p class="text-info mb-3">
            {!! "Give us your email and we'll send you a recovery link." !!}
        </p>
        
        <div class="login-form">
            {!! Form::open(['url' => url('/password/email'), 'novalidate', 'id' => 'reset-form']) !!}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                {!! Form::label('email', 'E-Mail Address') !!}
                {!! Form::text('email', old('email'), ['class' => 'au-input au-input--full', 'placeholder' => 'Your email address']) !!}

                @if ($errors->has('email'))
                    <span class="help-block">
                        {!! $errors->first('email') !!}
                    </span>
                @endif
            </div>
            
            {!! Form::submit('Send Password Reset Link', ['class' => 'au-btn au-btn--block au-btn--green m-b-20']) !!}

            {!! Form::close() !!}

            <div class="register-link">
                <p>
                    {!! "Remember your password?" !!}
                    {!! Html::tag('a', 'Sign In Here', ['href' => url('login')]) !!}
                </p>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

    @if(Session::has('status'))

        <script type="text/javascript">
            notify('success', '{!! Session::get('status') !!}');
        </script>

    @endif

    <script type="text/javascript">
        $("form#reset-form").validate({
            onkeyup: false,
            rules: {
                email: { required: true, email: true }
            },
            tooltip_options: {
                email: { placement: 'right' }
            }
        });
    </script>
@endpush