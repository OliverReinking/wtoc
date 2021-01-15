<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Starter Package</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon//favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon//favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#312E81">
    <meta name="msapplication-TileColor" content="#312E81">
    <meta name="msapplication-config" content="favicon/browserconfig.xml">
    <meta name="theme-color" content="#312E81">
    <!-- CSS -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <!-- Javascript -->
    <script src="{{ mix('/js/app.js') }}" defer></script>
</head>

<body>
    <div id="app">
        <app-homepage></app-homepage>
    </div>
</body>

</html>
