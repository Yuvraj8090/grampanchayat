<!DOCTYPE html>
<html lang="hi">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ isset($header) ? $header . ' - ' : '' }} Gram Panchayat Admin
    </title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @vite(['resources/css/app.scss', 'resources/js/app.js'])


    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8f9fa;
        }

        /* --- Sidebar Custom Logic (Bootstrap doesn't do "push" sidebars natively) --- */
        #wrapper {
            overflow-x: hidden;
        }

        #sidebar-wrapper {
            min-height: 100vh;
            width: 16rem;
            margin-left: -16rem;
            /* Hidden by default on mobile */
            transition: margin 0.25s ease-out;
            position: fixed;
            z-index: 1000;
        }

        #page-content-wrapper {
            width: 100%;
            transition: margin 0.25s ease-out;
        }

        /* Desktop View: Sidebar is visible */
        @media (min-width: 768px) {
            #sidebar-wrapper {
                margin-left: 0;
            }

            #page-content-wrapper {
                margin-left: 16rem;
            }

            /* Toggled State: Hide sidebar */
            #wrapper.toggled #sidebar-wrapper {
                margin-left: -16rem;
            }

            #wrapper.toggled #page-content-wrapper {
                margin-left: 0;
            }
        }

        /* Mobile View: Sidebar is hidden */
        @media (max-width: 767.98px) {

            /* Toggled State: Show sidebar */
            #wrapper.toggled #sidebar-wrapper {
                margin-left: 0;
            }
        }

        /* Custom Sidebar Colors */
        .sidebar-dark {
            background-color: #212529;
            color: #adb5bd;
        }

        .sidebar-dark .list-group-item {
            background: transparent;
            color: #adb5bd;
            border: none;
        }

        .sidebar-dark .list-group-item:hover {
            background-color: #343a40;
            color: #fff;
        }

        .sidebar-dark .list-group-item.active {
            background-color: #0d6efd;
            color: #fff;
            font-weight: 600;
        }

        .sidebar-heading {
            background-color: #1a1d20;
            color: white;
            border-bottom: 1px solid #343a40;
        }
    </style>

    @livewireStyles
</head>

<body>

    <div class="d-flex text-capitalize" id="wrapper">

        <div class="sidebar-dark border-end" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 fs-5 fw-bold text-uppercase tracking-wider">
                <i class="fa-solid fa-landmark me-2 text-primary"></i> पंचायत
            </div>

            <div class="list-group list-group-flush my-3">
                <a href="{{ route('dashboard') }}"
                    class="list-group-item list-group-item-action px-4 py-3 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge me-3"></i> डैशबोर्ड
                </a>

                <div class="small fw-bold text-uppercase px-4 mt-4 mb-2 text-secondary opacity-75"
                    style="font-size: 0.75rem;">
                    अभिगम नियंत्रण
                </div>

                <a href="{{ route('admin.users.index') }}"
                    class="list-group-item list-group-item-action px-4 py-2 {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users me-3"></i> उपयोगकर्ता
                </a>

                <a href="{{ route('admin.roles.index') }}"
                    class="list-group-item list-group-item-action px-4 py-2 {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-shield-halved me-3"></i> भूमिकाएँ
                </a>

                <div class="small fw-bold text-uppercase px-4 mt-4 mb-2 text-secondary opacity-75"
                    style="font-size: 0.75rem;">
                    मास्टर डेटा
                </div>

                <a href="{{ route('admin.states.index') }}"
                    class="list-group-item list-group-item-action px-4 py-2 {{ request()->routeIs('admin.states.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-map me-3"></i> राज्य
                </a>

                <a href="{{ route('admin.districts.index') }}"
                    class="list-group-item list-group-item-action px-4 py-2 {{ request()->routeIs('admin.districts.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-map-location-dot me-3"></i> ज़िले
                </a>

                <a href="{{ route('admin.blocks.index') }}"
                    class="list-group-item list-group-item-action px-4 py-2 {{ request()->routeIs('admin.blocks.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-cubes-stacked me-3"></i> ब्लॉक
                </a>

                <a href="{{ route('admin.panchayats.index') }}"
                    class="list-group-item list-group-item-action px-4 py-2 {{ request()->routeIs('admin.panchayats.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-gopuram me-3"></i> पंचायतें
                </a>


            </div>
        </div>

        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top px-3">
                <div class="container-fluid">
                    <button class="btn btn-light border" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0 align-items-center">

                            <li class="nav-item me-3">
                                <a class="nav-link position-relative text-secondary" href="#">
                                    <i class="fa-regular fa-bell fa-lg"></i>
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                        style="font-size: 0.6rem;">3</span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                    id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <img class="rounded-circle me-2 border object-fit-cover" width="35" height="35"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    @else
                                    <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center me-2 fw-bold"
                                        style="width: 35px; height: 35px;">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    @endif
                                    <span class="fw-semibold text-dark d-none d-lg-block">
                                        {{ Auth::user()->name }}
                                    </span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.show') }}">
                                            <i class="fas fa-user-circle me-2 text-secondary"></i> प्रोफ़ाइल
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i class="fa-solid fa-right-from-bracket me-2"></i> लॉग आउट
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>

            @if (isset($header))
            <div class="bg-white border-bottom py-3 px-4 shadow-sm">
                <h5 class="mb-0 fw-bold text-dark">{{ $header }}</h5>
            </div>
            @endif

            <main class="container-fluid p-4">
                <x-banner />
                {{ $slot }}
            </main>

        </div>
    </div>

    @stack('modals')

    @livewireScripts


    <script>
        // Toggle Logic for Sidebar
        window.addEventListener('DOMContentLoaded', event => {
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.querySelector('#wrapper').classList.toggle('toggled');
                });
            }
        });
    </script>
</body>

</html>