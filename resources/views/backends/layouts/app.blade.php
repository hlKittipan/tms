<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <style type="text/css">
        @font-face {
            font-family: "Nunito";
            src: url('{{ asset('fonts/Nunito-Regular.ttf') }}');
        }
    </style>
    <!-- Font Awesome-->
    <link href="{{asset('css/all.min.css')}}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>

</head>
<body>
<div id="app">
    @include('backends.layouts.nav')

    <main class="py-4">
        @yield('content')
    </main>
    <footer>
        <div class=" col-md-12 text-center">
            Copyright © 2018 Twenty four seven hours Tour Limited All rights reserved.
        </div>
    </footer>
</div>
<script src="{{ asset('js/jquery-3.4.1.min.js') }}" ></script>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

{{--google map--}}
{{--<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('setting-services')->{'google-map-key'} }}&callback=initMap"--}}
{{--        type="text/javascript"></script>--}}
    @yield('script')
</body>
</html>
