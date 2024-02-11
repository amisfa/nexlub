<div class="sidebar close">
    <ul class="nav-links">
        @if(!auth()->user()->hasRole('Administrator'))
            <li class="{{ $pageSlug == 'play' ? 'active relative' : 'relative'  }}">
                <span class="hidden first tooltip">Play</span>
                <a href="{{route('play')}}" target="_blank">
                    <i class='bx bx-play'></i>
                    <span class="link_name">Play</span>
                </a>
            </li>
            <li class="{{ $pageSlug == 'deposit' ? 'active relative' : 'relative'  }}">
                <span class="hidden tooltip">Deposit</span>
                <a href="{{route('deposit')}}">
                    <i class='bx bx-wallet'></i>
                    <span class="link_name">Deposit</span>
                </a>
            </li>
            <li class="{{ $pageSlug == 'withdraw' ? 'active relative' : 'relative'  }}">
                <span class="hidden tooltip">Withdraw</span>
                <a href="{{route('withdraw')}}">
                    <i class='bx bx-dollar'></i>
                    <span class="link_name">Withdraw</span>
                </a>
            </li>
            <li class="{{ $pageSlug == 'rakeBack' || $pageSlug == 'user-jack-pot' || $pageSlug == 'user-bad-beat' ? 'active showMenu relative' : 'relative'  }}">
                <span class="hidden tooltip">Rewards</span>
                <div class="icon-link cursor-default">
                    <a>
                        <i class='bx bx-trophy' style="cursor: default!important"></i>
                        <span class="link_name">Rewards</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li @if ($pageSlug == 'rakeBack') class="active" @endif>
                        <a href="{{route('rake-back')}}">Rake Back</a></li>
                    <div class="flex justify-between items-center">
                        <li @if ($pageSlug == 'user-jack-pot') class="active" @endif>
                            <a href="{{route('jack-pot')}}">Jack Pot</a></li>
                        @if(auth()->user()->unclaimed_jack_pot >0)
                            <span style="background: #22c9e9"
                                  class="text-sm text-dark font-medium me-2 px-2 rounded ml-2">
                        {{auth()->user()->unclaimed_jack_pot}}
                    </span>
                        @endif
                    </div>
                    <div class="flex justify-between items-center">
                        <li @if ($pageSlug == 'user-bad-beat') class="active" @endif>
                            <a href="{{route('bad-beat')}}">BadBeat</a></li>
                        @if(auth()->user()->unclaimed_bad_beat >0)
                            <span style="background: #22c9e9"
                                  class="text-sm text-dark font-medium me-2 px-2 rounded ml-2">
                        {{auth()->user()->unclaimed_bad_beat}}
                    </span>
                        @endif
                    </div>
                </ul>
            </li>
            <li class="{{ $pageSlug == 'referral' ? 'active relative' : 'relative'  }}">
                <span class="hidden tooltip">Referral</span>
                <a href="{{route('referral')}}">
                    <i class='bx bxs-user-detail'></i>
                    <span class="link_name">Referral</span>
                </a>
            </li>
            <li class="{{ $pageSlug == 'statics' ? 'active relative' : 'relative'  }}">
                <span class="hidden tooltip">Statics</span>
                <a href="{{route('statics')}}">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Statics</span>
                </a>
            </li>
            <li class="{{ $pageSlug == 'tickets' ? 'active relative' : 'relative'  }}">
                <span class="hidden tooltip">Tickets</span>
                <a href="{{route('tickets')}}">
                    <i class='bx bx-message'></i>
                    <span class="link_name">Support</span>
                </a>
            </li>
        @endif
        @if(auth()->user()->hasRole('Administrator'))
            <li class="{{ $pageSlug == 'user-management' || $pageSlug == 'withdraw-management' ||$pageSlug == 'ticket-management' ? 'active showMenu relative' : 'relative'  }}">
                <span class="hidden tooltip">Admin</span>
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
        @endif
    </ul>
</div>
