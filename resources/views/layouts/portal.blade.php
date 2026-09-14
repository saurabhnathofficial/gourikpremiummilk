<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Gourik Portal')</title>

    <!-- PWA Code is Here  -->


    <link
        rel="manifest"
        href="{{ asset('manifest.webmanifest') }}">

    <meta
        name="theme-color"
        content="#06264A">

    <meta
        name="mobile-web-app-capable"
        content="yes">

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

    <!-- PWA Code is Here  -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body>


    <style>
        /* =========================================================
       GOURIK PORTAL NAVBAR
    ========================================================= */

        .portal-navbar {
            position: sticky;
            top: 0;
            z-index: 1030;

            min-height: 72px;

            background: #ffffff;

            border-bottom: 1px solid #e9eeeb;

            box-shadow: 0 4px 18px rgba(6, 38, 74, 0.06);
        }


        /* =========================================================
       LOGO
    ========================================================= */

        .portal-brand {
            display: flex;
            align-items: center;

            text-decoration: none;

            flex-shrink: 0;
        }

        .portal-brand img {
            display: block;

            width: 158px;
            height: auto;
        }


        /* =========================================================
       NAVIGATION
    ========================================================= */

        .portal-nav {
            gap: 4px;
        }

        .portal-nav .nav-link {

            position: relative;

            display: flex;
            align-items: center;
            gap: 7px;

            padding: 10px 13px !important;

            border-radius: 10px;

            color: #4b5563;

            font-size: 13px;
            font-weight: 600;

            transition: all .2s ease;
        }


        .portal-nav .nav-link i {
            font-size: 15px;

            color: #667085;

            transition: color .2s ease;
        }


        .portal-nav .nav-link:hover {

            background: #f3f8f5;

            color: #198754;
        }


        .portal-nav .nav-link:hover i {

            color: #198754;
        }


        /* =========================================================
       ACTIVE NAV ITEM
    ========================================================= */

        .portal-nav .nav-link.active {

            background: #eaf7f0;

            color: #198754;
        }


        .portal-nav .nav-link.active i {

            color: #198754;
        }


        .portal-nav .nav-link.active::after {

            content: "";

            position: absolute;

            left: 13px;
            right: 13px;

            bottom: 3px;

            height: 2px;

            border-radius: 10px;

            background: #198754;
        }


        /* =========================================================
       USER AREA
    ========================================================= */

        .portal-user-area {

            display: flex;

            align-items: center;

            gap: 12px;

            margin-left: 12px;

            padding-left: 15px;

            border-left: 1px solid #e7ece9;
        }


        .portal-user {

            display: flex;

            align-items: center;

            gap: 9px;
        }


        .portal-user-avatar {

            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 11px;

            background: #e8f5ef;

            color: #198754;

            font-size: 16px;
        }


        .portal-user-info {

            line-height: 1.15;
        }


        .portal-user-name {

            display: block;

            max-width: 125px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

            color: #172033;

            font-size: 13px;

            font-weight: 600;
        }


        .portal-user-role {

            display: block;

            margin-top: 3px;

            color: #98a2b3;

            font-size: 10px;

            font-weight: 500;

            text-transform: uppercase;

            letter-spacing: .4px;
        }


        /* =========================================================
       LOGOUT
    ========================================================= */

        .portal-logout {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            min-height: 38px;

            padding: 7px 13px;

            border: 1px solid #f0c9c9;

            border-radius: 10px;

            background: #fff;

            color: #dc3545;

            font-size: 12px;

            font-weight: 600;

            transition: all .2s ease;
        }


        .portal-logout:hover {

            border-color: #dc3545;

            background: #fff5f5;

            color: #c82333;
        }


        /* =========================================================
       MOBILE TOGGLE
    ========================================================= */

        .portal-toggler {

            width: 42px;
            height: 42px;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 0;

            border: 1px solid #e3e9e6;

            border-radius: 11px;

            background: #f8faf9;

            color: #06264A;

            font-size: 21px;
        }


        .portal-toggler:focus {

            box-shadow: 0 0 0 3px rgba(25, 135, 84, .12);
        }


        /* =========================================================
       MOBILE
    ========================================================= */

        @media (max-width: 991.98px) {

            .portal-navbar {

                min-height: 64px;
            }


            .portal-brand img {

                width: 145px;
            }


            .portal-navbar .container {

                padding-top: 8px;

                padding-bottom: 8px;
            }


            .portal-collapse {

                margin-top: 12px;

                padding: 10px;

                border: 1px solid #e7ece9;

                border-radius: 14px;

                background: #ffffff;

                box-shadow: 0 8px 24px rgba(6, 38, 74, .07);
            }


            .portal-nav {

                gap: 3px;
            }


            .portal-nav .nav-link {

                padding: 11px 12px !important;
            }


            .portal-nav .nav-link.active::after {

                display: none;
            }


            .portal-user-area {

                margin-top: 10px;

                margin-left: 0;

                padding-top: 12px;

                padding-left: 0;

                border-top: 1px solid #edf1ef;

                border-left: 0;

                justify-content: space-between;
            }


            .portal-user-name {

                max-width: 180px;
            }

        }


        @media (max-width: 575.98px) {

            .portal-brand img {

                width: 135px;
            }


            .portal-user-area {

                align-items: center;
            }


            .portal-user-info {

                display: none;
            }


            .portal-user-avatar {

                width: 36px;
                height: 36px;
            }


            .portal-logout {

                padding: 7px 11px;
            }


            .portal-logout span {

                display: none;
            }

        }

        /* =========================================================
   CENTER DESKTOP MENU
========================================================= */

        @media (min-width: 992px) {

            .portal-navbar .container {
                position: relative;
            }

            .portal-collapse {
                position: static;
            }

            .portal-nav {
                position: absolute;

                left: 50%;
                top: 50%;

                transform: translate(-50%, -50%);

                display: flex;
                align-items: center;

                margin: 0 !important;

                white-space: nowrap;
            }

            .portal-user-area {
                margin-left: auto;
            }

        }
    </style>


    {{-- =========================================================
     PORTAL NAVBAR
========================================================= --}}

    <nav class="navbar navbar-expand-lg portal-navbar">

        <div class="container">


            {{-- =================================================
             LOGO
        ================================================== --}}

            <a
                class="portal-brand"
                href="{{ auth()->user()->role === 'admin'
                ? route('admin.dashboard')
                : route('farmer.dashboard') }}">

                <img
                    src="{{ asset('images/gourik_logo.png') }}"
                    alt="Gourik Premium Milk">

            </a>


            {{-- =================================================
             MOBILE TOGGLE
        ================================================== --}}

            <button
                class="portal-toggler d-lg-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#portalNavbar"
                aria-controls="portalNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation">

                <i class="bi bi-list"></i>

            </button>


            {{-- =================================================
             NAVIGATION
        ================================================== --}}

            <div
                class="collapse navbar-collapse portal-collapse"
                id="portalNavbar">

                <ul class="navbar-nav portal-nav me-auto">


                    {{-- =========================================
                     ADMIN NAVIGATION
                ========================================== --}}

                    @if(auth()->user()->role === 'admin')


                    {{-- Dashboard --}}

                    <li class="nav-item">

                        <a
                            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">

                            <i class="bi bi-grid-1x2-fill"></i>

                            Dashboard

                        </a>

                    </li>


                    {{-- Farmers --}}

                    <li class="nav-item">

                        <a
                            class="nav-link {{ request()->routeIs('admin.farmers.*') ? 'active' : '' }}"
                            href="{{ route('admin.farmers.index') }}">

                            <i class="bi bi-people-fill"></i>

                            Farmers

                        </a>

                    </li>


                    {{-- Milk Collection --}}

                    <li class="nav-item">

                        <a
                            class="nav-link {{ request()->routeIs('admin.milk.create') ? 'active' : '' }}"
                            href="{{ route('admin.milk.create', ['session' => 'morning']) }}">

                            <i class="bi bi-droplet-fill"></i>

                            Milk Collection

                        </a>

                    </li>


                    {{-- Milk History --}}

                    <li class="nav-item">

                        <a
                            class="nav-link {{ request()->routeIs('admin.milk.index') ? 'active' : '' }}"
                            href="{{ route('admin.milk.index') }}">

                            <i class="bi bi-clock-history"></i>

                            Milk History

                        </a>

                    </li>


                    {{-- Farmer Bills --}}

                    <li class="nav-item">

                        <a
                            class="nav-link {{ request()->routeIs('admin.farmer-bills.*') ? 'active' : '' }}"
                            href="{{ route('admin.farmer-bills.index') }}">

                            <i class="bi bi-receipt"></i>

                            Farmer Bills

                        </a>

                    </li>


                    {{-- =========================================
                     FARMER NAVIGATION
                ========================================== --}}

                    @elseif(auth()->user()->role === 'farmer')


                    <li class="nav-item">

                        <a
                            class="nav-link {{ request()->routeIs('farmer.dashboard') ? 'active' : '' }}"
                            href="{{ route('farmer.dashboard') }}">

                            <i class="bi bi-grid-1x2-fill"></i>

                            Dashboard

                        </a>

                    </li>


                    @endif


                </ul>


                {{-- =================================================
                 USER AREA
            ================================================== --}}

                <div class="portal-user-area">


                    <div class="portal-user">

                        <div class="portal-user-avatar">

                            @if(auth()->user()->role === 'admin')

                            <i class="bi bi-shield-check"></i>

                            @else

                            <i class="bi bi-person-fill"></i>

                            @endif

                        </div>


                        <div class="portal-user-info">

                            <span class="portal-user-name">

                                {{ auth()->user()->name }}

                            </span>


                            <span class="portal-user-role">

                                {{ auth()->user()->role }}

                            </span>

                        </div>

                    </div>


                    {{-- Logout --}}

                    <form
                        method="POST"
                        action="{{ route('logout') }}">

                        @csrf

                        <button
                            type="submit"
                            class="portal-logout">

                            <i class="bi bi-box-arrow-right"></i>

                            <span>Logout</span>

                        </button>

                    </form>


                </div>

            </div>

        </div>

    </nav>


    @yield('content')


    <script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function () {
            navigator.serviceWorker.register(
                '{{ asset('sw.js') }}'
            ).then(function (registration) {
                console.log(
                    'Gourik PWA service worker registered:',
                    registration.scope
                );
            }).catch(function (error) {
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