<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8" />
    <title>Dashboard | Gram Panchayat </title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/MoneAdmin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--END GLOBAL STYLES -->
</head>

    <!-- END HEAD -->

    <!-- BEGIN BODY -->
<body class="padTop53 " >

    <!-- MAIN WRAPPER -->
    <div id="wrap" >
        

        <!-- HEADER SECTION -->
        <div id="top">

            <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="fa fa-align-justify"></i>
                </a>
                <!-- LOGO SECTION -->
                <header class="navbar-header">

                    <a href="" class="navbar-brand">
                        Garam Panchayat
                        
                        </a>
                </header>
                <!-- END LOGO SECTION -->
                <ul class="nav navbar-top-links navbar-right">

                    <!--ADMIN SETTINGS SECTIONS -->

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user "></i> {{Auth::user()->name}}&nbsp; <i class="fa fa-angle-down "></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
                            <!--<li><a href="#"><i class="fa fa-user"></i> User Profile </a>-->
                            <!--</li>-->
                            <li><a href="{{ url('/setting') }}"><i class="fa fa-gear"></i> Settings </a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                            </form>
                            </li>
                        </ul>

                    </li>
                    <!--END ADMIN SETTINGS -->
                </ul>

            </nav>

        </div>
        <!-- END HEADER SECTION -->



        <!-- MENU SECTION -->
      <div id="left" >
            <div class="media user-media well-small">
                <div class="media-body">
                    
                    <h5 class="media-heading" style="font-size:15px;padding:5px;"><a href="{{url('/')}}" target="_
                    blank">View Website</a></h5>
                   
                    <ul class="list-unstyled user-info">
                        
                        <li>
                             <a class="btn btn-success btn-xs btn-circle" style="width: 10px;height: 12px;"></a> Online
                           
                        </li>
                       
                    </ul>
                </div>
                <br />
            </div>

            <ul id="menu" class="collapse">

                @if(Auth::user()->role->name == 'Admin')

                <li class="panel active">
                    <a href="{{url('/admin')}}" >
                        <i class="icon-table"></i> Dashboard
                    </a>                   
                </li>

                <li class="panel">
                    <a href="{{route('admin-user.index')}}" >
                        <i class="icon-table"></i> Gram Panchayats
                    </a>                   
                </li>
                
                <li class="panel">
                    <a href="{{route('important.index')}}" >
                        <i class="icon-table"></i> Important Page
                    </a>                   
                </li>
                
                  <li class="panel">
                    <a href="{{route('jan-partinidhi.index')}}" >
                        <i class="icon-table"></i> Panchayat Parti-Nidhi
                    </a>                   
                </li>
                
                  <li class="panel">
                    <a href="{{route('bravee.index')}}" >
                        <i class="icon-table"></i> Brave Men
                    </a>                   
                </li>


                @else
                
                <li class="panel active">
                    <a href="{{url('/dashboard')}}" >
                        <i class="fa fa-dashboard fa-fw"></i> Dashboard
                    </a>                   
                </li>

                <li><a href="{{route('user-media.index')}}"><i class="fa fa-picture-o fa-fw"></i> Slider Images </a></li>
                <li><a href="{{route('user-introduction.index')}}"><i class="fa fa-table fa-fw"></i> परिचय </a></li>
                <li><a href="{{route('user-facts.index')}}"><i class="fa fa-table fa-fw"></i> मुख्य तथ्य </a></li>
                <li><a href="{{route('user-p-message.index')}}"><i class="fa fa-table fa-fw"></i> प्रधान सन्देश </a></li>
                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                        <i class="fa fa-tasks fa-fw"> </i> जनप्रतिनिधि      
       
                        <span class="pull-right">
                          <i class="fa fa-angle-left"></i>
                        </span>
                       
                    </a>
                    <ul class="collapse" id="component-nav">
                       
                        <li class=""><a href="{{route('user-list.index')}}"><i class="fa fa-angle-right fa-fw"></i> पंचायत स्तर </a></li>
                         <!-- <li class=""><a href="icon.html"><i class="fa fa-angle-right fa-fw"></i> ब्लॉक स्तर  </a></li>
                        <li class=""><a href="progress.html"><i class="fa fa-angle-right fa-fw"></i> जनपद स्तर  </a></li>
                        <li class=""><a href="tabs_panels.html"><i class="fa fa-angle-right fa-fw"></i> राज्य  स्तर  </a></li> -->
                    </ul>
                </li>
                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav">
                        <i class="fa fa-pencil fa-fw"></i> संपर्क 
       
                        <span class="pull-right">
                            <i class="fa fa-angle-left"></i>
                        </span>
                         
                    </a>
                    <ul class="collapse" id="form-nav">
                        <li class=""><a href="{{route('user-address.index')}}"><i class="fa fa-angle-right fa-fw"></i> पता  </a></li>
                        <li class=""><a href="{{route('user-location.index')}}"><i class="fa fa-angle-right fa-fw"></i> जाने का साधन </a></li>
                    </ul>
                </li>
                <li><a href="{{route('user-work.index')}}"><i class="fa fa-table fa-fw"></i> विकास कार्य  </a></li>
                <li class="panel">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#DDL-nav">
                        <i class="fa fa-sitemap fa-fw"></i> मुख्य स्थल
       
                        <span class="pull-right">
                            <i class="fa fa-angle-left"></i>
                        </span>
                    </a>
                    <ul class="collapse" id="DDL-nav">
                        <li><a href="{{route('user-places-intro.index')}}"><i class="fa fa-angle-right fa-fw"></i> परिचय </a></li>
                        <li><a href="{{route('user-places.index')}}"><i class="fa fa-angle-right fa-fw"></i>  मुख्य स्थल  </a></li>
                    </ul>
                </li>
                <li class="panel">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#error-nav">
                        <i class="fa fa-sitemap fa-fw"></i>  ग्राम्य व्यवसाय 
       
                        <span class="pull-right">
                            <i class="fa fa-angle-left"></i>
                        </span>
                         
                    </a>
                    <ul class="collapse" id="error-nav">
                        <li><a href="{{route('user-business-intro.index')}}"><i class="fa fa-angle-right fa-fw"></i> परिचय  </a></li>
                        <li><a href="{{route('user-business.index')}}"><i class="fa fa-angle-right fa-fw"></i>  ग्राम्य व्यवसाय   </a></li>
                    </ul>
                </li>
                
                 <li><a href="{{route('user-gallery.index')}}"><i class="fa fa-table fa-fw"></i> Gallery  </a></li>
                 <li><a href="{{route('user-video.index')}}"><i class="fa fa-video-camera fa-fw"></i> Videos  </a></li>
                  <li><a onclick="alert('Coming Soon')"><i class="fa fa-table fa-fw"></i> Send Message</a></li>
                   <li><a href="{{route('user-email.index')}}"><i class="fa fa-table fa-fw"></i> Send Email  </a></li>
                   
                     <li><a href="{{route('govtfacility.index')}}"><i class="fa fa-table fa-fw"></i> Govt Facilities  </a></li>
                 

            <!--  <li><a href="latest_news.php"><i class="fa fa-table fa-fw"></i> ताजा खबरे   </a></li>
             <li><a href="running_programme.php"><i class="fa fa-table fa-fw"></i> Running योजनाए </a></li>
             
              <li><a href="jobs.php"><i class="fa fa-table fa-fw"></i> नौकरियों  </a></li> -->
            
              @endif

            </ul>

        </div>
        <!--END MENU SECTION -->



        <!--PAGE CONTENT -->
        <div @if(auth()->user()->role_id == 1) style="width:80%;" @endif id="content">
             
            <div class="inner" style="min-height: 700px;">
                @yield('content')
                
            </div>

        </div>
        
        
        @if(auth()->user()->role_id != 1)
        <!--END PAGE CONTENT -->
        <!-- RIGHT STRIP  SECTION -->
        <div id="right">

        
        <a href="http://dsom.in/"><img src="/images/dsom.jpg" height="680px" width="200px">  </a>          
         

        </div>
         <!-- END RIGHT STRIP  SECTION -->
         @endif
        
    </div>

    <!--END MAIN WRAPPER -->

    <!-- FOOTER -->
    <div id="footer">
        <p> &copy;  ग्राम पंचायत &nbsp;
            2014-<?php echo date('Y'); ?> <br>
            Design & Developed by <a href="">United Human Foundation</a>
        </p>
     
    </div>
    <!--END FOOTER -->


    <!-- GLOBAL SCRIPTS -->
    <script src="{{ asset('js/jquery-2.0.3.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/modernizr-2.6.2-respond-1.1.0.min.js') }}"></script>
    <!-- END GLOBAL SCRIPTS -->

@yield('script')

</body>

    <!-- END BODY -->
</html>
