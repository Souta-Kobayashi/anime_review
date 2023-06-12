<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <base href="{{ url('/') }}/" />

    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-title" content="AnimeReview">
    <meta name="application-name" content="AnimeReview">
    <meta name="theme-color" content="#0b0c2a">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'AnimeReview | オススメのアニメを教えてください')</title>
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])
    {{-- <script src="{{ asset('js/app.js') }}" defer="defer"></script> --}}

    {{-- <link rel="stylesheet" href="{{ asset(mix('css/app-'.htmldir().'.css')) }}"> --}}
    <link rel="apple-touch-icon" sizes="152x152" href="img/icons/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/icons/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="167x167" href="img/icons/touch-icon-ipad-retina.png">

    <link rel="shortcut icon" sizes="196x196" href="img/icons/favicon-196.png">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    {{-- 不要なら削除する --}}
    {{-- <script>
      window.Laravel = {!! \Safe\json_encode([
          'locale' => \App::getLocale(),
          'htmldir' => htmldir(),
          'profileDefaultView' => auth()->user()->profile_active_tab,
          'timezone' => auth()->user()->timezone,
          'env' => \App::environment(),
      ]); !!}
    </script> --}}
  </head>
  <body>
    <div id="app" class="flex-grow-1">
    </div>

    {{-- <script src="{{ asset(mix('js/manifest.js')) }}"></script>
    <script src="{{ asset(mix('js/vendor.js')) }}"></script>
    <script src="{{ asset(mix('js/app.js')) }}"></script> --}}

  </body>
</html>
