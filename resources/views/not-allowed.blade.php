<!DOCTYPE html>
<html lang="th-TH">
<head>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Not allowed</title>

    <style>
        body, html {
            /* Full height and screen */
            margin:0;
            padding:0;
            height: 100%;
            /* The image used */
            background-image: url("/images/not-allowed.png");
            /* Center and scale the image nicely */
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            
            cursor: pointer;
        }
    </style>
</head>
<body onclick="window.location.href = '/authenticated';">
</body>
</html>
