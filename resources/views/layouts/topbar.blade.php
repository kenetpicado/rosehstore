@auth()
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <span class="badge badge-primary">Esta es una version beta!</span>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
            @isset($logs)
                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter">{{ $logs->count() }}</span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Alerts Center
                        </h6>

                        @forelse ($logs as $log)
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-{{ $log->type }}">
                                        @php
                                            echo $log->icon;
                                        @endphp
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">{{ $log->created_at->diffForHumans() }}</div>
                                    {{ $log->message }}
                                </div>
                            </a>
                        @empty
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div>Empty</div>
                            </a>
                        @endforelse
                        <a class="dropdown-item text-center small text-gray-500" href="{{ route('alerts.index') }}">
                            Show All
                       </a>
                    </div>
                </li>
            @endisset

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                    <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Salir
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
@endauth
