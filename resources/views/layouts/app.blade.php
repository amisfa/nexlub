<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Nexlub</title>
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('black') }}/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('black') }}/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('black') }}/img/favicon-16x16.png">
    <link rel="manifest" href="{{ asset('black') }}/img/site.webmanifest">
    <link rel="mask-icon" href="{{ asset('black') }}/img/safari-pinned-tab.svg" color="#22c9e9">
    <meta name="msapplication-TileColor" content="#0e1726">
    <meta name="theme-color" content="#0e1726">
    @auth()
        <!-- CSS -->
        <link href="{{ asset('black') }}/css/black-dashboard.css" rel="stylesheet"/>
        <link href="{{ asset('black') }}/css/theme.css" rel="stylesheet"/>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endauth
    @guest()
        <link href="{{ asset('black') }}/css/guest.css" rel="stylesheet"/>
    @endguest
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    @laravelViewsStyles
</head>
<body class="{{ $class ?? '' }}">
@auth()
    <div class="flex relative">
        @include('layouts.navbars.navs.auth')
        @include('layouts.navbars.sidebar')
        <div class="wrapper">
            <div class="main-panel magic-pattern">
                <div @if ($pageSlug == 'homePage')  class="home-page-content" @else class="content" @endif>
                    @if(session('warning'))
                        <div class="alert alert-primary" role="alert">{{session('warning')}}</div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">{{session('success')}}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">{{session('error')}}</div>
                    @endif
                    @yield('content')
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>
@endauth
@guest()
    @include('layouts.navbars.navs.guest')
    <div class="wrapper">
        <div class="main-panel magic-pattern">
            <div class="content">
                @yield('content')
            </div>
            @include('layouts.footer')
        </div>
    </div>
@endguest

@auth()
    <form id="logout-form" action="{{route('log-out')}}" method="POST" style="display: none;">
        @csrf
    </form>
@endauth
<script src="{{ asset('black') }}/js/core/jquery.min.js"></script>
<script src="{{ asset('black') }}/js/core/popper.min.js"></script>
<script src="{{ asset('black') }}/js/core/bootstrap.min.js"></script>
<script src="{{ asset('black') }}/js/plugins/bootstrap-notify.js"></script>
@stack('js')

@stack('js')
@laravelViewsScripts
@livewire('livewire-ui-modal')
</body>
</html>
