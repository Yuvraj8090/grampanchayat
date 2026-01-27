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
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
    </body>
</html>
