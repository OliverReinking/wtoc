<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="World Teamplayer Organization Championship">
  <meta name="author" content="Oliver Reinking">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Title -->
  <title>WTOC</title>

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
  <meta name="msapplication-TileColor" content="#0EA7DF">
  <meta name="theme-color" content="#0EA7DF">

  <!-- Styles -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>

<body id="page-top" class="leading-none max-w-full antialiased p-0 m-0 bg-blue-200">
  <div id="app" class="relative bg-blue-100">
    <div>

      <div>
        <mainnavigation />
      </div>

      @include('layouts.breadcrumb')

      <!-- wenn top-link aus dem Fenster verschwindet, wird der Link page-to-top sichtbar -->
      <div id="top-link">&nbsp;</div>

      <div class="w-full min-h-screen">
        <div class="container mx-auto max-w-6xl py-4 px-4 pb-40">
          @yield('content')
        </div>
      </div>

      <div class="w-full">
        <div class="p-2">
          <conditionalvisible when-hidden="#top-link">
            <smoothscroll href="#page-top"
              class="no-underline hover:underline hover:bg-orange-700 bg-orange-500 rounded-full w-12 h-12 fixed z-20 right-0 bottom-0 mb-8 mr-8 px-2 py-2 text-white text-xl text-center">
              <i class="fa fa-arrow-up"></i>
            </smoothscroll>
          </conditionalvisible>
        </div>
      </div>

    </div>
    <footer class="absolute bottom-0 left-0 w-full bg-blue-700 z-10 -mb-4">
      <div class="container mx-auto max-w-6xl">
        <div class="flex items-center py-3 px-3">
          <div class="w-1/3">
            <img src="/images/Logo_WTOC.png" title="WTOC" class="h-6 w-auto" />
          </div>
          <div class="w-1/3 text-center text-gray-300 text-xs p-2">
            World Teamplayer Organization Championship<br />
            Copyright © Oliver Reinking ({!! Config::get('konstanten.wtoc_aktuellesjahr') !!})<br />
            Version: {!! Config::get('konstanten.wtoc_version') !!}<br />
            {{ermittle_Datum(Carbon\Carbon::now(), 2)}}<br />
          </div>
        </div>
      </div>
    </footer>

  </div>

  <!-- Javascript -->
  <script src="{{ mix('/js/manifest.js') }}"></script>
  <script src="{{ mix('/js/vendor.js') }}"></script>
  <script src="{{ mix('/js/app.js') }}"></script>

</body>

</html>