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
            {!! Form::open(['url' => url('login'), 'novalidate', 'id' => 'login-form']) !!}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                {!! Form::label('email', 'E-Mail Address') !!}
                {!! Form::text('email', old('email'), ['class' => 'au-input au-input--full', 'placeholder' => 'Your email address']) !!}

                @if($errors->has('email'))
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
            <div class="login-checkbox">
                <label>
                    {!! Form::checkbox('remember', 1, false, ['id' => 'remember', 'class' => 'checkbox']) !!} Remember Me
                </label>
                <label>
                    {!! Html::tag('a', 'Forgot password?', ['href' => url('/password/reset')]) !!}
                </label>
            </div>
            
            {!! Form::submit('Sign In', ['class' => 'au-btn au-btn--block au-btn--green m-b-20']) !!}
            {{-- <div class="social-login-content">
                <div class="social-button">
                    <button class="au-btn au-btn--block au-btn--blue m-b-20">sign in with facebook</button>
                    <button class="au-btn au-btn--block au-btn--blue2">sign in with twitter</button>
                </div>
            </div> --}}
            {!! Form::close() !!}

            <div class="register-link">
                <p>
                    {!! "Don't you have account?" !!}
                    {!! Html::tag('a', 'Sign Up Here', ['href' => url('register')]) !!}
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
