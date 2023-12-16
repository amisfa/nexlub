<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('NL') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('Play and Earn') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{route('dashboard')}}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{route('play')}}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Play') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{route('addBalance')}}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('add balance') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{route('deposit')}}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('deposit') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="#">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Withdraw') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="#">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Reward') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href={{route('wallet')}}>
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Wallet') }}</p>
                </a>
            </li>
{{--            <li>--}}
{{--                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">--}}
{{--                    <i class="fab fa-laravel" ></i>--}}
{{--                    <i class="tim-icons icon-chart-pie-36"></i>--}}
{{--                    <span class="nav-link-text" >{{ __('Rooms') }}</span>--}}
{{--                    <b class="caret mt-1"></b>--}}
{{--                </a>--}}

{{--                <div class="collapse show" id="laravel-examples">--}}
{{--                    <ul class="nav pl-4">--}}
{{--                        <li @if ($pageSlug == 'profile') class="active " @endif>--}}
{{--                            <a href="#">--}}
{{--                                <i class="tim-icons icon-single-02"></i>--}}
{{--                                <p>{{ __('Poker') }}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li @if ($pageSlug == 'users') class="active " @endif>--}}
{{--                            <a href="#">--}}
{{--                                <i class="tim-icons icon-bullet-list-67"></i>--}}
{{--                                <p>{{ __('Blackjack') }}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </li>--}}
{{--            <li @if ($pageSlug == 'icons') class="active " @endif>--}}
{{--                    <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">--}}
{{--                    <i class="tim-icons icon-atom"></i>--}}
{{--                    <p>{{ __('Financial') }}</p>--}}
{{--                    <b class="caret mt-1"></b>--}}
{{--                </a>--}}
{{--                <div class="collapse show" id="laravel-examples">--}}
{{--                    <ul class="nav pl-4">--}}
{{--                        <li @if ($pageSlug == 'profile') class="active " @endif>--}}
{{--                            <a href="#">--}}
{{--                                <i class="tim-icons icon-single-02"></i>--}}
{{--                                <p>{{ __('Wallet') }}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li @if ($pageSlug == 'users') class="active " @endif>--}}
{{--                            <a href="#">--}}
{{--                                <i class="tim-icons icon-bullet-list-67"></i>--}}
{{--                                <p>{{ __('Withdraw') }}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li @if ($pageSlug == 'users') class="active " @endif>--}}
{{--                            <a href="#">--}}
{{--                                <i class="tim-icons icon-bullet-list-67"></i>--}}
{{--                                <p>{{ __('Deposit') }}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </li>--}}
{{--            <li @if ($pageSlug == 'maps') class="active " @endif>--}}
{{--                <a href="#">--}}
{{--                    <i class="tim-icons icon-pin"></i>--}}
{{--                    <p>{{ __('Maps') }}</p>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li @if ($pageSlug == 'notifications') class="active " @endif>--}}
{{--                <a href="#">--}}
{{--                    <i class="tim-icons icon-bell-55"></i>--}}
{{--                    <p>{{ __('Notifications') }}</p>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li @if ($pageSlug == 'tables') class="active " @endif>--}}
{{--                <a href="#">--}}
{{--                    <i class="tim-icons icon-puzzle-10"></i>--}}
{{--                    <p>{{ __('Table List') }}</p>--}}
{{--                </a>--}}
{{--            </li>--}}

        </ul>
    </div>
</div>
