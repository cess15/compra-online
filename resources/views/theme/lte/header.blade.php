<nav class="main-header navbar navbar-expand navbar-dark navbar-green">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Account Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="{{ asset('/foto/user_logo.png') }}"
                    alt="avatar" class="img-circle elevation-2 img_profile" width="30px" height="30px">
                <span class="float-right mb-1 text-light text-sm">
                    {{$full_name}}
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                {{-- <a href="{{ route('perfil') }}" class="dropdown-item"> --}}
                    <i class="fa fa-user mr-2"></i> Perfil
                {{-- </a> --}}
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i><span class="text text-danger"> Cerrar sesión</span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            </div>
        </li>
    </ul>
</nav>
