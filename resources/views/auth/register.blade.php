@extends('layouts.template')

@section('content')
<div class="container">
<div class="section">
    <form class="form-small" role="form" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <h4>Register</h4>
        <div class="row" style="padding-top:25px">
        <div class="input-field col s12">
            <input placeholder="Your Full Name" id="name" type="text" class="validate" name="name" value="{{ old('name') }}" required autofocus>
            <label for="name">Name</label>
        </div>

        <div class="input-field col s12">
            <input placeholder="Your Email Address" id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required autofocus>
            <label for="email">Email</label>
        </div>

        <div class="input-field col s12">
            <input placeholder="Keep it secret" id="password" type="password" class="validate" name="password" required>
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
