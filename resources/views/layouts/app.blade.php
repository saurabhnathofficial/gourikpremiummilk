<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description"
        content="Gourik Premium Milk - Pure milk from trusted farmers to your family.">

    <title>@yield('title', 'Gourik Premium Milk')</title>



    <!-- Pwa app code here  -->

    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}">

    <meta name="theme-color" content="#06264A">

    <meta name="mobile-web-app-capable" content="yes">

    <meta
        name="apple-mobile-web-app-capable"
        content="yes">

    <meta
        name="apple-mobile-web-app-status-bar-style"
        content="default">

    <meta
        name="apple-mobile-web-app-title"
        content="Gourik Milk">

    <link
        rel="apple-touch-icon"
        href="{{ asset('images/apple-touch-icon.png') }}">

    <!-- Pwa app code here  -->

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body>

    {{-- Public Gourik Navbar --}}
    <x-navbar />

    {{-- Page Content --}}
    @yield('content')


    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register(
                    '{{ asset('sw.js ') }}'
                ).then(function(registration) {
                    console.log(
                        'Gourik PWA service worker registered:',
                        registration.scope
                    );
                }).catch(function(error) {
                    console.error(
                        'Gourik PWA service worker registration failed:',
                        error
                    );
                });
            });
        }
    </script>
</body>

</html>