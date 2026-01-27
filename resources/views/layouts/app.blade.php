<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (isset($header) && $header)
        {{ $header }} - {{ 'Gram Panchayat Admin' }}
        @else
        Gram Panchayat Admin
        @endif
    </title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    <script>
        window.showToast = function(type, message) {
    // 1. Choose Icon based on type
    let icon = type === 'success' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-exclamation-circle"></i>';
    
    // 2. Create HTML Element
    let toastHtml = `
        <div class="toast-notification toast-${type}">
            <div class="toast-icon fs-4">${icon}</div>
            <div class="toast-text">${message}</div>
        </div>
    `;

    // 3. Append to Container
    let $toast = $(toastHtml);
    $('#toast-container').append($toast);

    // 4. Auto Remove after 3 seconds
    setTimeout(() => {
        $toast.addClass('toast-hiding'); // Fade out CSS
        setTimeout(() => $toast.remove(), 300); // Remove from DOM
    }, 3000);
};
    </script>

    <style>
        /* Toast Container - Fixed to Top Right */
        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1055;
            /* Above Bootstrap Modals */
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* Individual Toast Styling */
        .toast-notification {
            min-width: 300px;
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            border-left: 5px solid #ccc;
            /* Default border */
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: slideIn 0.3s ease-out forwards;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        /* Toast Types */
        .toast-success {
            border-left-color: #198754;
            /* Bootstrap Success Green */
        }

        .toast-success .toast-icon {
            color: #198754;
        }

        .toast-error {
            border-left-color: #dc3545;
            /* Bootstrap Danger Red */
        }

        .toast-error .toast-icon {
            color: #dc3545;
        }

        /* Text Styling */
        .toast-text {
            font-weight: 500;
            color: #333;
            margin-left: 10px;
            flex-grow: 1;
        }

        /* Animations */
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .toast-hiding {
            opacity: 0;
            transform: translateX(20px);
        }

        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -15rem;
            transition: margin .25s ease-out;
            background-color: #212529;
            color: white;
            border-right: 1px solid #333;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 1.2rem 1rem;
            font-size: 1.2rem;
            font-weight: bold;
            color: #fff;
            border-bottom: 1px solid #333;
            background-color: #1a1d20;
        }

        #sidebar-wrapper .list-group {
            width: 15rem;
        }

        #sidebar-wrapper .list-group-item {
            background-color: transparent;
            color: #ccc;
            border: none;
            padding: 0.8rem 1.25rem;
            font-size: 0.95rem;
            border-left: 4px solid transparent;
        }

        #sidebar-wrapper .list-group-item:hover {
            background-color: #343a40;
            color: #fff;
            border-left-color: #6c757d;
        }

        #sidebar-wrapper .list-group-item.active {
            background-color: #343a40;
            color: #fff;
            font-weight: 600;
            border-left-color: #0d6efd;
            /* Highlight active link */
        }

        #sidebar-wrapper .list-group-item i {
            width: 25px;
            /* Align icons */
        }

        /* Navbar & Content */
        #page-content-wrapper {
            width: 100%;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, .05);
        }

        /* Responsive Toggling */
        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }

        @media (min-width: 768px) {
            #sidebar-wrapper {
                margin-left: 0;
            }

            #page-content-wrapper {
                min-width: 0;
                width: 100%;
            }

            #wrapper.toggled #sidebar-wrapper {
                margin-left: -15rem;
            }
        }
    </style>

    @livewireStyles
</head>

<body>

    <div class="d-flex" id="wrapper">

        <div id="sidebar-wrapper">
            <div class="sidebar-heading text-center">
                <i class="fa-solid fa-landmark me-2"></i> Panchayat Admin
            </div>

            <div class="list-group list-group-flush mt-2">
                <a href="{{ route('dashboard') }}"
                    class="list-group-item list-group-item-action {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge"></i> Dashboard
                </a>

                <div class="sidebar-subheading text-muted text-uppercase small fw-bold px-3 mt-3 mb-1">Access Control
                </div>

                <a href="{{ route('admin.users.index') }}"
                    class="list-group-item list-group-item-action {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i> Users
                </a>

                <a href="{{ route('admin.roles.index') }}"
                    class="list-group-item list-group-item-action {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-shield-halved"></i> Roles
                </a>

                <div class="sidebar-subheading text-muted text-uppercase small fw-bold px-3 mt-3 mb-1">Master Data</div>

                <a href="{{ route('admin.states.index') }}"
                    class="list-group-item list-group-item-action {{ request()->routeIs('admin.states.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-map-location-dot"></i> States
                </a>
                <a href="{{ route('admin.districts.index') }}"
                    class="list-group-item list-group-item-action {{ request()->routeIs('admin.districts.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-map-location-dot"></i> Districts
                </a>

                <a href="{{ route('admin.blocks.index') }}"
                    class="list-group-item list-group-item-action {{ request()->routeIs('admin.blocks.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-cubes-stacked"></i> Blocks
                </a>

                <a href="{{ route('admin.panchayats.index') }}"
                    class="list-group-item list-group-item-action {{ request()->routeIs('admin.panchayats.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-gopuram"></i> Panchayats
                </a>

                <div class="sidebar-subheading text-muted text-uppercase small fw-bold px-3 mt-3 mb-1">Services</div>

                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-file-contract"></i> Certificates
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-bullhorn"></i> Complaints
                </a>
            </div>
        </div>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
                <div class="container-fluid">
                    <button class="btn btn-sm btn-outline-secondary" id="sidebarToggle">
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0 align-items-center">

                            <li class="nav-item me-3">
                                <a class="nav-link position-relative" href="#">
                                    <i class="fa-regular fa-bell fa-lg"></i>
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                        style="font-size: 0.6rem;">
                                        3
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                    id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <img class="rounded-circle me-2 border"
                                        style="width:32px; height:32px; object-fit:cover;"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    @else
                                    <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center me-2"
                                        style="width:32px; height:32px; font-size: 14px;">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    @endif
                                    <span class="fw-semibold text-dark">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i class="fa-solid fa-right-from-bracket me-2"></i> Log Out
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
            <div class="bg-white shadow-sm border-bottom py-3">
                <div class="container-fluid">
                    <h5 class="m-0 fw-bold text-dark">{{ $header }}</h5>
                </div>
            </div>
            @endif

            <div class="container-fluid p-4">
                <x-banner />
                {{ $slot }}
            </div>
        </div>
    </div>
    <div id="toast-container"></div>
    @stack('modals')

    @livewireScripts

    <script>
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