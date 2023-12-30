<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Black Dashboard') }}</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('black') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('black') }}/img/favicon.png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet"/>
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('black') }}/css/nucleo-icons.css" rel="stylesheet"/>
    <!-- CSS -->
    <link href="{{ asset('black') }}/css/black-dashboard.css?v=1.0.0" rel="stylesheet"/>
    <link href="{{ asset('black') }}/css/theme.css" rel="stylesheet"/>
    @laravelViewsStyles
</head>
<body class="{{ $class ?? '' }}">
<div class="wrapper">
    @include('layouts.navbars.sidebar')
    <div class="main-panel">
        @include('layouts.navbars.navbar')
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
<form id="logout-form" action="{{route('log-out')}}" method="POST" style="display: none;">
    @csrf
</form>

<script src="{{ asset('black') }}/js/core/jquery.min.js"></script>
<script src="{{ asset('black') }}/js/core/popper.min.js"></script>
<script src="{{ asset('black') }}/js/core/bootstrap.min.js"></script>
<script src="{{ asset('black') }}/js/plugins/bootstrap-notify.js"></script>

<script src="{{ asset('black') }}/js/black-dashboard.js?v=1.0.0"></script>
<script src="{{ asset('black') }}/js/theme.js"></script>

@stack('js')

@stack('js')
@laravelViewsScripts
</body>
</html>
