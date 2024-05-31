
<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <style>
        .review {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        }
        .star-rating {
            display: flex;
            direction: row-reverse;
            justify-content: flex-start;
            direction: rtl;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            font-size: 2em;
            color: gray;
            cursor: pointer;
        }

        .star-rating input[type="radio"]:checked ~ label {
            color: gold;
        }

        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: gold;
        }
    </style>

  @include('head')
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="res layout-1">

<div id="wrapper" class="wrapper-fluid banners-effect-10">


    <!-- Header Container  -->
  @include('header')


    <!-- Main Container  -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="title-breadcrumb">
                {{$title}}
            </div>
            <ul class="breadcrumb-cate">
                <li><a href="/"><i class="fa fa-home"></i> Trang chủ</a></li>
                <li><a href="/danh-muc/{{ $product->menu->id}}-{{ \Str::slug($product->menu->name) }}.html">{{ $product->menu->name }}</a></li>
                <li><a href="#">{{$title}}</a></li>
            </ul>
        </div>
    </div>

    <div class="container product-detail">
        <div class="row">
            <div id="content" class="col-md-9 col-sm-12 col-xs-12">
                <a href="javascript:void(0)" class="open-sidebar hidden-lg hidden-md"><i class="fa fa-bars"></i>Sidebar</a>
                <div class="sidebar-overlay "></div>
                <div class="product-view product-detail">
                    <div class="product-view-inner clearfix">
                        <div class="content-product-left  col-md-5 col-sm-6 col-xs-12">
                            <div class="so-loadeding"></div>
                            <div class="large-image  class-honizol">
                                <div class="box-label">
                                    <span class="label-product label-sale">
                                      <?php
                                          $originalPrice = $product->price;
                                          $discountedPrice = $product->price_sale;

                                          if ($originalPrice > 0) {
                                              $discountPercentage = round((($originalPrice - $discountedPrice) / $originalPrice) * 100);
                                          } else {
                                              $discountPercentage = 0;
                                          }

                                          echo '-' . $discountPercentage . '%';
                                      ?>
                                    </span>
                                </div>
                                <img class="product-image-zoom" src="{{$product->thumb}}" data-zoom-image="{{$product->thumb}}" title="{{$title}}" alt="{{$title}}">
                            </div>
                        </div>
                        <div class="content-product-right col-md-7 col-sm-6 col-xs-12">
                            <div class="countdown_box">
                                <div class="countdown_inner">
                                    <div class="Countdown-1">
                                    </div>
                                </div>
                            </div>
                            <div class="title-product">
                                <h1>{{$title}}</h1>
                            </div>
                            <div class="box-review">
                                <div class="rating">
                                    <div class="rating-box">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $averageRating)
                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                            @else
                                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <a class="reviews_button" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Đánh giá {{ $reviews->count() }}</a> / <a class="write_review_button" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Viết đánh giá</a>
                            </div>
                            <div class="product_page_price price" itemscope="" itemtype="http://data-vocabulary.org/Offer">
                                <span class="price-new"><span id="price-special">{!! \App\Helpers\Helper::price($product->price_sale) !!}</span></span>
                                <span class="price-old" id="price-old">{!! \App\Helpers\Helper::price($product->price) !!}</span>
                                <div class="price-tax"><span>Tiết kiệm: </span><span id="savings"></span></div>
                            </div>
                            <script>
                                // Lấy giá mới và giá cũ từ các thẻ span tương ứng
                                var priceNew = parseFloat(document.getElementById('price-special').innerText.replace(/,/g, ''));
                                var priceOld = parseFloat(document.getElementById('price-old').innerText.replace(/,/g, ''));

                                // Tính toán giá tiết kiệm
                                var saving = priceOld - priceNew;

                                // Chuyển đổi giá tiết kiệm thành chuỗi có dấu phẩy phân tách hàng nghìn
                                var formattedSaving = saving.toLocaleString('en-US');

                                // Hiển thị giá tiết kiệm trong thẻ div
                                document.getElementById('savings').innerText = '' + formattedSaving;
                            </script>
                            <div class="product-box-desc">
                                <div class="inner-box-desc" style="color: #222">
                                    <p> {!! $product->description !!}</p>
                                </div>
                            </div>
                            <div class="short_description form-group">
                                <h3>Tổng quan</h3>
                            </div>
                            <div id="product">
                                <div class="box-cart clearfix">

                                    <div class="form-group box-info-product">
                                        <form action="/add-cart" method="post">
                                            @if ($product->price !== NULL)
                                            <div class="option quantity">
                                                <div class="input-group quantity-control" unselectable="on" style="user-select: none;">
                                                    <input class="form-control" type="text" name="quantity" value="1">
                                                    <input type="hidden" name="product_id" value="{{$product ->id}}">
                                                    <span class="input-group-addon product_quantity_down fa fa-caret-down"></span>
                                                    <span class="input-group-addon product_quantity_up fa fa-caret-up"></span>
                                                </div>
                                            </div>
                                            <div class="cart">
                                                <input type="submit" value="Thêm vào giỏ hàng" class="addToCart btn btn-mega btn-lg " data-toggle="tooltip" title="" data-original-title="Thêm vào giỏ hàng">
                                            </div>
                                            @endif
                                            @csrf
                                        </form>
                                    </div>
                                    <div class="clearfix"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-attribute module">
                    <div class="row content-product-midde clearfix">
                        <div class="col-xs-12">
                            <div class="producttab ">
                                <div class="tabsslider  vertical-tabs ">
                                    <ul class="nav nav-tabs font-sn col-lg-3 col-sm-4 " style="padding: 0">
                                        <li class="active"><a data-toggle="tab" href="#tab-description">Mô tả chi tiết</a></li>
                                        <li><a href="#tab-review" data-toggle="tab">Đánh giá ({{ $reviews->count() }})</a></li>
                                    </ul>
                                    <div class="tab-content col-lg-9 col-sm-8 col-xs-12 ">
                                        <div class="tab-pane active" id="tab-description">
                                            <div>
                                                {!! $product->content !!}
                                            </div>
                                        </div>
                                           {{-- Đánh giá sản phẩm --}}
                                           <div class="tab-pane" id="tab-review">
                                            <div class="tab-pane" id="tab-review">
                                                <div id="review">
                                                    <h4>Thông tin đánh giá</h4>
                                                    @if($reviews->isEmpty())
                                                        <p>Chưa có đánh giá nào.</p>
                                                    @else
                                                        @foreach($reviews as $review)
                                                            <div class="review">
                                                                <h5>{{ $review->name }}: </h5>
                                                                <div class="review-text">{{ $review->text }}</div>
                                                                <div class="star-rating">
                                                                    @for($i = 5; $i >= 1; $i--)
                                                                        <input type="radio" id="star{{ $i }}-{{ $review->id }}" name="rating{{ $review->id }}" value="{{ $i }}" @if($review->rating == $i) checked @endif disabled>
                                                                        <label for="star{{ $i }}-{{ $review->id }}">&#9733;</label>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                                @if(Auth::check())
                                                    <h2>Viết đánh giá</h2>
                                                    <form class="form-horizontal" id="form-review">
                                                        <div class="form-group required">
                                                            <div class="col-sm-12">
                                                                <label class="control-label" for="input-name">Tên của bạn</label>
                                                                <input type="text" name="name" value="{{ Auth::user()->name }}" id="input-name" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group required">
                                                            <div class="col-sm-12">
                                                                <label class="control-label" for="input-review">Viết đánh giá của bạn</label>
                                                                <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group required">
                                                            <div class="col-sm-12">
                                                                <label class="control-label">Xếp hạng: </label>
                                                                &nbsp;&nbsp;&nbsp; Tệ&nbsp;
                                                                <input type="radio" name="rating" value="1">
                                                                &nbsp;
                                                                <input type="radio" name="rating" value="2">
                                                                &nbsp;
                                                                <input type="radio" name="rating" value="3">
                                                                &nbsp;
                                                                <input type="radio" name="rating" value="4">
                                                                &nbsp;
                                                                <input type="radio" name="rating" value="5">
                                                                &nbsp;Rất tốt
                                                            </div>
                                                        </div>
                                                        <div class="buttons clearfix">
                                                            <div class="pull-right">
                                                                <button type="button" id="button-review" data-loading-text="Loading..." class="btn btn-primary"> Gửi</button>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="product_id" value="{{ $product->id }}">
                                                    </form>
                                                @else
                                                    <p>Bạn cần <a href="{{ route('login_user') }}">đăng nhập</a> để viết đánh giá.</p>
                                                @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sản phẩm liên quan -->
                <div class="content-product-bottom bottom-product clearfix">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#product-related">Sản phẩm liên quan</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="product-related" class="tab-pane fade in active">
                            <div class="clearfix module horizontal">
                                <div class="products-category">
                                    <div class="category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="no" data-autoplay="no" data-pagination="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column0="4" data-items_column1="3" data-items_column2="2" data-items_column3="2" data-items_column4="1" data-arrows="yes" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                                        @foreach($relatedProducts as $relatedProduct)
                                            <div class="product-layout">
                                                <div class="product-item-container">
                                                    <div class="left-block">
                                                        <div class="product-image-container">
                                                            <a href="/san-pham/{{ $relatedProduct->id }}-{{ \Str::slug($relatedProduct->name, '-') }}.html" title="{{ $relatedProduct->name }}">
                                                                <img src="{{ $relatedProduct->thumb }}" alt="{{ $relatedProduct->name }}" title="{{ $relatedProduct->name }}" class="img-1 img-responsive">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="box-label">
                                                        <span class="label-product label-sale">
                                                            <?php
                                                                $originalPrice = $relatedProduct->price;
                                                                $discountedPrice = $relatedProduct->price_sale;

                                                                if ($originalPrice > 0) {
                                                                    $discountPercentage = round((($originalPrice - $discountedPrice) / $originalPrice) * 100);
                                                                } else {
                                                                    $discountPercentage = 0;
                                                                }

                                                                echo '-' . $discountPercentage . '%';
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div class="right-block">
                                                        <div class="caption">
                                                            <h5><a href="/san-pham/{{ $relatedProduct->id }}-{{ \Str::slug($relatedProduct->name, '-') }}.html">{{ \Illuminate\Support\Str::limit($relatedProduct->name, 40) }}</a></h5>
                                                            <div class="total-price clearfix" style="visibility: hidden; display: block;">
                                                                <div class="price price-left">
                                                                    <span class="price-new">{!! \App\Helpers\Helper::price($relatedProduct->price_sale) !!}</span>
                                                                    <span class="price-old">{!! \App\Helpers\Helper::price($relatedProduct->price_sale) !!}</span>
                                                                </div>
                                                                <div class="price-sale price-right">
                                                                    <span class="discount">
                                                                        <?php
                                                                            $originalPrice = $relatedProduct->price;
                                                                            $discountedPrice = $relatedProduct->price_sale;

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
                                                                <button class="addToCart btn-button" type="button" data-toggle="tooltip" title="" onclick="cart.add('{{ $relatedProduct->id }}', '2');" data-original-title="Thêm vào giỏ hàng"><span class="hidden">Thêm vào giỏ hàng </span></button>
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
                </div>

        </div>
        <aside class="col-md-3 col-sm-4 col-xs-12 content-aside right_column sidebar-offcanvas">
            <span id="close-sidebar" class="fa fa-times"></span>
            <div class="module category-style">
                <h3 class="modtitle"><span>Yên tâm mua hàng</span></h3>
                <div class="mod-content box-category" style="padding-left: 20px">
                    <ul class="accordion" id="accordion-category">
                            <li> - Uy tín 22 năm Top đầu trên thị trường</li>
                            <li> - Sản phẩm chính hãng 100%</li>
                            <li> - Trả góp lãi suất 0% toàn bộ giỏ hàng</li>
                            <li> - Trả bảo hành tận nơi sử dụng</li>
                            <li> - Bảo hành tận nơi cho doanh nghiệp</li>
                            <li> - Vệ sinh miễn phí trọn đời PC, Laptop</li>
                    </ul>
                </div>
            </div>
            <div class="module category-style">
                <h3 class="modtitle"><span>Miễn phí giao hàng</span></h3>
                <div class="mod-content box-category" style="padding-left: 20px">
                    <ul class="accordion" id="accordion-category">
                        <li> - Giao hàng miễn phí toàn quốc </li>
                        <li> - Nhận hàng và thanh toán tại nhà (ship COD)</li>
                    </ul>
                </div>
            </div>
            <div class="moduletable module so-extraslider-ltr best-seller best-seller-custom">
                <h3 class="modtitle"><span>Giảm giá sốc</span></h3>
                <div class="modcontent">
                    <div id="so_extra_slider" class="so-extraslider buttom-type1 preset00-1 preset01-1 preset02-1 preset03-1 preset04-1 button-type1">
                        <div class="extraslider-inner owl2-carousel owl2-theme owl2-loaded extra-animate" data-effect="none">
                            <div class="item ">
{{--                                <div class="item-wrap style1 ">--}}
{{--                                    <div class="item-wrap-inner">--}}
{{--                                        <div class="media-left">--}}
{{--                                            <div class="item-image">--}}
{{--                                                <div class="item-img-info product-image-container ">--}}
{{--                                                    <div class="box-label">--}}
{{--                                                    </div>--}}
{{--                                                    <a class="lt-image" data-product="104" href="#" target="_self" title="Toshiba Pro 21&quot;(21:9) FHD  IPS LED 1920X1080 HDMI(2)">--}}
{{--                                                        <img src="/template/image/catalog/demo/product/electronic/25.jpg" alt="Toshiba Pro 21&quot;(21:9) FHD  IPS LED 1920X1080 HDMI(2)">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <div class="item-info">--}}
{{--                                                <!-- Begin title -->--}}
{{--                                                <div class="item-title">--}}
{{--                                                    <a href="product.html" target="_self" title="Toshiba Pro 21&quot;(21:9) FHD  IPS LED 1920X1080 HDMI(2) ">--}}
{{--                                                        Toshiba Pro 21"(21:9) FHD  IPS LED 1920X1080 HDMI(2)--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <!-- Begin ratting -->--}}
{{--                                                <div class="rating">--}}
{{--                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>--}}
{{--                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>--}}
{{--                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>--}}
{{--                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>--}}
{{--                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>--}}
{{--                                                </div>--}}
{{--                                                <!-- Begin item-content -->--}}
{{--                                                <div class="price">--}}
{{--                                                    <span class="old-price product-price">$62.00</span>--}}
{{--                                                    <span class="price-old">$337.99</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!-- End item-info -->--}}
{{--                                    </div>--}}
{{--                                    <!-- End item-wrap-inner -->--}}
{{--                                </div>--}}
{{--                                <!-- End item-wrap -->--}}
{{--                                --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="module banner-left hidden-xs ">
                <div class="static-image-home-left banners">
                    <div><a title="Static Image" href="#"><img src="/template/image/catalog/demo/banners/image-left.jpg" alt="Static Image"></a></div>
                </div>
            </div>
        </aside>
    </div>
</div>

<!-- //Main Container -->



<!-- Footer Container -->
@include('footer')
<!-- end Footer Container -->

</div>
</body>
</html>

<script>
    document.getElementById('button-review').addEventListener('click', function() {
        var product_id = document.getElementById('product_id').value;
        var name = document.getElementById('input-name').value;
        var text = document.getElementById('input-review').value;
        var rating = document.querySelector('input[name="rating"]:checked');

        if (!name || !text || !rating) {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Vui lòng điền đầy đủ thông tin.'
            });
            return;
        }

        var reviewData = {
            product_id: product_id,
            name: name,
            text: text,
            rating: rating.value
        };

        fetch('/reviews', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(reviewData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('form-review').reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Cảm ơn bạn đã gửi đánh giá!',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        location.reload();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: data.message || 'Có lỗi xảy ra. Vui lòng thử lại.'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Có lỗi xảy ra. Vui lòng thử lại.'
            });
        });
    });
    </script>

