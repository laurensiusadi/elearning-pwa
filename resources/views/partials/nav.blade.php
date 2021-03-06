<nav role="navigation">
    <div class="nav-wrapper">
        @if (!Auth::check())
        <a id="logo-container" href="{{ url('/') }}" class="brand-logo center">Aksara</a>
        @else
        <a id="logo-container" href="{{ url('home') }}" class="brand-logo center">Aksara</a>
        @endif
        <ul class="right hide-on-med-and-down">
            @if (!Auth::check())
                <li><a href="{{ url('login') }}">Log in</a></li>
                <li><a class="btn-flat white waves-effect" style="color:#252E36; text-transform: none" href="{{ url('register') }}">Sign up</a></li>
            @else
                <li><a href="{{ url('home') }}">Home</a></li>
                <li><a class="dropdown-button" href="#!" data-activates="dropdown-user">Welcome, {{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i></a></li>
            @endif
        </ul>
        @if(Auth::check() AND Auth::user()->hasRole('admin'))
        <ul id="nav-mobile" class="side-nav fixed">
        @else
        <ul id="nav-mobile" class="side-nav">
        @endif
            @if (!Auth::check())
                <li><a href="{{ url('login') }}">Please log in</a></li>
            @else
                <li><a href="{{ url('home') }}">Home</a></li>
                <!-- <li><a href="{{ url('user') }}">Welcome, {{ Auth::user()->name }}</a></li> -->
                <li><a href="{{ url('logout') }}">Logout</a></li>
                <li><div class="divider"></div></li>
                @if(Auth::user()->hasRole('dosen'))
                <!-- <li><a href="{{ url('classroom') }}"><i class="material-icons left">assignment</i>Classroom</a></li> -->
                <li><a href="{{ url('question') }}"><i class="material-icons">question_answer</i>Bank Soal</a></li>
                @foreach(Auth::user()->classrooms() as $classroom)
                <li><a href=""><i class="material-icons">assignment</i>{{$classroom->nama}}</a></li>
                @endforeach
                @endif
            @endif
        </ul>
        @if(Auth::check() AND Auth::user()->hasRole('admin'))
        <a href="#" data-activates="nav-mobile" class="button-collapse show-on-medium hide-on-med-and-up"><i class="material-icons left">menu</i></a>
        @else
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons left">menu</i></a>
        @endif
        <ul class="hide-on-med-and-down">
            <li>@yield('title')</li>
        </ul>
    </div>
</nav>
<ul id="dropdown-user" class="dropdown-content" style="top:48px;">
    <li><a href="{{ url('logout') }}">Logout</a></li>
</ul>
