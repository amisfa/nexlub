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
        </ul>
    </div>
</div>
