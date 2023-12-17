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
            <li @if ($pageSlug == 'play') class="active " @endif>
                <a href="{{route('play')}}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Play') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#payments" aria-expanded="true">
                    <i class="fab fa-laravel"></i>
                    <span class="nav-link-text">{{ __('Payment') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse show" id="payments">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'create-payment') class="active " @endif>
                            <a href="{{route('create-payment')}}">
                                <i class="tim-icons icon-chart-pie-36"></i>
                                <p>{{ __('Create Payment') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'payments') class="active " @endif>
                            <a href="{{route('payments')}}">
                                <i class="tim-icons icon-chart-pie-36"></i>
                                <p>{{ __('Payments') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{route('deposit')}}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('deposit') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'withdraw') class="active " @endif>
                <a href="#">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Withdraw') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'rewards') class="active " @endif>
                <a href="#">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Rewards') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
