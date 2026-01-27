<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (isset($header) && $header)
        {{ $header }} - {{ 'ग्राम पंचायत' }}
        @else
        ग्राम पंचायत
        @endif
    </title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    @vite(['resources/css/app.scss', 'resources/js/app.js'])
<style>
        body {
            font-family: 'Poppins', 'Hind', sans-serif;
            background-color: #f8f9fa;
        }

        /* Top Bar */
        .top-bar {
            background: #f1f1f1;
            font-size: 0.85rem;
            border-bottom: 1px solid #ddd;
        }

        .accessibility-links a {
            color: #333;
            text-decoration: none;
            margin-left: 10px;
        }

        /* Branding Header */
        .brand-header {
            background: #fff;

            border-bottom: 4px solid #ff9933;
            /* Saffron Border */
        }

        .emblem {
            height: 60px;
        }

        /* Navigation */
        .navbar-custom {
            background: #1a4a8d;
            /* Govt Blue */
        }

        .navbar-custom .nav-link {
            color: #fff !important;
            font-weight: 500;
            padding: 12px 15px;
        }

        .navbar-custom .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ff9933 !important;
        }

        /* Marquee / Ticker */
        .news-ticker {
            background: #2c3e50;
            color: #fff;
            padding: 8px 0;
        }

        .ticker-title {
            background: #e74c3c;
            padding: 5px 15px;
            font-weight: bold;
            font-size: 0.9rem;
        }

        /* Hero Section */
        .pradhan-card {
            background: linear-gradient(135deg, #1a4a8d 0%, #2980b9 100%);
            color: white;
            border-radius: 10px;
        }

        /* Stat Cards */
        .stat-card {
            background: #fff;
            border-left: 4px solid #1a4a8d;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            font-size: 2rem;
            color: #ddd;
        }

        /* Sidebar Links */
        .sidebar-box {
            background: #fff;
            border: 1px solid #e9ecef;
            border-top: 3px solid #1a4a8d;
            margin-bottom: 20px;
        }

        .sidebar-title {
            background: #f1f1f1;
            padding: 10px 15px;
            font-weight: 700;
            color: #1a4a8d;
            border-bottom: 1px solid #ddd;
        }

        .sidebar-link {
            display: block;
            padding: 10px 15px;
            color: #444;
            text-decoration: none;
            border-bottom: 1px solid #f8f9fa;
            transition: all 0.2s;
        }

        .sidebar-link:hover {
            background: #e9ecef;
            color: #1a4a8d;
            padding-left: 20px;
        }

        .new-badge {
            font-size: 0.7rem;
            animation: blink 1s infinite;
        }

        @keyframes blink {
            50% {
                opacity: 0;
            }
        }

        /* Footer */
        .footer {
            background: #1b1b1b;
            color: #bbb;
            padding-top: 40px;
            border-top: 5px solid #138808;
            /* Green Border */
        }

        .footer a {
            color: #bbb;
            text-decoration: none;
        }

        .footer a:hover {
            color: #fff;
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
