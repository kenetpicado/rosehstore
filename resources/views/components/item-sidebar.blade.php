@props(['route', 'icon', 'title'])

<li class="nav-item {{ request()->routeIs($route) ? 'active' : '' }}">
    <a class="nav-link" href="{{ route($route) }}">
        <i class="fas fa-fw fa-{{ $icon }}"></i>
        <span>{{ $title }}</span>
    </a>
</li>