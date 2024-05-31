<!-- Hiển thị sản phẩm -->
@foreach($menuProducts as $menuName => $products)
    <section id="box-link2" class="section-style">
        <div class="container page-builder-ltr">
            <div class="row row-style row_a2">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_1bi4  col-style block block_5 title_neo2">
                    <div class="module so-listing-tabs-ltr default-nav clearfix img-float label-1 home-lt1">
                        <div class="head-title font-ct" style="display: flex; justify-content: space-between; align-items: center; ">
                            <h2 class="modtitle">{{ $menuName }}</h2>
                            <a href="/danh-muc/{{$menu->id}}-{{\Str::slug($menu->name, '-') }}.html" class="viewall" style="margin: 0px 10px 0px 0px; background-color: #ff0000; color: #fff; border-radius: 10px; border: 1px solid #cccccc; padding: 0px 10px ">Xem tất cả <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                        <div class="modcontent">
                            <div id="so_listing_tabs_1" class="so-listing-tabs first-load">
                                <div class="ltabs-wrap">
                                    <div class="wap-listing-tabs ltabs-items-container products-list grid">
                                        <!--Hiển thị sản phẩm -->
                                        <div class="ltabs-items ltabs-items-selected items-category-1" data-total="16">
                                            <div class="ltabs-items-inner ltabs-slider" style="display: flex; flex-direction: row;">
                                                @php
                                                    $count = 0; // Khởi tạo biến đếm
                                                @endphp
                                                @foreach($products as $product)
                                                    @php
                                                        $count++; // Tăng biến đếm lên 1 mỗi khi lặp
                                                    @endphp
                                                    @if($count <= 6) <!-- Chỉ hiển thị sản phẩm nếu biến đếm nhỏ hơn hoặc bằng 6 -->
                                                        <!-- Mã HTML hiển thị sản phẩm -->
                                                        <div class="ltabs-item" >
                                                            <div class="item-inner product-layout transition product-grid">
                                                                <div class="product-item-container">
                                                                    <div class="left-block">
                                                                        <div class="image product-image-container">
                                                                            <a class="lt-image" href="/san-pham/{{ $product->id }}-{{ \Str::slug($product->name, '-') }}.html" target="_self" title="{{$product->name}}">
                                                                                <img src="{{$product->thumb}}" alt="{{$product->name}}" style="width: 170px; height: 170px">
                                                                            </a>
                                                                        </div>
                                                                        <div class="box-label"><span class="label-product label-sale">Sale</span></div>
                                                                    </div>
                                                                    <div class="right-block">
                                                                        <div class="caption">
                                                                            <h6><a href="/san-pham/{{ $product->id }}-{{ \Str::slug($product->name, '-') }}.html" title="{{$product->name}}" target="_self">{{ \Illuminate\Support\Str::limit($product->name, 40) }}</a></h6>

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
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endforeach

