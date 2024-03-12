<div class="nk-sidebar-menux mt-4">
    <ul class="nk-menu">
        <li class="nk-menu-heading">
            <h6 class="overline-title">Menu</h6>
        </li>
        <li class="nk-menu-item">
            <a href="{{route('dashboard')}}" class="nk-menu-link">
                <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                <span class="nk-menu-text">Dashboard</span>
            </a>
        </li>

        <li class="nk-menu-item">
            <a href="{{ route('category.index') }}" class="nk-menu-link">
                <span class="nk-menu-icon">
                    <em class="icon ni ni-opt-alt"></em>
                </span>
                <span class="nk-menu-text">Billing Categories</span>
            </a>
        </li>

        <li class="nk-menu-item">
            <a href="{{ route('service.index') }}" class="nk-menu-link">
                <span class="nk-menu-icon">
                    <em class="icon ni ni-link"></em>
                </span>
                <span class="nk-menu-text">Billing Services</span>
            </a>
        </li>

        {{--        @if(auth()->check() && auth()->user()->type === 'super-admin')--}}
        <li class="nk-menu-item">
            <a href="{{ route('transactions.index') }}" class="nk-menu-link">
                <span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span>
                <span class="nk-menu-text">Transactions</span>
            </a>
        </li>
    </ul>
</div>
