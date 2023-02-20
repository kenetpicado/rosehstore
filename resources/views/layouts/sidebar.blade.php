@auth()
    <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
            <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <x-item-sidebar title="Tienda" icon="shopping-cart" route="shop"></x-item-sidebar>

        <x-item-sidebar title="Inventario" icon="tshirt" route="products"></x-item-sidebar>

        <x-item-sidebar title="Ventas" icon="dollar-sign" route="sales"></x-item-sidebar>

        <x-item-sidebar title="Compras" icon="dollar-sign" route="purchases"></x-item-sidebar>

        <x-item-sidebar title="Mobiliario" icon="baby-carriage" route="fornitures"></x-item-sidebar>

        <x-item-sidebar title="Decoraciones" icon="gift" route="decorations"></x-item-sidebar>

        <hr class="sidebar-divider d-none d-md-block">
        <div class="sidebar-heading">Configuracion</div>

        <x-item-sidebar title="Categorias" icon="tasks" route="categories"></x-item-sidebar>

        <x-item-sidebar title="Usuaros" icon="user" route="users"></x-item-sidebar>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
@endauth
