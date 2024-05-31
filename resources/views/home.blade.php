<div id="content">
    <!-- Thông báo tạo tài khoản-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Kiểm tra xem có thông báo nào không
            @if(session('success'))
            // Nếu có, hiển thị hộp thoại thông báo thành công
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 5000 // Thời gian hiển thị (5 giây trong ví dụ này)
            });
            @endif

            @if(session('error'))
            // Nếu có, hiển thị hộp thoại thông báo thất bại
            Swal.fire({
                icon: 'error',
                title: 'Thất bại!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 5000 // Thời gian hiển thị (5 giây trong ví dụ này)
            });
            @endif
        });
    </script>
    <!-- //Thông báo tạo tài khoản-->
    <div class="so-page-builder">
        <!-- Đây là phần menu -->
        <div class="container page-builder-ltr" >
            <div class="row row_a90w  row-style ">
                <!-- Menu Trái-->
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col_vnxd  menu-left">
                    <div class="row row_f8gy  ">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_gafz col-style megamenu-style-dev megamenu-dev">
                            <div class="responsive">
                                <div class="so-vertical-menu no-gutter">
                                    <nav class="navbar-default">
                                        <div class=" container-megamenu  container   vertical  ">
                                            <div id="menuHeading">
                                                <div class="megamenuToogle-wrapper">
                                                    <div class="megamenuToogle-pattern">
                                                        <div class="container">
                                                            <span class="title-mega">
                                                                Danh Mục
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="navbar-header">
                                                <span class="title-navbar hidden-lg hidden-md">  Danh Mục  </span>
                                                <button type="button" id="show-verticalmenu" data-toggle="collapse" class="navbar-toggle">
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                </button>
                                            </div>
                                            <div class="vertical-wrapper">
                                                <span id="remove-verticalmenu" class="fa fa-times"></span>
                                                <div class="megamenu-pattern">
                                                    <div class="container">
                                                        <ul class="megamenu" data-transition="slide" data-animationtime="300">
                                                            @foreach($menus as $menu)
                                                                <li class="item-vertical  vertical-style2 with-sub-menu hover">
                                                                    <p class="close-menu"></p>
                                                                    <a  href="/danh-muc/{{$menu->id}}-{{\Str::slug($menu->name, '-') }}.html" class="clearfix">
                                                                    <span>
                                                                        {{ $menu->name}}
                                                                    </span>
                                                                        <b class="fa fa-caret-right"></b>
                                                                    </a>
                                                                    <div class="sub-menu" data-subwidth="100">
                                                                        <div class="content" >
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="html item-1">
                                                                                        <div class="row" style="padding-left: 20px">
                                                                                            <div class="col-lg-7 col-md-7 col-sm-8">
                                                                                                <ul>
                                                                                                    @foreach($menu->childrenMenu as $childMenu)
                                                                                                        <li>
                                                                                                            <a href="#" title="{{$childMenu->name}}">{{ $childMenu->name }}</a>
                                                                                                        </li>
                                                                                                    @endforeach
                                                                                                </ul>
                                                                                            </div>
                                                                                            <div class="img-banner col-lg-5 col-md-5 col-sm-4">
                                                                                                <a href="#"><img src="/template/image/catalog/demo/menu/img-static-megamenu-h.jpg" alt="banner"></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                            <li class="loadmore"><i class="fa fa-plus-square"></i><span class="more-view">Tất cả danh mục</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--- SLider Phải-->
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col_anla  slider-right">
                    <div class="row row_ci4f  ">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_dg1b block block_1">
                            <div class="module sohomepage-slider so-homeslider-ltr  ">
                                <div class="modcontent">
                                    <div id="sohomepage-slider1">
                                        <div class="so-homeslider yt-content-slider full_slider owl-drag" data-rtl="yes" data-autoplay="yes" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column00="1" data-items_column0="1" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="yes" data-pagination="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
                                            @foreach($sliders as $slider)
                                                <div class="item" >
                                                    <a href="{{$slider->url}}" title="slide 1 - 1" target="_self">
                                                        <img class="responsive" src="{{$slider->thumb}}" alt="slide 1 - 1" style="border-radius: 10px">
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_hmsd block block_2">
                            <div class="home1-banner-1 clearfix">
                                <div class="item-1 col-lg-6 col-md-4 col-sm-6 banners">
                                    <div>
                                        <a title="Static Image" href="#"><img src="/template/image/catalog/demo/banners/home1/banner-left.jpg" alt="Static Image" style="border-radius: 10px"></a>
                                    </div>
                                </div>
                                <div class="item-2 col-lg-6 col-md-4 col-sm-6 banners">
                                    <div>
                                        <a title="Static Image" href="#"><img src="/template/image/catalog/demo/banners/home1/banner-right.jpg" alt="Static Image" style="border-radius: 10px"></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--- Hiển thị 4 ảnh dưới-->
                <div class="container-fluid">
                    <div class="row flex-nowrap">
                        <div class="col-xl-3 col-lg-3 col-md-7 col-sm-7 col-7">
                            <div class="banner-box fade-box" data-banner-page="Homepage" data-banner-loc="Sub Banner_1">
                                <a class="aspect-ratio" href="#" aria-label="Gaming Gear" title="Gaming Gear">
                                    <picture>
                                        <img data-sizes="auto" class="lazyload" src="/template/image/catalog/demo/menuhome/home1.png" alt="Ảnh banner 1" style="border-radius: 10px">
                                    </picture>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-7 col-sm-7 col-7">
                            <div class="banner-box fade-box" data-banner-page="Homepage" data-banner-loc="Sub Banner_1">
                                <a class="aspect-ratio" href="#" aria-label="Gaming Gear" title="Gaming Gear">
                                    <picture>
                                        <img data-sizes="auto" class="lazyload" src="/template/image/catalog/demo/menuhome/home2.png" alt="Ảnh banner 2" style="border-radius: 10px">
                                    </picture>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-7 col-sm-7 col-7">
                            <div class="banner-box fade-box" data-banner-page="Homepage" data-banner-loc="Sub Banner_1">
                                <a class="aspect-ratio" href="#" aria-label="Gaming Gear" title="Gaming Gear">
                                    <picture>
                                        <img data-sizes="auto" class="lazyload" src="/template/image/catalog/demo/menuhome/home3.png" alt="Ảnh banner 3" style="border-radius: 10px">
                                    </picture>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-7 col-sm-7 col-7">
                            <div class="banner-box fade-box" data-banner-page="Homepage" data-banner-loc="Sub Banner_1">
                                <a class="aspect-ratio" href="#" aria-label="Gaming Gear" title="Gaming Gear">
                                    <picture>
                                        <img data-sizes="auto" class="lazyload" src="/template/image/catalog/demo/menuhome/home4.png" alt="Ảnh banner 4" style="border-radius: 10px">
                                    </picture>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hiển thị sản phẩm Deal -->
        @include('products.deal')
        <!-- Hiển thị sản phẩm -->
        @include('products.list')
        <!-- End Hiển thị sản phẩm -->
        <!--Extra-->
        <div class="chat-buttons">
            <!-- Button Messenger -->
            <a href="https://m.me/276786052185857" class="chat-button" target="_blank">
                <img src="/template/image/icon/messenger-logo.png" alt="Messenger">
                <div class="contact-info">
                    <b>Chat Facebook</b>
                    <span>(8h-24h)</span>
                </div>
            </a>
            <!-- Button Tel -->
            <a href="tel:0396586672" class="chat-button">
                <img src="/template/image/icon/tel-logo.png" alt="Tel">
                <div class="contact-info">
                    <b>Gọi điện thoại</b>
                    <span>(8h-24h)</span>
                </div>
            </a>
        </div>


        <div class="container page-builder-ltr">
            <div class="row row-style row_a6">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_5dfs  block block_10">
                    <div class="clearfix home1-sevices">
                        <ul class="category-slider-inner products-list yt-content-slider" data-rtl="yes" data-autoplay="yes" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="0" data-items_column00="4" data-items_column0="4" data-items_column1="3" data-items_column2="2"  data-items_column3="2" data-items_column4="1" data-arrows="no" data-pagination="no" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
                            <li class="item payment col-md-3">
                                <div class="icon">
                                </div>
                                <div class="text">
                                    <h5><a href="#">THANH TOÁN TIỆN LỢI</a></h5>
                                    <p>Trả tiền mặt, CK, Trả góp 0%</p>
                                </div>
                            </li>
                            <li class="item free col-md-3">
                                <div class="icon">
                                </div>
                                <div class="text">
                                    <h5><a href="#">CHÍNH SÁCH GIAO HÀNG</a></h5>
                                    <p>Nhận hàng và thanh toán tại nhà</p>
                                </div>
                            </li>
                            <li class="item secure col-md-3">
                                <div class="icon">
                                </div>
                                <div class="text">
                                    <h5><a href="#">THANH TOÁN AN TOÀN</a></h5>
                                    <p>An toàn, bảo mật tuyệt đối</p>
                                </div>
                            </li>
                            <li class="item support col-md-3">
                                <div class="icon">
                                </div>
                                <div class="text">
                                    <h5><a href="#">HỖ TRỢ NHIỆT TÌNH</a></h5>
                                    <p>Tư vấn mọi giải đáp, thắc mắc</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_cfay  block block_11">
                    <div class="module so-latest-blog custom-ourblog clearfix default-nav preset01-2 preset02-2 preset03-2 preset04-2 preset05-1">
                        <h2 class="modtitle"><span>Tin tức mới nhất</span></h2>
                        <div class="modcontent">
                            <div id="so_latest_blog_1" class="so-blog-external button-type2 button-type2">
                                <div class="category-slider-inner products-list yt-content-slider blog-external clearfix " data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column00="2" data-items_column0="2" data-items_column1="2" data-items_column2="2"  data-items_column3="2" data-items_column4="1" data-arrows="no" data-pagination="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
                                    @foreach ($latestBlogs as $blog)
                                    <div class="media">
                                        <div class="item head-button">
                                            <div class="content-img col-sm-6 col-xs-12">
                                                <a href="/blog/{{ $blog->id }}" target="_self">
                                                    <img src="{{ $blog->thumb }}" alt="{{ $blog->name }}" style="width: 310px; height: 174.63px">
                                                </a>
                                            </div>
                                            <div class="content-detail col-sm-6 col-xs-12">
                                                <div class="media-content so-block">
                                                    <div class="entry-date font-ct date-bottom">
                                                        <span class="media-date-added"><i class="fa fa-clock-o"></i> {{ $blog->created_at->format('d/m/Y') }}</span>
                                                    </div>
                                                    <h5 class="media-heading head-item">
                                                        <a href="/blog/{{ $blog->id }}" title="{{ $blog->name }}" target="_self">{{ $blog->name }}</a>
                                                    </h5>
                                                    <div class="description">
                                                        {!! \Illuminate\Support\Str::limit($blog->content, 100) !!}
                                                    </div>
                                                    <div class="readmore">
                                                        <a href="/blog/{{ $blog->id }}" target="_self">Đọc thêm</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_swee  block block_12">
                    <div id="content_slider_mfn4" class="yt-content-slider owl2-theme yt-content-slider-style-default arrow-default top-brand owl2-carousel owl2-responsive-1200 owl2-loaded yt-testimonials-slider" data-transitionin="fadeIn" data-transitionout="fadeOut" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column00="6" data-items_column0="6" data-items_column1="5" data-items_column2="4" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-pagination="no" data-lazyload="no" data-loop="yes" data-hoverpause="yes">
                        <div class="yt-content-slide yt-clearfix yt-content-wrap"> <img src="/template/image/catalog/demo/brand/nvidia.png" alt="title_dsdfg">
                        </div>
                        <div class="yt-content-slide yt-clearfix yt-content-wrap"> <img src="/template/image/catalog/demo/brand/intel.png" alt="title_dsdfg">
                        </div>
                        <div class="yt-content-slide yt-clearfix yt-content-wrap"> <img src="/template/image/catalog/demo/brand/amd.png" alt="title_dsdfg">
                        </div>
                        <div class="yt-content-slide yt-clearfix yt-content-wrap"> <img src="/template/image/catalog/demo/brand/acer.png" alt="title_dsdfg">
                        </div>
                        <div class="yt-content-slide yt-clearfix yt-content-wrap"> <img src="/template/image/catalog/demo/brand/asus.png" alt="title_dsdfg">
                        </div>
                        <div class="yt-content-slide yt-clearfix yt-content-wrap"> <img src="/template/image/catalog/demo/brand/dell.png" alt="title_dsdfg">
                        </div>
                        <div class="yt-content-slide yt-clearfix yt-content-wrap"> <img src="/template/image/catalog/demo/brand/lenovo.png" alt="title_dsdfg">
                        </div>
                        <div class="yt-content-slide yt-clearfix yt-content-wrap"> <img src="/template/image/catalog/demo/brand/microsoft.png" alt="title_dsdfg">
                        </div>
                        <div class="yt-content-slide yt-clearfix yt-content-wrap"> <img src="/template/image/catalog/demo/brand/hp.png" alt="title_dsdfg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
