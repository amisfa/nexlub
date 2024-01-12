<div class="container-fluid" wire:poll.1s>
    <label class="toggle" onclick="clickedToggleButton()">
        <input type="checkbox">
        <div>
            <div>
                <span></span>
                <span></span>
            </div>
            <svg>
                <use xlink:href="#path"/>
            </svg>
            <svg>
                <use xlink:href="#path"/>
            </svg>
        </div>
    </label>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" id="path">
            <path d="M22,22 L2,22 C2,11 11,2 22,2 C33,2 42,11 42,22"></path>
        </symbol>
    </svg>
    <div class="navbar-wrapper">
        <a class="navbar-brand" href="#">{{ $page ?? __('Nexlub') }}</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
    </button>
    <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav ml-auto">
            <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link flex justify-between items-center"
                   data-toggle="dropdown">
                    <div class="flex justify-start pr-4">
                        <img src="{{ asset('avatars') }}/{{auth()->user()->avatar}}.png"
                             style="height: 40px!important"
                             alt="{{ __('Profile Photo') }}">
                        <div class="flex flex-column bold px-1 justify-end">
                            <p>{{$user->username}}</p>
                            <p>${{number_format($user->balance, 2)}}</p>
                        </div>
                    </div>
                    <b class="caret d-none d-lg-block d-xl-block"></b>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                    <li class="nav-link">
                        <a href="{{route('profile-view')}}"
                           class="nav-item dropdown-item">{{ __('Setting') }}</a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li class="nav-link">
                        <a href="#" class="nav-item dropdown-item"
                           onclick="event.preventDefault();  document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
                    </li>
                </ul>
            </li>
            <li class="separator d-lg-none"></li>
        </ul>
    </div>
</div>