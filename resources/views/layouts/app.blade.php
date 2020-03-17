<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{new_asset('img/LOGO1.png')}}" >
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <style type="text/css">
        @font-face {
            font-family: "Nunito";
            src: url('{{ new_asset('fonts/Nunito-Regular.ttf') }}');
        }
    </style>

    <!-- Font awesome -->
    <link href="{{ new_asset('css/all.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ new_asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ new_asset('css/font/custom.css') }}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-159949173-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-159949173-2');
    </script>

</head>
<body>
    <div id="app">
        @include('layouts.nav')

        <main class="py-4 navbar-top">
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>

    <!-- Scripts -->
    <script src="{{ new_asset('js/app.js') }}"></script>
    @yield('script')
</body>
</html>
