<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home')}}" class="brand-link">
        <img src="{{ asset('assets/img/24691611025869019.png') }}" alt="CAFSI Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{-- Administrador --}}
                @if(Auth::user()->role_id==1)
                    <li class="nav-item">
                        <a href="{{ route('home') }}"
                            class="{{ Request::path() === 'home' ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-tag"></i>
                            <p>
                                Ventas
                                <span class="right badge badge-info">{{ $saleProducts?? '0' }}</i>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}"
                            class="{{ Request::path() === 'categories' ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                Categorias
                                <span class="right badge badge-info">{{ $categories?? '0' }}</i>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}"
                            class="{{ Request::path() === 'products' ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                Productos
                                <span class="right badge badge-info">{{ $products?? '0' }}</i>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('buyers.index') }}"
                            class="{{ Request::path() === 'buyers' ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>
                                Compradores
                                <span class="right badge badge-info">{{ $buyers?? '0' }}</i>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sellers.index') }}"
                            class="{{ Request::path() === 'sellers' ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>
                                Vendedores
                                <span class="right badge badge-info">{{ $sellers?? '0' }}</i>
                            </p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role_id == 2)
                    <li class="nav-item">
                        <a href="{{ route('home') }}"
                            class="{{ Request::path() === 'home' ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-tag"></i>
                            <p>
                                Mis Ventas
                                <span class="right badge badge-info">{{ $saleProducts?? '0' }}</i>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}"
                            class="{{ Request::path() === 'products' ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                Productos
                                <span class="right badge badge-info">{{ $products?? '0' }}</i>
                            </p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role_id == 3)
                    <li class="nav-item">
                        <a href="{{ route('home') }}"
                            class="{{ Request::path() === 'home' ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-tag"></i>
                            <p>
                                Mis Compras
                                <span class="right badge badge-info">{{ $saleProducts?? '0' }}</i>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}"
                            class="{{ Request::path() === 'products' ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                Productos en Venta
                                <span class="right badge badge-info">{{ $products?? '0' }}</i>
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
