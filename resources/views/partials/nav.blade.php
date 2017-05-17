<nav style="background-color:#0072ff" role="navigation">
    <div class="nav-wrapper">
        <a id="logo-container" href="{{ url('/') }}" class="brand-logo center">codekita</a>
        <ul class="right hide-on-med-and-down">
            @if (!Auth::check())
                <li><a href="{{ url('login') }}">Please log in</a></li>
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
                <li><a href="{{ url('user') }}">Welcome, {{ Auth::user()->name }}</a></li>
                <li><a href="{{ url('logout') }}">Logout</a></li>
                @if(Auth::user()->hasRole('dosen'))
                <li><div class="divider"></div></li>
                @endif
                @if(Auth::user()->hasRole('admin'))
                <li><div class="divider"></div></li>
                <li><a href="{{ url('post') }}"><i class="material-icons left">notifications_none</i>Pengumuman</a></li>
                <li><a href="{{ url('user') }}"><i class="material-icons left">account_circle</i>Pengguna</a></li>
                <li><a href="{{ url('role') }}"><i class="material-icons left">supervisor_account</i>Role</a></li>
                <li><a href="{{ url('permission') }}"><i class="material-icons left">visibility_off</i>Permission</a></li>
                <li><a href="{{ url('period') }}"><i class="material-icons left">today</i>Periode Perkuliahan</a></li>
                <li><a href="{{ url('subject') }}"><i class="material-icons left">class</i>Mata Kuliah</a></li>
                <li><a href="{{ url('convention') }}"><i class="material-icons left">library_books</i>Code Convention</a></li>
                <li><a href="{{ url('classroom') }}"><i class="material-icons left">assignment</i>Classroom</a></li>
                @endif
            @endif
        </ul>
        @if(Auth::check() AND Auth::user()->hasRole('admin'))
        <a href="#" data-activates="nav-mobile" class="button-collapse show-on-medium hide-on-med-and-up"><i class="material-icons left">menu</i></a>
        @else
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons left">menu</i></a>
        @endif
    </div>
</nav>
<ul id="dropdown-user" class="dropdown-content" style="top:48px;">
    <li><a href="{{ url('logout') }}">Logout</a></li>
</ul>
