<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Nexlub</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('black') }}/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('black') }}/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('black') }}/img/favicon-16x16.png">
    <link rel="manifest" href="{{ asset('black') }}/img/site.webmanifest">
    <link rel="mask-icon" href="{{ asset('black') }}/img/safari-pinned-tab.svg" color="#22c9e9">
    <meta name="msapplication-TileColor" content="#0e1726">
    <meta name="theme-color" content="#0e1726">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('black') }}/css/nucleo-icons.css" rel="stylesheet"/>
    <!-- CSS -->
    <link href="{{ asset('black') }}/css/black-dashboard.css?v=1.0.0" rel="stylesheet"/>
    <link href="{{ asset('black') }}/css/theme.css" rel="stylesheet"/>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    @laravelViewsStyles
</head>
<body class="{{ $class ?? '' }}">
<div class="flex relative">
    @include('layouts.navbars.navbar')

    @include('layouts.navbars.sidebar')
    <div class="wrapper">
        <div class="main-panel magicpattern">
            <div class="content">
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
<form id="logout-form" action="{{route('log-out')}}" method="POST" style="display: none;">
    @csrf
</form>

<script src="{{ asset('black') }}/js/core/jquery.min.js"></script>
<script src="{{ asset('black') }}/js/core/popper.min.js"></script>
<script src="{{ asset('black') }}/js/core/bootstrap.min.js"></script>
<script src="{{ asset('black') }}/js/plugins/bootstrap-notify.js"></script>
{{--    <!-- Alpine v3 -->--}}
{{--    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}

{{--    <!-- Focus plugin -->--}}
{{--    <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>--}}

@stack('js')

@stack('js')
@laravelViewsScripts
@livewire('livewire-ui-modal')
</body>
</html>
