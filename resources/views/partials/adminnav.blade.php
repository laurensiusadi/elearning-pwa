<nav role="navigation">
<div class="nav-wrapper">
    <a id="logo-container" href="{{ url('/') }}" class="brand-logo center show-on-medium hide-on-med-and-up">codekita</a>
    <ul id="nav-mobile" class="side-nav fixed">
        <li><a href="{{ url('/') }}">codekita</a></li>
        <li><a href="{{ url('home') }}">Home</a></li>
        <li><a href="{{ url('user') }}">Welcome, {{ Auth::user()->name }}</a></li>
        <li><a href="{{ url('logout') }}">Logout</a></li>
        <li><div class="divider"></div></li>
        <li><a href="{{ url('post') }}"><i class="material-icons left">notifications_none</i>Pengumuman</a></li>
        <li><a href="{{ url('classroom') }}"><i class="material-icons left">assignment</i>Kelas</a></li>
        <li><a href="{{ url('user') }}"><i class="material-icons left">account_circle</i>Pengguna</a></li>
        <li><a href="{{ url('period') }}"><i class="material-icons left">today</i>Periode Perkuliahan</a></li>
        <li><a href="{{ url('subject') }}"><i class="material-icons left">class</i>Mata Kuliah</a></li>
        <li><a href="{{ url('role') }}"><i class="material-icons left">supervisor_account</i>Role</a></li>
        <li><a href="{{ url('permission') }}"><i class="material-icons left">visibility_off</i>Permission</a></li>
        <li><a href="{{ url('convention') }}"><i class="material-icons left">library_books</i>Code Convention</a></li>
    </ul>
    <a href="#" data-activates="nav-mobile" class="button-collapse show-on-medium hide-on-med-and-up"><i class="material-icons left">menu</i></a>
</div>
</nav>
