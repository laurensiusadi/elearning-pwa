<nav class="blue" role="navigation">
    <div class="nav-wrapper">
        <a id="logo-container" href="{{ url('/') }}" class="brand-logo center">codekita</a>
        <ul class="right hide-on-med-and-down">
            @if (!Auth::check())
                <li><a href="{{ url('login') }}">Please log in</a></li>
            @else
                <li><a href="{{ url('home') }}">Home</a></li>
                <li><a href="{{ url('user') }}">Welcome, {{ Auth::user()->name }}</a></li>
                <li><a href="{{ url('logout') }}">Logout</a></li>
            @endif
        </ul>
        <ul id="nav-mobile" class="side-nav">
            @if (!Auth::check())
                <li><a href="{{ url('login') }}">Please log in</a></li>
            @else
                <li><a href="{{ url('home') }}">Home</a></li>
                <li><a href="{{ url('user') }}">Welcome, {{ Auth::user()->name }}</a></li>
                <li><a href="{{ url('logout') }}">Logout</a></li>
            @endif
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>
