<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" style="text-decoration: unset;" href="{{ route('home') }}">
            <span class="align-middle">{{ env('APP_NAME') }}</span>
        </a>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Components
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('home') }}">
                    <i class="fas fa-chart-area"> </i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#rabbits" data-bs-toggle="collapse"
                   class="sidebar-link show collapsed" aria-expanded="false"
                >
                    <i class="fas fa-database"></i><span class="align-middle">Inventory</span>
                </a>
                <ul id="rabbits" class="sidebar-dropdown list-unstyled collapse"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('rabbits') }}">
                            Rabbits
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('breeding') }}">
                            Breeding
                        </a>
                    </li>
                </ul>
            </li>
            @can('options')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('options') }}">
                        <i class="fas fa-cogs"> </i> <span class="align-middle">Options</span>
                    </a>
                </li>
            @endcan
            @can('manage-users')
                <li class="sidebar-item">
                    <a href="#manage-users" data-bs-toggle="collapse"
                       class="sidebar-link show collapsed" aria-expanded="false"
                    >
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">Manage Users</span>
                    </a>
                    <ul id="manage-users" class="sidebar-dropdown list-unstyled collapse"
                        data-bs-parent="#sidebar">
                        @can('roles')
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('roles') }}">Roles</a></li>
                        @endcan
                        @can('users')
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('users') }}">Users</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>

    </div>
</nav>
