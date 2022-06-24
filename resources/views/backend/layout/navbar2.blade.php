<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    
    <ul class="navbar-nav ml-auto flex-column">
        <li class="nav-item">
            <span class="auth-font">{{ Auth::user()->first_name }}</span>
        </li>
        <li class="nav-item">
            <span class="auth-font">Team admin</span>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Administrator Dropdown Menu -->
        <li class="nav-item signout-item">
            <span class="auth-font">Logout</span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('logout') }}" role="button">
                <img class="signout-img" src="{{ asset('/images/sign-out-alt.svg') }}" alt="">
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->