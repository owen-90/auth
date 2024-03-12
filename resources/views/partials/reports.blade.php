<div class="nk-sidebar-menux mt-4">
    <ul class="nk-menu">
        <li class="nk-menu-heading">
            <h6 class="overline-title">REPORTS</h6>
        </li>

        <li class="nk-menu-item has-sub">
            @can('manage_users')
                <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle" data-original-title title>
                <span class="nk-menu-icon">
                    <em class="icon ni ni-files"></em>
                </span>
                    <span class="nk-menu-text">Billing Reports</span>
                </a>
            @endcan
            <ul class="nk-menu-sub">
                <li class="nk-menu-item">
                    <a href="{{ route('reports.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon">
                            <em class="icon ni ni-reload"></em>
                        </span>
                        <span class="nk-menu-text">Transactions</span>
                    </a>
                </li>
                <li class="nk-menu-item">
                    <a href="javascript:void(0)" class="nk-menu-link">
                        <span class="nk-menu-icon">
                            <em class="icon ni ni-mobile"></em>
                        </span>
                        <span class="nk-menu-text">Airtime</span>
                    </a>
                </li>
                <li class="nk-menu-item">
                    <a href="javascript:void(0)" class="nk-menu-link">
                        <span class="nk-menu-icon">
                            <em class="icon ni ni-swap-alt"></em>
                        </span>
                        <span class="nk-menu-text">Utility Bills</span>
                    </a>
                </li>
                <li class="nk-menu-item">
                    <a href="javascript:void(0)" class="nk-menu-link">
                        <span class="nk-menu-icon">
                            <em class="icon ni ni-monitor"></em>
                        </span>
                        <span class="nk-menu-text">Pay TV</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
