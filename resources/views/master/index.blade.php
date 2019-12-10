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
                                            <li><a href="{{ url('saldos') }}">Saldo</a></li>
                                        <li><a href="{{ url('masters') }}"class="active">Master</a></li>
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
                   <h1> 
                       Daftar Master 
                       <br>
                       <a href="{{ url('masters/create')}}">[Tambah Master]</a>

                    </h1>
                    <br>
                    <h4>@if (session('pesan'))
                        <div style="color: white;
                            font-weight: bold;">
                            {{session('pesan')}}
                        </div>
                       @endif
                    </h4>
                </div>
        @if(sizeof($hasilMaster)!=0)
        <div class="container2">
            <center>
        <table border="1" style="font-family: cursive;color: pink;">
            <tr>
                <th>No</th>
                <th>Id Master</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Aksi</th>
            </tr>
            
                @foreach ($hasilMaster as $no=>$master)
                <tr>
                    <td>{{ $no+1 }}</td>
                    <td>{{ $master->id }}</td>
                    <td>{{ $master->nama }}</td>
                    <td>{{ $master->jenis }}</td>
                    <td><a href="{{url('masters/'.$master->id.'/edit')}}" style="font-family: cursive;color: pink;">[Ubah]</a>
                    <form method="POST" action="{{url('masters/'.$master->id)}}" id="form-hapus-{{ $master->id }}">
                        <input type="hidden" name="user" value= "{{Auth::user()->id}}"/>
                    {{method_field('DELETE')}}
                    {{csrf_field()}}
                    <a href="#" onclick="document.getElementById('form-hapus-{{ $master->id }}').submit()"
                        style="font-family: cursive;color: pink;">[Hapus]</a> <br>
                    <a href="{{url('submasters/create')}}" style="font-family: cursive;color: pink;">[Tambah Submaster]</a></td>
                </tr>
                </form>
                 <center><th colspan="3" >Nama Submaster</th></center>
                 <th>Jenis Pembayaran</th>
                 <th>Aksi</th>
                @foreach($master->submasters as $submaster)
                <tr>

                    <td colspan="3">{{$submaster->nama}}</td>
                     <!-- sudah dapet objek barang tinggal ambil yg mau ditampilin-->
                     <td>{{$submaster->pembayaran}}</td>
                     <td>
                         <a href="{{url('submasters/'.$submaster->id.'/edit')}}" style="font-family: cursive;color: pink;">[Ubah]</a>
                    <form method="POST" action="{{url('submasters/'.$submaster->id)}}" id="form-hapus-{{ $submaster->id }}">
                        <input type="hidden" name="user" value= "{{Auth::user()->id}}"/>
                    {{method_field('DELETE')}}
                    <br>
                    {{csrf_field()}}
                    <a href="#" onclick="document.getElementById('form-hapus-{{ $submaster->id }}').submit()"
                        style="font-family: cursive;color: pink;">[Hapus]</a>
                     </td>
                 </tr>
                @endforeach
                @endforeach
               
                </table>
                </center>
                </div>
        @else
        Data gaada
        @endif  
                </div>
            </div>
        </div>
    </div>

  

    
    


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


