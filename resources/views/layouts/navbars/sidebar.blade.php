<div class="sidebar close">
    <div class="logo-details">
        <i class='bx bx-star'></i>
        <span class="logo_name">Nexclub</span>
    </div>
    <ul class="nav-links">
        <li @if ($pageSlug == 'dashboard') class="active"@endif>
            <a href="{{route('dashboard')}}">
                <i class='bx bx-grid-alt'></i>
                <span class="link_name">Dashboard</span>
            </a>
        </li>
        <li @if ($pageSlug == 'invoices' || $pageSlug == 'payments') class="active" @endif>
            <div class="icon-link">
                <a href="">
                    <i class='bx bx-collection'></i>
                    <span class="link_name">Deposit</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li @if ($pageSlug == 'invoices') class="active " @endif><a href="{{route('invoices')}}">Create
                        Invoice</a></li>
                <li @if ($pageSlug == 'payments') class="active " @endif><a href="{{route('payments')}}">Payments</a>
                </li>
            </ul>
        </li>
        <li @if ($pageSlug == 'subset') class="active"@endif>
            <a href="{{route('subset')}}">
                <i class='bx bxs-user-detail'></i>
                <span class="link_name">Subset</span>
            </a>
        </li>
        <li @if ($pageSlug == 'ticket') class="active"@endif>
            <a href="">
                <i class='bx bxs-message-square-dots'></i>
                <span class="link_name">Ticket</span>
            </a>
        </li>
        <li @if ($pageSlug == 'withdraw') class="active"@endif>
            <a href="{{route('withdraw')}}">
                <i class='bx bx-dollar'></i>
                <span class="link_name">Withdraw</span>
            </a>
        </li>
        <li @if ($pageSlug == 'userManagement' || $pageSlug == 'withdrawManagement') class="active" @endif>
            <div class="icon-link">
                <a href="">
                    <i class='bx bx-user'></i>
                    <span class="link_name">Admin</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li @if ($pageSlug == 'userManagement') class="active " @endif>
                    <a href="{{route('user-management')}}">User</a></li>
                <li @if ($pageSlug == 'withdrawManagement') class="active " @endif><a
                        href="{{route('withdraw-management')}}">Withdraw</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
