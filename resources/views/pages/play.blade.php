<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        div {
            position: absolute;
            top: 0px;
            right: 0px;
            left: 0px;
            bottom: 0px;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        body, html {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
    </style>
</head>
<body>
<div>
    <iframe src='{{$url}}'></iframe>
</div>
</body>
</html>
