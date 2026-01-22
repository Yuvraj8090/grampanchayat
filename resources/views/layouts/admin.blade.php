<!DOCTYPE html>
<html lang="en"> <head>
    <meta charset="UTF-8" />
    <title>Dashboard | Gram Panchayat</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/MoneAdmin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="padTop53">

    <div id="wrap">

        <div id="top">
            <nav class="navbar navbar-inverse navbar-fixed-top" style="padding-top: 10px;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="fa fa-align-justify"></i>
                </a>
                <header class="navbar-header">
                    <a href="{{ url('/') }}" class="navbar-brand">
                        Gram Panchayat
                    </a>
                </header>
                
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user"></i> {{ Auth::user()->name }}&nbsp; <i class="fa fa-angle-down"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a href="{{ url('/setting') }}"><i class="fa fa-gear"></i> Settings </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
        <div id="left">
            <div class="media user-media well-small">
                <div class="media-body">
                    <h5 class="media-heading" style="font-size:15px;padding:5px;">
                        <a href="{{ url('/') }}" target="_blank">View Website</a>
                    </h5>
                    <ul class="list-unstyled user-info">
                        <li>
                            <a class="btn btn-success btn-xs btn-circle" style="width: 10px;height: 12px;"></a> Online
                        </li>
                    </ul>
                </div>
                <br />
            </div>

            <ul id="menu" class="collapse">

                {{-- ADMIN MENU --}}
                @if(Auth::user()->role->name == 'Admin')

                    <li class="panel {{ Request::is('admin*') ? 'active' : '' }}">
                        <a href="{{ url('/admin') }}">
                            <i class="icon-table"></i> Dashboard
                        </a>
                    </li>

                    <li class="panel {{ Route::is('admin-user.*') ? 'active' : '' }}">
                        <a href="{{ route('admin-user.index') }}">
                            <i class="icon-table"></i> Gram Panchayats
                        </a>
                    </li>

                    <li class="panel {{ Route::is('important.*') ? 'active' : '' }}">
                        <a href="{{ route('important.index') }}">
                            <i class="icon-table"></i> Important Page
                        </a>
                    </li>

                    <li class="panel {{ Route::is('jan-partinidhi.*') ? 'active' : '' }}">
                        <a href="{{ route('jan-partinidhi.index') }}">
                            <i class="icon-table"></i> Panchayat Parti-Nidhi
                        </a>
                    </li>

                    <li class="panel {{ Route::is('bravee.*') ? 'active' : '' }}">
                        <a href="{{ route('bravee.index') }}">
                            <i class="icon-table"></i> Brave Men
                        </a>
                    </li>

                {{-- USER MENU --}}
                @else

                    <li class="panel {{ Request::is('dashboard') ? 'active' : '' }}">
                        <a href="{{ url('/dashboard') }}">
                            <i class="fa fa-dashboard fa-fw"></i> Dashboard
                        </a>
                    </li>

                    <li class="{{ Route::is('user-media.*') ? 'active' : '' }}">
                        <a href="{{ route('user-media.index') }}"><i class="fa fa-picture-o fa-fw"></i> Slider Images</a>
                    </li>
                    
                    <li class="{{ Route::is('user-introduction.*') ? 'active' : '' }}">
                        <a href="{{ route('user-introduction.index') }}"><i class="fa fa-table fa-fw"></i> परिचय</a>
                    </li>
                    
                    <li class="{{ Route::is('user-facts.*') ? 'active' : '' }}">
                        <a href="{{ route('user-facts.index') }}"><i class="fa fa-table fa-fw"></i> मुख्य तथ्य</a>
                    </li>
                    
                    <li class="{{ Route::is('user-p-message.*') ? 'active' : '' }}">
                        <a href="{{ route('user-p-message.index') }}"><i class="fa fa-table fa-fw"></i> प्रधान सन्देश</a>
                    </li>

                    {{-- DROPDOWN: JANPRATINIDHI --}}
                    @php 
                        $isJanpratinidhiActive = Route::is('user-list.*'); 
                    @endphp
                    <li class="panel {{ $isJanpratinidhiActive ? 'active' : '' }}">
                        <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                            <i class="fa fa-tasks fa-fw"></i> जनप्रतिनिधि
                            <span class="pull-right"><i class="fa fa-angle-left"></i></span>
                        </a>
                        <ul class="collapse {{ $isJanpratinidhiActive ? 'in' : '' }}" id="component-nav">
                            <li class="{{ Route::is('user-list.*') ? 'active' : '' }}">
                                <a href="{{ route('user-list.index') }}"><i class="fa fa-angle-right fa-fw"></i> पंचायत स्तर</a>
                            </li>
                        </ul>
                    </li>

                    {{-- DROPDOWN: CONTACT --}}
                    @php 
                        $isContactActive = Route::is('user-address.*') || Route::is('user-location.*'); 
                    @endphp
                    <li class="panel {{ $isContactActive ? 'active' : '' }}">
                        <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle {{ $isContactActive ? '' : 'collapsed' }}" data-target="#form-nav">
                            <i class="fa fa-pencil fa-fw"></i> संपर्क
                            <span class="pull-right"><i class="fa fa-angle-left"></i></span>
                        </a>
                        <ul class="collapse {{ $isContactActive ? 'in' : '' }}" id="form-nav">
                            <li class="{{ Route::is('user-address.*') ? 'active' : '' }}">
                                <a href="{{ route('user-address.index') }}"><i class="fa fa-angle-right fa-fw"></i> पता</a>
                            </li>
                            <li class="{{ Route::is('user-location.*') ? 'active' : '' }}">
                                <a href="{{ route('user-location.index') }}"><i class="fa fa-angle-right fa-fw"></i> जाने का साधन</a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{ Route::is('user-work.*') ? 'active' : '' }}">
                        <a href="{{ route('user-work.index') }}"><i class="fa fa-table fa-fw"></i> विकास कार्य</a>
                    </li>

                    {{-- DROPDOWN: PLACES --}}
                    @php 
                        $isPlacesActive = Route::is('user-places-intro.*') || Route::is('user-places.*'); 
                    @endphp
                    <li class="panel {{ $isPlacesActive ? 'active' : '' }}">
                        <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#DDL-nav">
                            <i class="fa fa-sitemap fa-fw"></i> मुख्य स्थल
                            <span class="pull-right"><i class="fa fa-angle-left"></i></span>
                        </a>
                        <ul class="collapse {{ $isPlacesActive ? 'in' : '' }}" id="DDL-nav">
                            <li class="{{ Route::is('user-places-intro.*') ? 'active' : '' }}">
                                <a href="{{ route('user-places-intro.index') }}"><i class="fa fa-angle-right fa-fw"></i> परिचय</a>
                            </li>
                            <li class="{{ Route::is('user-places.*') ? 'active' : '' }}">
                                <a href="{{ route('user-places.index') }}"><i class="fa fa-angle-right fa-fw"></i> मुख्य स्थल</a>
                            </li>
                        </ul>
                    </li>

                    {{-- DROPDOWN: BUSINESS --}}
                    @php 
                        $isBusinessActive = Route::is('user-business-intro.*') || Route::is('user-business.*'); 
                    @endphp
                    <li class="panel {{ $isBusinessActive ? 'active' : '' }}">
                        <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#error-nav">
                            <i class="fa fa-sitemap fa-fw"></i> ग्राम्य व्यवसाय
                            <span class="pull-right"><i class="fa fa-angle-left"></i></span>
                        </a>
                        <ul class="collapse {{ $isBusinessActive ? 'in' : '' }}" id="error-nav">
                            <li class="{{ Route::is('user-business-intro.*') ? 'active' : '' }}">
                                <a href="{{ route('user-business-intro.index') }}"><i class="fa fa-angle-right fa-fw"></i> परिचय</a>
                            </li>
                            <li class="{{ Route::is('user-business.*') ? 'active' : '' }}">
                                <a href="{{ route('user-business.index') }}"><i class="fa fa-angle-right fa-fw"></i> ग्राम्य व्यवसाय</a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{ Route::is('user-gallery.*') ? 'active' : '' }}">
                        <a href="{{ route('user-gallery.index') }}"><i class="fa fa-table fa-fw"></i> Gallery</a>
                    </li>
                    <li class="{{ Route::is('user-video.*') ? 'active' : '' }}">
                        <a href="{{ route('user-video.index') }}"><i class="fa fa-video-camera fa-fw"></i> Videos</a>
                    </li>
                    <li>
                        <a onclick="alert('Coming Soon')" style="cursor: pointer;"><i class="fa fa-table fa-fw"></i> Send Message</a>
                    </li>
                    <li class="{{ Route::is('user-email.*') ? 'active' : '' }}">
                        <a href="{{ route('user-email.index') }}"><i class="fa fa-table fa-fw"></i> Send Email</a>
                    </li>
                    <li class="{{ Route::is('govtfacility.*') ? 'active' : '' }}">
                        <a href="{{ route('govtfacility.index') }}"><i class="fa fa-table fa-fw"></i> Govt Facilities</a>
                    </li>

                @endif
            </ul>
        </div>
        <div @if(auth()->user()->role_id == 1) style="width:80%;" @endif id="content">
            <div class="inner" style="min-height: 700px;">
                @yield('content')
            </div>
        </div>

        @if(auth()->user()->role_id != 1)
        <div id="right">
            <a href="http://dsom.in/">
                <img src="/images/dsom.jpg" style="height: 680px; width: 100%; object-fit: cover;">
            </a>
        </div>
        @endif

    </div>
    <div id="footer">
        <p> &copy; ग्राम पंचायत &nbsp; 2014-{{ date('Y') }} <br>
            Design & Developed by <a href="">United Human Foundation</a>
        </p>
    </div>
    <script src="{{ asset('js/jquery-2.0.3.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/modernizr-2.6.2-respond-1.1.0.min.js') }}"></script>
    @yield('script')

</body>
</html>