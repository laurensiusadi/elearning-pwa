@extends('layouts.template')

@section('content')
<div class="container">
<div class="section">
    <form class="form-small" role="form" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <h4>Register</h4>
        <div class="row" style="padding-top:25px">
        <div class="input-field col s12 {{ $errors->has('name') ? ' has-error' : '' }}">
            <input placeholder="Your Full Name" id="name" type="text" class="validate" name="name" value="{{ old('name') }}" required autofocus>
            @if ($errors->has('name'))
                <span class="chip red lighten-1 white-text">
                    {{ $errors->first('name') }}
                    <i class="close material-icons">close</i>
                </span>
            @endif
            <label for="name">Name</label>
        </div>

        <div class="input-field col s12 {{ $errors->has('email') ? ' has-error' : '' }}">
            <input placeholder="Your Email Address" id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="chip red lighten-1 white-text">
                    {{ $errors->first('email') }}
                    <i class="close material-icons">close</i>
                </span>
            @endif
            <label for="email">Email</label>
        </div>

        <div class="input-field col s12{{ $errors->has('password') ? ' has-error' : '' }}">
            <input placeholder="Keep it secret" id="password" type="password" class="validate" name="password" required>
            @if ($errors->has('password'))
                <span class="chip red lighten-1 white-text">
                    {{ $errors->first('password') }}
                    <i class="close material-icons">close</i>
                </span>
            @endif
            <label for="password">Password</label>
        </div>
        <div class="input-field col s12">
            <input placeholder="Re-type your password" id="password-confirm" type="password" class="validate" name="password_confirmation" required>
            <label for="password-confirm">Confirm Password</label>
        </div>
        <div class="input-field col s12">
            <button class="col s12 btn gradient-2 waves-effect waves-light" type="submit" name="action">Create account</button>
        </div>
        <div class="input-field col s12">
            <a href="{{ url('/login') }}" class="col s12 center">Already have an account? Sign in</a>
        </div>
        </div>
    </form>
</div>
</div>
@endsection
