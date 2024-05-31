
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    @include('head')


</head>

<body class=" res layout-1">

<div id="wrapper" class="wrapper-fluid banners-effect-10">


    <!-- Header Container  -->
    @include('header')
    <!-- //Header Container  -->

    <!-- Main Container  -->

    <div class="breadcrumbs">
        <div class="container">
            <div class="title-breadcrumb">
                {{$title}}
            </div>
            <ul class="breadcrumb-cate">
                <li><a href="/"><i class="fa fa-home"></i> Trang chủ</a></li>
                <li><a href="#">{{$title}}</a></li>
            </ul>
        </div>
    </div>

    <!-- Nội dung ở đây -->
    <div class="container product-detail">
        <div class="row">
            <aside class="col-md-3 col-sm-4 col-xs-12 content-aside left_column sidebar-offcanvas">
                <span id="close-sidebar" class="fa fa-times"></span>
                <div class="module so_filter_wrap filter-horizontal">
                    <h3 class="modtitle"><span>Lọc sản phẩm</span></h3>
                    <div class="modcontent">
                        <ul>
                            <li class="so-filter-options" data-option="Price">
                                <div class="so-filter-heading">
                                    <div class="so-filter-heading-text">
                                        <span>Lọc theo giá tiền</span>
                                    </div>
                                    <i class="fa fa-chevron-down"></i>
                                </div>
                                <div class="so-filter-content-opts">
                                    <div class="so-filter-content-opts-container">
                                        <div class="so-filter-content-wrapper so-filter-iscroll">
                                            <div class="so-filter-options">
                                                <div class="so-filter-option so-filter-price">
                                                    <div class="content_min_max">
                                                        <div class="put-min put-min_max">
                                                            <input type="text" class="input_min form-control" value="50000" min="50000" max="100000000">
                                                        </div>
                                                        <div class="put-max put-min_max">
                                                            <input type="text" class="input_max form-control" value="100000000" min="50000" max="100000000">
                                                        </div>
                                                    </div>
                                                    <div class="content_scroll">
                                                        <div id="slider-range"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="moduletable module so-extraslider-ltr best-seller best-seller-custom">
                    <h3 class="modtitle"><span>Giảm giá sốc</span></h3>
                    <div class="modcontent">
                        <div id="so_extra_slider" class="so-extraslider buttom-type1 preset00-1 preset01-1 preset02-1 preset03-1 preset04-1 button-type1">
                            <div class="extraslider-inner owl2-carousel owl2-theme owl2-loaded extra-animate" data-effect="none">
                                <div class="item ">
{{--                                    <div class="item-wrap style1 ">--}}
{{--                                        <div class="item-wrap-inner">--}}
{{--                                            <div class="media-left">--}}
{{--                                                <div class="item-image">--}}
{{--                                                    <div class="item-img-info product-image-container ">--}}
{{--                                                        <div class="box-label">--}}
{{--                                                        </div>--}}
{{--                                                        <a class="lt-image" data-product="104" href="#" target="_self" title="Toshiba Pro 21&quot;(21:9) FHD  IPS LED 1920X1080 HDMI(2)">--}}
{{--                                                            <img src="/template/image/catalog/demo/product/electronic/25.jpg" alt="Toshiba Pro 21&quot;(21:9) FHD  IPS LED 1920X1080 HDMI(2)">--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="media-body">--}}
{{--                                                <div class="item-info">--}}
{{--                                                    <!-- Begin title -->--}}
{{--                                                    <div class="item-title">--}}
{{--                                                        <a href="product.html" target="_self" title="Toshiba Pro 21&quot;(21:9) FHD  IPS LED 1920X1080 HDMI(2) ">--}}
{{--                                                            Toshiba Pro 21"(21:9) FHD  IPS LED 1920X1080 HDMI(2)--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                    <!-- Begin ratting -->--}}
{{--                                                    <div class="rating">--}}
{{--                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>--}}
{{--                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>--}}
{{--                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>--}}
{{--                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>--}}
{{--                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>--}}
{{--                                                    </div>--}}
{{--                                                    <!-- Begin item-content -->--}}
{{--                                                    <div class="price">--}}
{{--                                                        <span class="old-price product-price">$62.00</span>--}}
{{--                                                        <span class="price-old">$337.99</span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <!-- End item-info -->--}}
{{--                                        </div>--}}
{{--                                        <!-- End item-wrap-inner -->--}}
{{--                                    </div>--}}
                                    <!-- End item-wrap -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="module banner-left hidden-xs ">
                    <div class="static-image-home-left banners">
                        <div><a title="Static Image" href="#"><img src="/template/image/catalog/demo/banners/image-left.jpg" alt="Static Image" ></a></div>
                    </div>
                </div>
            </aside>
            <div id="content" class="col-md-9 col-sm-12 col-xs-12">
                <div class="module banners-effect-9 form-group">
                    <div class="banners">
                        <div>
                            <a href="#"><img src="/template/image/catalog/demo/category/men-cat.jpg"></a>
                        </div>
                    </div>
                </div>
                <a href="javascript:void(0)" class="open-sidebar hidden-lg hidden-md"><i class="fa fa-bars"></i> Bộ lọc</a>

                <div class="products-category">
                    <div class="form-group clearfix">
                        <span class="title-category">{{$title}}</span>
                    </div>

                    <div class="products-category">
                        <div class="product-filter filters-panel">
                            <div class="row">
                                <div class="col-sm-2 view-mode hidden-sm hidden-xs">
                                    <div class="list-view">
                                        <button class="btn btn-default grid active" data-view="grid" data-toggle="tooltip"  data-original-title="Grid"><i class="fa fa-th"></i></button>
                                        <button class="btn btn-default list" data-view="list" data-toggle="tooltip" data-original-title="List"><i class="fa fa-th-list"></i></button>
                                    </div>
                                </div>

                                <div class="short-by-show form-inline text-right col-md-10 col-sm-12">
                                    <div class="form-group short-by">
                                        <label class="control-label" for="input-sort">Sắp xếp:</label>
                                        <select id="input-sort" class="form-control" onchange="location = this.value;">
                                            <option value="" selected="selected">Default</option>
                                            <option value="?name=asc">Tên sản phẩm (A - Z)</option>
                                            <option value="?name=desc">Tên sản phẩm (Z - A)</option>
                                            <option value="?price_sale=asc">Giá tăng dần (Thấp &gt; Cao)</option>
                                            <option value="?price_sale=desc">Giá giảm dần (Cao &gt; Thấp)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="input-limit">Hiển thị:</label>
                                        <select id="input-limit" class="form-control" onchange="location = this.value;">
                                            <option value="" selected="selected">12</option>
                                            <option value="">25</option>
                                            <option value="">50</option>
                                            <option value="">75</option>
                                            <option value="">100</option>
                                        </select>
                                    </div>
                                    <div class="form-group product-compare"><a id="compare-total" class="btn btn-default">So sánh sản phẩm (0)</a></div>
                                </div>

                            </div>
                        </div>

                        <div class="products-list grid row number-col-3 so-filter-gird">
                            @foreach($products as $product)
                            <div class="product-layout  col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                <div class="product-item-container">
                                    <div class="left-block">
                                        <div class="image product-image-container">
                                            <a class="lt-image" href="/san-pham/{{ $product->id }}-{{ \Str::slug($product->name, '-') }}.html" target="_self" title="{{$product->name}}">
                                                <img src="{{$product->thumb}}" alt="{{$product->name}}" style="wight:270px; height:270px;">
                                            </a>
                                        </div>
                                        <div class="box-label"><span class="label-product label-sale">Sale</span></div>
                                    </div>
                                    <div class="right-block">
                                        <div class="caption">
                                            <h5><a href="/san-pham/{{ $product->id }}-{{ \Str::slug($product->name, '-') }}.html" title="{{$product->name}}" target="_self">{{ \Illuminate\Support\Str::limit($product->name, 70) }}</a></h5>
                                            <div class="total-price clearfix">
                                                <div class="price price-left"><span class="price-new">{!!  \App\Helpers\Helper::price($product->price_sale)!!}</span><span class="price-old">{!!  \App\Helpers\Helper::price($product->price)!!}</span></div>
                                                <div class="price-sale price-right">
                                                    <span class="discount">
                                                        <?php
                                                            $originalPrice = $product->price;
                                                            $discountedPrice = $product->price_sale;

                                                            if ($originalPrice > 0) {
                                                                $discountPercentage = round((($originalPrice - $discountedPrice) / $originalPrice) * 100);
                                                            } else {
                                                                $discountPercentage = 0;
                                                            }
                                                            echo '-' . $discountPercentage . '%<strong>Giảm</strong>';
                                                        ?>
                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="button-group">
                                            <div class="button-inner so-quickview">
                                                <a class="lt-image hidden" href="product.html" target="_self" title="{{$product->name}}"></a>

                                                <button class="addToCart btn-button" type="button" data-toggle="tooltip" title="" onclick="cart.add('114');" data-original-title="Thêm vào giỏ hàng">
                                                    <span class="hidden">Thêm vào giỏ hàng</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="clearfix visible-lg-block"></div>
                        </div>


                        <div class="product-filter product-filter-bottom filters-panel">
                            <div class="col-sm-6 text-left">
                                <ul class="pagination">
                                    <li class="active"><span>1</span>
                                    </li>
                                    <li><a href="#">2</a>
                                    </li>
                                    <li><a href="#">&gt;</a>
                                    </li>
                                    <li><a href="#">&gt;|</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- //end Nội dung -->

    <!-- //Main Container -->



    <!-- Footer Container -->
    @include('footer')
    <!-- //end Footer Container -->


</div>


</body>

</html>

<script>
    $(document).ready(function() {
    var minPrice = 50000;
    var maxPrice = 100000000;

    // Khởi tạo thanh trượt giá
    $("#slider-range").slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minPrice, maxPrice],
        slide: function(event, ui) {
            $(".input_min").val(ui.values[0].toLocaleString('vi-VN', {style: 'currency', currency: 'VND'}).replace('₫', ''));
            $(".input_max").val(ui.values[1].toLocaleString('vi-VN', {style: 'currency', currency: 'VND'}).replace('₫', ''));
        },
        stop: function(event, ui) {
            filterProductsByPrice(ui.values[0], ui.values[1]);
        }
    });

    // Thiết lập giá trị ban đầu cho các ô nhập liệu
    $(".input_min").val(minPrice.toLocaleString('vi-VN', {style: 'currency', currency: 'VND'}).replace('₫', ''));
    $(".input_max").val(maxPrice.toLocaleString('vi-VN', {style: 'currency', currency: 'VND'}).replace('₫', ''));

    // Xử lý sự kiện thay đổi giá trị ô nhập liệu
    $(".input_min, .input_max").on('change', function() {
        var min = parseInt($(".input_min").val().replace(/\D/g, ''));
        var max = parseInt($(".input_max").val().replace(/\D/g, ''));

        if (min >= minPrice && max <= maxPrice && min < max) {
            $("#slider-range").slider("values", [min, max]);
            filterProductsByPrice(min, max);
        }
    });

    // Xử lý sự kiện nhấn nút đặt lại
    $("#btn_resetAll").on('click', function() {
        $(".input_min").val(minPrice.toLocaleString('vi-VN', {style: 'currency', currency: 'VND'}).replace('₫', ''));
        $(".input_max").val(maxPrice.toLocaleString('vi-VN', {style: 'currency', currency: 'VND'}).replace('₫', ''));
        $("#slider-range").slider("values", [minPrice, maxPrice]);
        filterProductsByPrice(minPrice, maxPrice);
    });

    // Hàm lọc sản phẩm theo giá
    function filterProductsByPrice(minPrice, maxPrice) {
        $(".product-layout").each(function() {
            var productPrice = parseInt($(this).find('.price-new').text().replace(/\D/g, ''));
            if (productPrice >= minPrice && productPrice <= maxPrice) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
});

</script>
