<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Cuan Lovers</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/favicon.png')}}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/gijgo.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/slicknav.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/style.css')}}">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a ="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid p-0">
                    <div class="row align-items-center no-gutters">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <a href="{{asset('bootstrap/index.html')}}">
                                    <img src="{{asset('bootstrap/img/logo1.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="{{url('/')}}">home</a></li></li>
                                        @if (Auth::user()) 
                                            <li><a href="{{ url('saldos') }}" class="active">Saldo</a></li>
                                        <li><a href="{{ url('masters') }}">Master</a></li>
                                        <li><a href="{{ url('transaksis') }}">Transaksi</a></li>
                                        <li><a href="#">blog <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="{{asset('bootstrap/blog.html')}}">blog</a></li>
                                                <li><a href="{{asset('bootstrap/single-blog.html')}}">single-blog</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ url('laporan') }}">Laporan</a></li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="log_chat_area d-flex align-items-center">
                                @if (Auth::guest())
                                <a href="#test-form" class="login popup-with-form">
                                    <!-- <i class="flaticon-user"></i> -->
                                    <span> <a href="{{ route('login') }}" style="color:white;">Login</a></span>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span><a href="{{ route('register') }}" style="color:white;">Register</a></span>
                                </a>
                                @else
                                <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"style="color: white;">
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout')}}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="username" value="{{Auth::user()->username}}">
                                        </form>
                                    </li>
                                </ul>
                                </li>
                                @endif
                                <!-- <div class="live_chat_btn">
                                    <a class="boxed_btn_orange" href="#">
                                        <i class="fa fa-phone"></i>
                                        <span>+10 378 467 3672</span>
                                    </a>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <!-- slider_area_start -->
    <div class="slider_area ">
        <div class="single_slider d-flex align-items-center justify-content-center slider_bg_1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                  <h1>Tambah SubMaster</h1>
<div class="container">
  <center>
<form method="post" action="{{url('submasters')}}">
  <table>
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    <input type="hidden" name="user" value="{{Auth::user()->id}}"/>
    <tr>
        <td><font face="Monospace" color="white"><strong style="font-size: 17px;">Master &nbsp;&nbsp;</strong></font></td> 
        <td>
        <select name="select_master"> 
        @foreach($duar as $no => $d)
        <option value="{{$d->id}}">{{$d->id}} - {{$d->nama}}</option>
        @endforeach
        </select>
        </td>
    </tr>
    <tr>
      <td><font face="Monospace" color="white"><strong style="font-size: 17px;">Nama &nbsp;&nbsp;</strong></font></td> 
      <td><input type="text" name="nama_submaster" ></td>
    </tr>
    <tr>
      <td><font face="Monospace" color="white" ><strong style="font-size: 17px;">Jenis Pembayaran &nbsp;&nbsp;</strong></font></td>
      <td><input type="text" name="jenis_pembayaran"></td>
    </tr>
    
  </table>
  <input type="submit" style="font-family: monospace;" name="Simpan" value="Simpan"/>
</form>
</center>
</div>
</td>
          
                </div>
            </div>
        </div>
    </div>
    
    <!-- form itself end-->
    <form id="test-form" class="white-popup-block mfp-hide">
        <div class="popup_box ">
            <div class="popup_inner">
                <div class="logo text-center">
                    <a href="#">
                        <img src="{{asset('bootstrap/img/logo1.png')}}" alt="">
                    </a>
                </div>
                <h3>Sign in</h3>
                <form action="#">
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <input type="email" placeholder="Enter email">
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <input type="password" placeholder="Password">
                        </div>
                        <div class="col-xl-12">
                            <button type="submit" class="boxed_btn_orange">Sign in</button>
                        </div>
                    </div>
                </form>
                <p class="doen_have_acc">Don’t have an account? <a class="dont-hav-acc" href="#test-form2">Sign Up</a>
                </p>
            </div>
        </div>
    </form>
    <!-- form itself end -->

    <!-- form itself end-->
    <form id="test-form2" class="white-popup-block mfp-hide">
        <div class="popup_box ">
            <div class="popup_inner">
                <div class="logo text-center">
                    <a href="#">
                        <img src="{{asset('bootstrap/img/logo1.png')}}" alt="">
                    </a>
                </div>
                <h3>Resistration</h3>
                <form action="#">
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <input type="email" placeholder="Enter email">
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <input type="password" placeholder="Password">
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <input type="Password" placeholder="Confirm password">
                        </div>
                        <div class="col-xl-12">
                            <button type="submit" class="boxed_btn_orange">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </form>
    <!-- form itself end -->


    <!-- JS here -->
    <script src="{{asset('bootstrap/js/vendor/modernizr-3.5.0.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/ajax-form.js')}}"></script>
    <script src="{{asset('bootstrap/js/waypoints.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/scrollIt.js')}}"></script>
    <script src="{{asset('bootstrap/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/wow.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/nice-select.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/jquery.slicknav.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/plugins.js')}}"></script>
    <script src="{{asset('bootstrap/js/gijgo.min.js')}}"></script>

    <!--contact js-->
    <script src="{{asset('bootstrap/js/contact.js')}}"></script>
    <script src="{{asset('bootstrap/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/jquery.form.js')}}"></script>
    <script src="{{asset('bootstrap/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/mail-script.js')}}"></script>

    <script src="{{asset('bootstrap/js/main.js')}}"></script>
</body>

</html>


