<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        .mavens div {
            position: absolute;
            top: 0px;
            right: 0px;
            left: 0px;
            bottom: 0px;
        }

        .mavens iframe, .mavens {
            width: 100%;
            height: 100%;
            border: none;
        }

        body, html {
            margin: 0;
            padding: 0;
            overflow: hidden;
            height: 100%;
        }

        .icon-bar {
            position: fixed;
            bottom: 3%;
            right: 0%;
        }

        .icon-bar a {
            display: block;
            text-align: center;
            padding: 10px 12px;
            transition: all 0.3s ease;
            color: #22C7E7;
            font-size: 28px;
            border-radius: 4px 0px 0px 4px;
        }

        .home-page {
            background: linear-gradient(313deg, rgba(24,24,24,1) 11%, rgba(89,89,89,1) 100%);
        }
    </style>
    <title>Play</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('black') }}/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('black') }}/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('black') }}/img/favicon-16x16.png">
    <link rel="manifest" href="{{ asset('black') }}/img/site.webmanifest">
    <link rel="mask-icon" href="{{ asset('black') }}/img/safari-pinned-tab.svg" color="#22c9e9">
    <meta name="msapplication-TileColor" content="#0e1726">
    <meta name="theme-color" content="#0e1726">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
    <div class="mavens">
        <iframe src='{{$url}}'></iframe>
    </div>
<span class="icon-bar">
                <a href="{{route('home-page')}}" target="_blank" class="home-page"><i class='bx bx-home'></i></a>
</span>
</html>
