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
                                        <li><a href="{{ url('masters') }}">Master</a></li>
                                        <li><a href="{{ url('transaksis') }}">Transaksi</a></li>
                                        <li><a href="#">blog <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="{{asset('bootstrap/blog.html')}}">blog</a></li>
                                                <li><a href="{{asset('bootstrap/single-blog.html')}}">single-blog</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ url('laporan') }}" class="active" >Laporan</a></li>
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
                    <div class="container">
                <h1> 
                    Semua Laporan Transaksi
                </h1>
                <form method="post" action="{{url('tampil')}}">
                <!--ini kategoris method post kategoris.store liat di php artisan route:list
                    liat dia ke fungsi mana disana-->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <h3 style = "color: white">
                    Lihat laporan berdasarkan waktu
                <table>
                
                <tr>
                    <td>Tanggal awal: </td>
                    <td><input type="date" name="tanggal_awal"></td>
                </tr>
                <tr>
                    <td>Tanggal akhir: </td>
                    <td><input type="date" name="tanggal_akhir"></td>
                </tr>
                
            </table>
            <h3 style = "text-align:center">
                <input type="submit" name="cari" value="Cari"/>
                <br>
            </h3>
            
            </form>
                <br>
                @if (session('pesan'))
                <div style="background-color: green; color: white;
                    font-weight: bold;">
                    {{session('pesan')}}
                </div>
                @endif
                @if(count($hasilTransaksi)>0)
                <table border="1">
                    <tr>
                        <th>No</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Saldo</th>
                        <th>Jenis Trasaksi</th>
                        <th>Nama Transaksi</th>
                        <th>Gambar</th>
                        <th>Tanggal Create</th>
                    </tr>
                    
                        @foreach ($hasilTransaksi as $no=>$transaksi)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td>{{ $transaksi->jumlah }}</td>
                            <td>{{ $transaksi->keterangan }}</td>
                            @foreach($hasilSaldo as $saldo)
                                @if($transaksi->saldo_id==$saldo->id)
                                <td>{{$saldo->nama}}</td>
                                <!-- sudah dapet objek barang tinggal ambil yg mau ditampilin-->
                                @endif
                            @endforeach
                            @foreach($hasilMaster as $master)
                                @if($transaksi->master_id==$master->id)
                                <td>{{$master->jenis}}</td>
                                <td>{{$master->nama}}</td>
                                <!-- sudah dapet objek barang tinggal ambil yg mau ditampilin-->
                                @endif
                            @endforeach
                                    <td><img width="150px" src="{{url('/data_file/'.$transaksi->nama_gambar)}}"></td>
                            <td>{{ strftime('%Y-%m-%d',
                                     strtotime($transaksi->created_at)) }}</td>
                        </tr>
                        @endforeach
                    @else
                        </table>
                        Transaksimu belum ada tambah transaksi yuk!
                    @endif
                </table>
                
                </h3>
                
            </div>
                </div>
            </div>
            
            
        
            
            
        </div>
    </div>

    <div id='chartPengeluaran'>
                </div>
    <!-- slider_area_end -->

    <!-- about_area_start -->
    
    <!-- about_area_end -->

    <!-- popular_courses_start -->
   
    <!-- popular_courses_end-->


    <!-- testimonial_area_start -->
    
    <!-- testimonial_area_end -->

    <!-- our_courses_start -->
    
    <!-- subscribe_newsletter_end -->

    <!-- our_latest_blog_start -->
    
    <!-- our_latest_blog_end -->


    <!-- footer -->
    <footer class="footer footer_bg_1">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-lg-4">
                        <div class="footer_widget">
                            <div class="footer_logo">
                                <a href="#">
                                    <img src="{{asset('bootstrap/img/logo1.png')}}" alt="">
                                </a>
                            </div>
                            <p>
                                Firmament morning sixth subdue darkness creeping gathered divide our let god moving.
                                Moving in fourth air night bring upon it beast let you dominion likeness open place day
                                great.
                            </p>
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-twitter-alt"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-youtube-play"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-2 offset-xl-1 col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Courses
                            </h3>
                            <ul>
                                <li><a href="#">Wordpress</a></li>
                                <li><a href="#"> Photoshop</a></li>
                                <li><a href="#">Illustrator</a></li>
                                <li><a href="#">Adobe XD</a></li>
                                <li><a href="#">UI/UX</a></li>
                            </ul>

                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Resourches
                            </h3>
                            <ul>
                                <li><a href="#">Free Adobe XD</a></li>
                                <li><a href="#">Tutorials</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#"> About</a></li>
                                <li><a href="#"> Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Address
                            </h3>
                            <p>
                                200, D-block, Green lane USA <br>
                                +10 367 467 8934 <br>
                                edumark@contact.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer -->


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
    @section('footer')
            <script src="https://code.highcharts.com/highcharts.js"></script>  
            <script>
            Highcharts.chart('chartPengeluaran', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Pengeluaran'
            },
            subtitle: {
                text: 'Source: WorldClimate.com'
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Tokyo',
                data: [49.9, 71.5]
            }]
        });
        </script>
        @stop
                                
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
    @yield('footer')
</body>

</html>

