<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gram Panchayat Admin') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
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
            background-color: #212529; /* Dark Sidebar */
            color: white;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 1.5rem 1.25rem; /* Matches Navbar height roughly */
            font-size: 1.2rem;
            font-weight: bold;
            border-bottom: 1px solid #444;
        }

        #sidebar-wrapper .list-group {
            width: 15rem;
        }

        #sidebar-wrapper .list-group-item {
            background-color: #212529;
            color: #ddd;
            border: none;
            padding: 1rem 1.25rem;
        }

        #sidebar-wrapper .list-group-item:hover {
            background-color: #343a40;
            color: #fff;
            cursor: pointer;
        }

        #sidebar-wrapper .list-group-item.active {
            background-color: #0d6efd; /* Bootstrap Primary */
            color: #fff;
            font-weight: 600;
        }

        /* Wrapper Toggling */
        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }

        /* Navbar Styling */
        #page-content-wrapper {
            width: 100%;
        }
        
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }

        /* Responsive Toggling */
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

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body>

    <div class="d-flex" id="wrapper">
        <div class="border-end" id="sidebar-wrapper">
            <div class="sidebar-heading text-center">
                <i class="fa-solid fa-landmark me-2"></i> Panchayat Admin
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge me-2"></i> Dashboard
                </a>
                
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-users me-2"></i> Residents/Population
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-file-contract me-2"></i> Certificates
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-hand-holding-dollar me-2"></i> Schemes & Funds
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-bullhorn me-2"></i> Complaints
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-user-tie me-2"></i> Staff Management
                </a>
            </div>
        </div>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-outline-secondary" id="sidebarToggle">
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0 align-items-center">
                            
                            <li class="nav-item">
                                <a class="nav-link position-relative me-3" href="#">
                                    <i class="fa-regular fa-bell fa-lg"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                        3
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <img class="rounded-circle me-2" style="width:32px; height:32px; object-fit:cover;" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    @else
                                        <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center me-2" style="width:32px; height:32px;">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <span>{{ Auth::user()->name }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                                    <div class="dropdown-divider"></div>
                                    
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); this.closest('form').submit();">
                                            <i class="fa-solid fa-right-from-bracket me-2"></i> Log Out
                                        </a>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            @if (isset($header))
                <div class="container-fluid py-3 bg-light border-bottom">
                    <h4 class="m-0">{{ $header }}</h4>
                </div>
            @endif

            <div class="container-fluid p-4">
                <x-banner /> {{ $slot }}
            </div>
        </div>
    </div>

    @stack('modals')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
    
    @livewireScripts
</body>
</html>