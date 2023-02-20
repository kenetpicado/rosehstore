@props(['route', 'icon', 'title', 'active' => false])

<li class="nav-item {{ $active ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseItem"
        aria-expanded="true" aria-controls="collapseItem">
        <i class="fas fa-fw fa-{{ $icon }}"></i>
        <span>{{ $title }}</span>
    </a>
    <div id="collapseItem" class="collapse {{ $active ? 'show' : '' }}" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            {{ $slot }}
        </div>
    </div>
</li>