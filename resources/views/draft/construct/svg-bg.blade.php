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
    <title>SVG BG</title>

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
    <div id="app">
        <h1>hello bg</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus asperiores quasi voluptatibus qui eveniet? Dignissimos eveniet cumque, doloremque, sed aperiam reprehenderit vero consequatur excepturi laborum a delectus provident. Totam, deserunt.</p>
    </div>
    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('/js/vendor.js') }}"></script>
    <script src="{{ mix('/js/vue-svg-bg.js') }}"></script>
</body>
</html>
