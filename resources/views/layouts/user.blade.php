    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="{{ asset('css/garam.css') }}" rel="stylesheet">
	<META NAME="Author" CONTENT="Universal Web Solutions">
    <!-- <META NAME="Subject" CONTENT="Bhagvantpur Gram Panchayat, Uttarakhand">
    <META NAME="Description" CONTENT="Welcome to Bhagvantpur gram panchayat. it is a first website of Bhagvantpur gram panchayat. it is made by gram pradhan.  ">
    <META NAME="Keywords" CONTENT="Bhagvantpur Gram Panchayat,Bhagvantpur gram panchayat,Bhagvantpur gram panchayat dehradun ,Bhagvantpur gram panchayat vikasnagar ,uttarakhand gram panchayat,gram panchyat  provide best facility for accomdation"> -->
    <META NAME="Generator" CONTENT="Universal Web Solutions">
    <meta name="google-site-verification" content="{{$user->google}}">
    <!-- <META NAME="Language" CONTENT="English"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
  <div class="container-fluid main_bg">
    <div class="container white">
        <div class="row orange top-most">
            <div class="col-md-6 col-xs-12">
                <ul>
                    <li><a href=""><img src="/images/facebook.png" class="img-responsive"></a></li>
                    <li><a href=""><img src="/images/youtube.png" class="img-responsive"></a></li>
                    <li><a href=""><img src="/images/twitter.png" class="img-responsive"></a></li>
                </ul>
            </div>
            <div class="col-md-6 col-xs-12 top-most-right">
                <a href="{{url('/registers')}}">Register</a> | 
                <a href="{{url('/gram-panchayat-development-works')}}">विकास कार्य</a> | 
                <a href="{{url('/important-information')}}">महत्वपूर्ण जानकारी</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 header-img">
                <h1>{{$user->hindi}} ग्राम पंचायत</h1>
                <span><br/> वर्तमान प्रधान: 
                    @if($name)
                        {{$name->name}}

                    @endif
                    </span>
            </div>
        </div>
        <div class="row">
        <nav class="navbar navbar-default">
            <div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="{{url('/')}}">होम </a></li>
                        <li><a href="{{url('/pradhan-message')}}">प्रधान सन्देश</a></li>
                        <li><a href="{{url('/tourist-place')}}">मुख्य स्थल</a></li>
                        <li><a href="{{url('/gallery')}}">गैलरी </a></li>
                        <li><a href="{{url('/video')}}">वीडियो </a></li>
                        <li><a href="{{url('/panchyat-business')}}">ग्राम्य व्यवसाय</a></li>
                        <li><a href="{{url('/gram-panchayat-leaders')}}">पंचायत प्रतिनिधि</a></li>
                        <li><a href="">वीर महिला / पुरुष</a></li>
                        <li><a href="{{url('/contact-us')}}">संपर्क </a></li>
                    </ul>
                </div>
            </div>
        </nav> 
        </div>
        <div style="min-height:600px;">
@yield('content')
</div>
  <footer class="footer text-center">
            <p>Designed and Developed by: <a href="http://universalwebsolutions.in/" target="_blank"><b>www.universalwebsolutions.in</b></a></p>
            <p>अपनी ग्राम पंचायत को हमसे जोड़ने और ग्राम पंचायत की वेबसाइट बनवाने के लिए सम्पर्क करे ! विकास शर्मा -- +91-9634039666</p>
            <p>अपने बिज़नस, कॉलेज, स्कूल, कोचिंग सेन्टर, फर्म, की वेबसाइट बनवाने के लिए संपर्क करे - +91-9634039666 | +91- 94-1010-2425</p>
        </footer>
    </div>
</div>
<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
//   x[slideIndex-1].style.display = "block";  
}
</script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	@yield('script')
</body>
</html>