<div class="sidebar close">
    <ul class="nav-links">
        <li @if ($pageSlug == 'play') class="active"@endif>
            <a href="{{route('play')}}" target="_blank">
                <i class='bx bx-play'></i>
                <span class="link_name">Play</span>
            </a>
        </li>

        <li @if ($pageSlug == 'statics') class="active"@endif>
            <a href="{{route('statics')}}">
                <i class='bx bx-grid-alt'></i>
                <span class="link_name">Statics</span>
            </a>
        </li>
        <li @if ($pageSlug == 'deposit') class="active"@endif>
            <a href="{{route('deposit')}}">
                <i class='bx bx-wallet'></i>
                <span class="link_name">Deposit</span>
            </a>
        </li>
        <li @if ($pageSlug == 'withdraw') class="active"@endif>
            <a href="{{route('withdraw')}}">
                <i class='bx bx-dollar'></i>
                <span class="link_name">Withdraw</span>
            </a>
        </li>
        <li @if ($pageSlug == 'tickets') class="active"@endif>
            <a href="{{route('tickets')}}">
                <i class='bx bx-message'></i>
                <span class="link_name">Support</span>
            </a>
        </li>
        <li @if ($pageSlug == 'rakeBack') class="active showMenu" @endif>
            <div class="icon-link cursor-default">
                <a>
                    <i class='bx bx-trophy' style="cursor: default!important"></i>
                    <span class="link_name">Rewards</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li @if ($pageSlug == 'rakeBack') class="active " @endif>
                    <a href="{{route('rake-back')}}">Rake Back</a></li>
            </ul>
        </li>
        <li @if ($pageSlug == 'referral') class="active"@endif>
            <a href="{{route('referral')}}">
                <i class='bx bxs-user-detail'></i>
                <span class="link_name">Referral</span>
            </a>
        </li>
        <li @if ($pageSlug == 'user-management' || $pageSlug == 'withdraw-management' ||$pageSlug == 'ticket-management' ) class="active showMenu" @endif>
            <div class="icon-link cursor-default">
                <a>
                    <i class='bx bx-user' style="cursor: default!important"></i>
                    <span class="link_name">Admin</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li @if ($pageSlug == 'user-management') class="active" @endif>
                    <a href="{{route('user-management')}}">User</a></li>
                <li @if ($pageSlug == 'withdraw-management') class="active" @endif>
                    <a href="{{route('withdraw-management')}}">Withdraw</a>
                </li>
                <li @if ($pageSlug == 'ticket-management') class="active" @endif>
                    <a href="{{route('ticket-management')}}">Ticket</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
