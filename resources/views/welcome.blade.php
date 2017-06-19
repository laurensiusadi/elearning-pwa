@extends('layouts.template')

@section('content')
<div class="container">
<div class="row">
    <div class="col l8 m6 s12" style="padding:40px 0 30px 20px">
        Aksara
        <h3>Learn code<br/>anywhere anytime.</h3>
        <p class="light">Pemrograman Web<br/>Departemen Teknik Informatika<br/>Institut Teknologi Sepuluh Nopember</p>
    </div>
    <div class="col l4 m6 s12" style="margin-top:28px">
    <form role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
        <h5 class="light center-align">Login and continue coding</h5>
        <div class="card-panel" style="margin-top:25px">
            <div class="input-field">
                <input placeholder="Your Email Address" id="email" name="email" type="email" class="validate" value="{{ old('email') }}" required>
                <label class="active" for="email">Email</label>
            </div>
            <div class="input-field" required >
                <input placeholder="Input password" id="password" name="password" type="password" class="validate">
                <label class="active" for="password">Password</label>
            </div>
            <div class="input-field" style="padding-top:10px">
                <button class="btn gradient-2 waves-effect waves-light" type="submit" name="action" style="width:100%">Login</button>
            </div>
            <div class="input-field center light">
                <a href="{{ url('/register') }}">Or create new account here</a>
            </div>
        </div>
    </form>
    </div>
</div>
</div>
@endsection
