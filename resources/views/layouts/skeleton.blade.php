<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <base href="{{ url('/') }}/" />

    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-title" content="Anime Review">
    <meta name="application-name" content="AnimeReview">
    <meta name="theme-color" content="#343a49">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>@yield('title', 'AnimeReview | オススメのアニメを教えてください')</title>
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="shortcut icon" sizes="50x50" href="image/favicon.ico">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  </head>
  <body>
    <div id="app">
    </div>
  </body>
</html>
