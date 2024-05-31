<div class="col-lg-2 col-xs-6 header-cart">
    <div class="shopping_cart">
        <div id="cart" class="btn-shopping-cart">
            <a data-loading-text="Loading... " class="btn-group top_cart dropdown-toggle" data-toggle="dropdown">
                <div class="shopcart">
                    <span class="handle pull-left"></span>
                    <div class="cart-info">
                        <h2 class="title-cart">Giỏ Hàng</h2>
                        <h2 class="title-cart2 hidden">Giỏ hàng của tôi</h2>
                        <span class="total-shopping-cart cart-total-full">
									   <span class="items_cart">{{ is_array(\Illuminate\Support\Facades\Session::get('carts')) ? count(\Illuminate\Support\Facades\Session::get('carts')) : 0 }}</span>
									    <span class="items_cart2">sản phẩm</span>
						</span>
                    </div>

                </div>
            </a>
            <ul class="dropdown-menu pull-right shoppingcart-box">
                <li class="content-item">
                    @if (count($products) >0)
                        @foreach($products as $key =>$product)
                             <table class="table table-striped" style="margin-bottom:10px;">
                        <tbody>
                        <tr>
                            <td class="text-center size-img-cart">
                                <a href="#"><img src="{{$product->thumb}}" alt="{{$product->name}}" title="{{$product->name}}" class="img-thumbnail"></a>
                            </td>
                            <td class="text-left"><a href="#">{{$product->name}}</a>
                                <br> <small> ID: {{$product->id}}</small> </td>
                            <td class="text-right">x{{$carts[$product->id]}}</td>
                        </tr>
                        </tbody>
                    </table>
                        @endforeach
                    @endif
                </li>
                <li>
                    <div class="checkout clearfix">
                        <a href="/carts" class="btn btn-view-cart inverse"> Xem Giỏ Hàng</a>
                        <a href="/carts" class="btn btn-checkout pull-right">Thanh Toán</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

