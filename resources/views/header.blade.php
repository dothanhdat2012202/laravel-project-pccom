<header id="header" class=" typeheader-1">
    <!-- Header Top -->
    <div class="header-top hidden-compact">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-xs-6 header-logo ">
                    <div class="navbar-logo">
                        <a href="/"><img src="/template/image/catalog/demo/logo/logo-pccom.png" alt="Your Store" width="120" height="40" title="PCCom"></a>
                    </div>
                </div>
                <div class="col-lg-7 header-sevices">
                    <div class="module html--sevices ">
                        <div class="clearfix sevices-menu">
                            <ul>
                                <li class="col-md-4 item home">
                                    <div class="icon"></div>
                                    <div class="text">
                                        <a>Số 17, Ngõ 83 Trần Duy Hưng,</a><a>
                                        </a>
                                        <p><a>Trung Hòa, Cầu Giấy, Hà Nội</a></p>
                                        <a>
                                        </a>
                                    </div>
                                </li>
                                <li class="col-md-4 item mail" style="padding-left: 40px">
                                    <div class="icon" > </div>
                                    <div class="text">
                                        <a class="name" href="#">sales@pccom.com</a>
                                        <p>0396586672</p>
                                    </div>
                                </li>
                                <li class="col-md-4 item delivery">
                                    <div class="icon"> </div>
                                    <div class="text">
                                        <a class="name" href="#">Giao Hàng Miễn Phí</a>
                                        <p>Toàn quốc</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Cart -->
                @include('cart')
                <!-- //Cart -->
            </div>
        </div>
    </div>
    <!-- //Header Top -->
    <!-- Header center -->
    <div class="header-center">
        <div class="container">
            <div class="row">
                <!-- Menuhome -->
                <div class="col-lg-8 col-md-8 col-sm-1 col-xs-3 header-menu">
                    <div class="megamenu-style-dev megamenu-dev">
                        <div class="responsive">
                            <nav class="navbar-default">
                                <div class="container-megamenu horizontal">
                                    <div class="navbar-header">
                                        <button type="button" id="show-megamenu" data-toggle="collapse" class="navbar-toggle">
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                    </div>
                                    <div class="megamenu-wrapper">
                                        <span id="remove-megamenu" class="fa fa-times"></span>
                                        <div class="megamenu-pattern">
                                            <div class="container">
                                                <ul class="megamenu" data-transition="slide" data-animationtime="500">
                                                    <li class="full-width menu-home with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a href="#" class="clearfix">
                                                            <strong>
                                                                Săn Voucher
                                                            </strong>
                                                        </a>
                                                    </li>
                                                    <li class="full-width option2 with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a  class="clearfix">
                                                            <strong>
                                                                Hướng dẫn thanh toán
                                                            </strong>
                                                        </a>
                                                    </li>
                                                    <li class="item-style1 content-full with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a  class="clearfix">
                                                            <strong>
                                                                Video
                                                            </strong>
                                                        </a>
                                                    </li>
                                                    <li class="style-page with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a href="{{ route('search_imei') }}">
                                                            <strong>
                                                                Tra cứu bảo hành
                                                            </strong>
                                                        </a>
                                                    </li>
                                                    <li class="">
                                                        <p class="close-menu"></p>
                                                        <a href="{{ route('blog.index') }}" class="clearfix">
                                                            <strong>
                                                                Tin tức công nghệ
                                                            </strong>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <!--Searchhome-->
                <div class="col-lg-4 col-md-4 col-sm-11 col-xs-9 header-search">
                    <div id="sosearchpro" class="sosearchpro-wrapper so-search">
                        <form method="GET" action="/search" id="search-form">
                            <div id="search0" class="search input-group form-group">
                                <input id="search-input" class="autosearch-input form-control" type="text" value="" size="50" autocomplete="off" placeholder="Bạn muốn tìm gì?" name="search">
                                <span class="input-group-btn">
                        <button type="submit" class="button-search btn btn-default btn-lg" name="submit_search"><i class="fa fa-search"></i><span class="hidden">Search</span></button>
                    </span>
                            </div>
                        </form>
                        <div id="search-results" class="search-results" style="display: none; position: absolute; background: white; z-index: 1000; width: 92%; border: 1px solid #ccc; max-height: 500px; overflow-y: auto">
                            <!-- Kết quả tìm kiếm sẽ được hiển thị ở đây -->
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <!-- //Header center -->
    <div class="header-form hidden-compact">
        <div class="button-header current">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
        </div>
        <div class="dropdown-form toogle_content" >
            <div class="greeting" style="margin-bottom: 10px">
                <span class="text">Xin chào,</span>
                <ul class="dropdown-menu">
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <li class="name"><a href="{{route('my_account')}}" id="name" class="name" title=""><span>{{\Illuminate\Support\Facades\Auth::user()->name}}</span></a></li>
                    @endif
                    <li class="log_out"><a href="{{route('logout_user')}}" class="log_out" title=""><span>Đăng xuất</span></a></li>
                </ul>
            </div>
            </div>

        <div class="button-user">
            <div class="user-info asd">
                <a data-toggle="modal" data-target="#so_sociallogin" href="#">Login</a>
            </div>
        </div>
    </div>
        <!-- Form Đăng nhập & đăng ký  -->
        <div class="modal fade in" id="so_sociallogin" tabindex="-1" role="dialog" aria-hidden="true" >
            <div class="modal-dialog block-popup-login">
                <a href="javascript:void(0)" title="Close" class="close close-login fa fa-times-circle" data-dismiss="modal"></a>
                <div class="tt_popup_login"><strong>Đăng nhập hoặc đăng ký</strong></div>
                <div class="block-content">
                    <div class=" col-reg registered-account">
                        <h2>Đăng nhập ngay!</h2>
                        <img src="/template/image/catalog/demo/logo/logo-pccom.png" alt="LogoPCCOm" style="margin-top: 20px">
                        <a class="btn-reg-popup" title="register" href="{{route('login_user')}}">Đăng nhập</a>
                    </div>
                    <div class="col-reg login-customer">
                        <h2>Đăng ký tài khoản ngay!</h2>
                        <p class="note-reg">Đăng ký miễn phí và dễ dàng</p>
                        <ul class="list-log">
                            <li>Thanh toán dễ dãng</li>
                            <li>Lưu nhiều địa chỉ giao hàng</li>
                            <li>Xem và theo dõi đơn hàng hơn thế nữa</li>
                        </ul>
                        <a class="btn-reg-popup" title="register" href="{{route('register')}}">Tạo tài khoản</a>
                    </div>
                    <div style="clear:both;"></div>
                </div>
            </div>
        </div>
        <!-- //Form Đăng nhập & đăng ký  -->
    </header>

