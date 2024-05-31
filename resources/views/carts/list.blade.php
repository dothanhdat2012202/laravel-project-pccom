
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    @include('head')
</head>
<body class="checkout-cart res layout-1">
<div id="wrapper" class="wrapper-fluid banners-effect-10">
    <!-- Header Container  -->
    @include('header')

    <!-- Main Container  -->
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="/"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li><a href="#">{{$title}}</a></li>
        </ul>

        <div class="row">
            <div id="content" class="col-sm-12">
                <h1>{{$title}}</h1>

                <!-- Giỏ hàng -->
                <form action="" method="post">
                @if (count($products) != 0)
                <div class="table-responsive">
                    @php $total =0; @endphp
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td class="text-center">Ảnh</td>
                            <td class="text-left">Tên sản phẩm</td>
                            <td class="text-center">ID</td>
                            <td class="text-center">Số lượng</td>
                            <td class="text-center">Đơn giá</td>
                            <td class="text-center">Tổng cộng</td>
                            <td class="text-center">Xóa</td>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($products as $key => $product)
                            @php
                            $price = $product->price_sale != 0 ? $product->price_sale : $product->price;
                            $priceEnd = $price * $carts[$product->id];
                            $total += $priceEnd;
                            @endphp
                        <tr>
                            <td class="text-center"> <a href="product.html"><img src="{{$product->thumb}}" alt="{{$product->name}}" title="{{$product->name}}" class="img-thumbnail" width="100px" height="100px"></a> </td>
                            <td class="text-left"><a href="#">{{$product->name}}</a> </td>
                            <td class="text-center">{{$product->id}}</td>
                            <td class="text-center">
                                <div class="input-group btn-block" style="max-width: 200px;">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary" onclick="decreaseQuantity({{$product->id}})"><i class="fa fa-minus"></i></button>
                                    </span>
                                    <input type="text" name="quantity[{{$product->id}}]" value="{{$carts[$product->id]}}" size="1" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary" onclick="increaseQuantity({{$product->id}})"><i class="fa fa-plus"></i></button>
                                    </span>
                                </div>
                            </td>
                            <td class="text-center">{{number_format($price,0,'','.')}}</td>
                            <td class="text-center">{{number_format($priceEnd,0,'','.')}}</td>
                            <td class="text-center">
                                <a href="/carts/delete/{{$product->id}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                            @csrf
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-right">
                        <input type="submit" value="Cập nhật giỏ hàng" class="btn btn-primary" formaction="/update-cart">
                    </div>

                </div>
                <!-- //Giỏ hàng -->
                <h2>Bạn muốn là gì tiếp theo?</h2>
                <p>Chọn xem bạn có mã giảm giá bạn muốn sử dụng hay muốn ước tính chi phí giao hàng của mình.</p>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a href="#collapse-coupon" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion">Sử dụng mã giảm giá <i class="fa fa-caret-down"></i></a></h4>
                        </div>
                        <div id="collapse-coupon" class="panel-collapse collapse">
                            <div class="panel-body">
                                <label class="col-sm-2 control-label" for="input-coupon">Nhập mã giảm giá</label>
                                <div class="input-group">
                                    <input type="text" name="coupon" value="" placeholder="Nhập mã ở đây" id="input-coupon" class="form-control">
                                    <span class="input-group-btn">
									<input type="button" value="Áp dụng" id="button-coupon" data-loading-text="Loading..." class="btn btn-primary">
								</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 col-sm-offset-8">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td class="text-right"><strong>Tạm tính:</strong></td>
                                <td class="text-right">{{number_format($total, 0, '','.')}}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>Giảm giá:</strong></td>
                                <td class="text-right">0</td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>Thành tiền:</strong></td>
                                <td class="text-right">{{number_format($total, 0, '','.')}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="buttons clearfix">
                    <div class="pull-left"><a href="/" class="btn btn-default">Tiếp tục mua sắm</a></div>
                    <div class="pull-right"><a href="{{URL::to('/login-checkout')}}" class="btn btn-primary">Tiến hành thanh toán</a></div>
                </div>
                @else


                    <div class="text-center"><h2>Giỏ hàng trống</h2></div>
                    <div class="buttons clearfix text-center">
                        <div class="center-block" style="margin-bottom:100px; margin-top:20px">
                            <a href="/" class="btn btn-default">Tiếp tục mua sắm</a>
                        </div>
                    </div>

                @endif
                </form>
            </div>


        </div>

    </div>

    <!-- //Main Container -->



    <!-- Footer Container -->
    @include('footer')
    <!-- //end Footer Container -->


</div>
</body>

</html>
<script>
    function increaseQuantity(productId) {
        var input = document.querySelector("input[name='quantity[" + productId + "]']");
        var currentValue = parseInt(input.value);
        input.value = currentValue + 1;
    }

    function decreaseQuantity(productId) {
        var input = document.querySelector("input[name='quantity[" + productId + "]']");
        var currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
        }
    }
</script>
