<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="icon" href="{{asset('/assets/images')}}" type="image/ico" /> --}}

    <title>Game Name</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />

    <!-- Bootstrap -->
    {{-- <link href="{{asset('/assets/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <!-- Custom Theme Style -->
    <link href="{{asset('/assets/css/custom.min.css')}}" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col menu_fixed">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="#" class="site_title"><i class="fa fa-shop text-info"></i> <span>E-commerce</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li><a href="{{route('category@categoryListPage')}}"><i class="fa fa-list"></i> အမျိုးအစားများ </a></li>
                            </ul>
                            <ul class="nav side-menu">
                                <li><a href="{{route('product@productListPage')}}"><i class="fa-sharp fa fa-store"></i> ကုန်ပစ္စည်းများ</a></li>
                            </ul>
                            <ul class="nav side-menu">
                                <li><a href="win_lose_report.html"><i class="fa fa-cart-shopping"></i>အော်ဒါများ</a></li>
                            </ul>
                            <ul class="nav side-menu">
                                <li><a href="win_lose_report.html"><i class="fa fa-users"></i>စီမံသူများ</a></li>
                            </ul>
                            <ul class="nav side-menu">
                                <li><a href="win_lose_report.html"><i class="fa fa-users"></i>အသုံးပြုသူများ</a></li>
                            </ul>
                            <ul class="nav side-menu">
                                <li><a href="win_lose_report.html"><i class="fa fa-comment"></i>အသုံးပြုသူတုံ့ပြန်ချက်များ</a></li>
                            </ul>
                            <ul class="nav side-menu">
                                <li><a href="win_lose_report.html"><i class="fa fa-calculator"></i>စာရင်းချုပ်</a></li>
                            </ul>
                            <ul class="nav side-menu">
                                <li><a href="login.html"><i class="fa fa-right-from-bracket"></i>အကောင့်ထွက်ရန်</a></li>
                            </ul>
                            {{-- <ul class="nav side-menu">
                                <li><a><i class="fa fa-database"></i> Action Log <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="login_IP_log.html">Login Ip Log</a></li>
                                        <li><a href="login_log.html">Login Log</a></li>
                                    </ul>
                                </li>
                            </ul> --}}

                        </div>

                    </div>
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="./assets/images/default.png"> {{Auth::user()->name}}
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="javascript:;"> Profile</a>
                                    <a class="dropdown-item" href="javascript:;">Change password</a>
                                    <a class="dropdown-item" href="javascript:;">Privacy & Policy</a>
                                    <a class="dropdown-item text-danger" href="{{route('auth@logout')}}">Log Out</a>
                                </div>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            @yield('content')
            
        </div>

        <!-- jQuery -->
        <script src="{{asset('/assets/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap -->
        <script src="{{asset('/assets/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <!-- Custom Theme Scripts -->
        <script src="{{asset('/assets/js/custom.min.js')}}"></script>

        @yield('jsContent')
</body>

</html>