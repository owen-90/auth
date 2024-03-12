<div class="nk-sidebar-menux">
    <ul class="nk-menu">
        @can('manage_users')
            <li class="nk-menu-heading">
                <h6 class="overline-title">User & Roles Management</h6>
            </li>
        @endcan
        <li class="nk-menu-item has-sub">
            @can('manage_users')
                <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle" data-original-title title>
                <span class="nk-menu-icon">
                    <em class="icon ni ni-files"></em>
                </span>
                    <span class="nk-menu-text">User Management</span>
                </a>
            @endcan
            <ul class="nk-menu-sub">
                @can('manage_users')
                    <li class="nk-menu-item">
                        <a href="{{ route('users.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-user-list"></em></span>
                            <span class="nk-menu-text">Users</span>
                        </a>
                    </li>
                @endcan
                @can('manage_role')
                    <li class="nk-menu-item">
                        <a href="{{ route('roles.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-user-c"></em></span>
                            <span class="nk-menu-text">Roles</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('permissions.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-alert"></em></span>
                            <span class="nk-menu-text">Permissions</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    </ul>
</div>
