@extends('layouts.template')

@section('content')
<div class="container">
<div class="section">
    <form class="form-small" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
        <h4>Login</h4>
        <div class="row" style="padding-top:25px">
            <div class="input-field col s12">
                <input placeholder="Your Email Address" id="email" name="email" type="email" class="validate" value="{{ old('email') }}" required>
                <label class="active" for="email">Email</label>
            </div>
            <div class="input-field col s12" required >
                <input placeholder="Input password" name="password" type="password" class="validate">
                <label class="active" for="password">Password</label>
            </div>
            <div class="input-field col s12" style="padding-top:40px">
                <button class="col s12 btn gradient-2 waves-effect waves-light" type="submit" name="action">Login</button>
            </div>
            <div class="input-field col s12">
                <a href="{{ url('/register') }}" class="col s12 center">Or create new account here</a>
            </div>
        </div>
    </form>
</div>
</div>
@endsection
