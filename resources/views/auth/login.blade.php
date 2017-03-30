@extends('layouts.template')

@section('content')
<div class="container">
<div class="section">
    <form style="max-width:330px; margin: 0 auto;" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
        <h4>Login</h4>
        <div class="row" style="padding-top:25px">
            <div class="input-field col s12 {{ $errors->has('email') ? 'has-error' : '' }}" >
                <input placeholder="Your Email Address" id="email" name="email" type="email" class="validate" value="{{ old('email') }}">
                <label for="email">Email</label>
            </div>
            <div class="input-field col s12 {{ $errors->has('password') ? ' has-error' : '' }}">
                <input placeholder="Input password" name="password" type="password" class="validate">
                <label for="password">Password</label>
            </div>
            <div class="col s12">
                <input type="checkbox" name="remember" id="remember" />
                <label for="remember">Remember Me</label>
            </div>
            <div class="input-field col s12" style="padding-top:40px">
                <button class="col s12 btn gradient-2 waves-effect waves-light" type="submit" name="action" style="padding-inline-start:45px;">Login
                    <i class="material-icons right">send</i>
                </button>
            </div>
            <div class="input-field col s12">
                <button class="col s12 waves-effect waves-red btn-flat grey lighten-3">Register</button>
            </div>
        </div>
    </form>
</div>
</div>
@endsection
