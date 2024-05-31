<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    @include('head')
</head>
<body class="checkout-checkout ltr layout-1 load">
    <div id="wrapper" class="wrapper-fluid banners-effect-10">
        <!-- Header Container  -->
        @include('header')

        <!-- //Main Container -->
        <div class="container">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
            <ul class="breadcrumb">
                <li><a href="/"><i class="fa fa-home"></i> Trang chủ</a></li>
                <li><a href="#">{{$title}}</a></li>
            </ul>
            <div class="row">
                <div id="content" class="col-sm-12">
                    <h1>{{$title}}</h1>

                    <form id="checkout-form" action="" method="post">
                        @csrf
                        @if (count($products) != 0)
                            <div class="so-onepagecheckout layout1">
                                @php $total =0; @endphp
                                <div class="col-left col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                    <div class="checkout-content checkout-register">
                                        <fieldset id="account">
                                            <h2 class="secondary-title"><i class="fa fa-user-plus"></i> Thông tin cá nhân của bạn</h2>
                                            <div class="payment-new box-inner">
                                                <div class="form-group input-lastname required">
                                                    <input type="text" name="name" value="{{ Auth::user() ? Auth::user()->name : '' }}" placeholder="Nhập họ tên của bạn *" id="name" class="form-control" required>
                                                </div>
                                                <div class="form-group required">
                                                    <input type="text" name="email" value="{{ Auth::user() ? Auth::user()->email : '' }}" placeholder="Email của bạn *" id="email" class="form-control" required>
                                                </div>
                                                <div class="form-group required">
                                                    <input type="text" name="phone" value="{{ Auth::user() ? Auth::user()->phone : '' }}" placeholder="Nhập số điện thoại của bạn *" id="phone" class="form-control" required>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <h2 class="secondary-title"><i class="fa fa-map-marker"></i>Địa chỉ giao hàng</h2>
                                        <div class="checkout-address-form">
                                            <div class="box-inner">
                                                <form class="form-horizontal form-address">
                                                    <div id="address" name="addresss" style="display: block">
                                                        <div class="form-group required">
                                                            <select name="city" id="city" class="form-control">
                                                                <option value="city" selected>Tỉnh/ Thành phố</option>
                                                                @if(Auth::check())
                                                                    <option value="{{ Auth::user()->city }}" selected>{{ Auth::user()->city }}</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="form-group required">
                                                            <select name="district" id="district" class="form-control">
                                                                <option value="district" selected>Quận/ Huyện</option>
                                                                @if(Auth::check())
                                                                    <option value="{{ Auth::user()->district }}" selected>{{ Auth::user()->district }}</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="form-group required">
                                                            <select name="ward" id="ward" class="form-control">
                                                                <option value="ward" selected>Phường/ Xã</option>
                                                                @if(Auth::check())
                                                                    <option value="{{ Auth::user()->ward }}" selected>{{ Auth::user()->ward }}</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="form-group company-input">
                                                            <input type="text" name="street" value="{{ Auth::check() ? Auth::user()->street : '' }}" placeholder="Số nhà, tên đường" id="street" class="form-control">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-right col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <section class="section-right">
                                        <div class="checkout-content checkout-cart">
                                            <h2 class="secondary-title"><i class="fa fa-shopping-cart"></i>Giỏ hàng</h2>
                                            <div class="box-inner">
                                                <div class="table-responsive checkout-product">
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                        <tr>

                                                            <th class="text-left name" colspan="2">Tên sản phẩm</th>
                                                            <th class="text-center quantity">Số lượng</th>
                                                            <th class="text-center checkout-price">Đơn giá</th>
                                                            <th class="text-right total">Tổng tiền</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($products as $key =>$product)
                                                            @php
                                                                $price = $product->price_sale != 0 ? $product->price_sale : $product->price;
                                                                $priceEnd = $price * $carts[$product->id];
                                                                $total += $priceEnd;
                                                            @endphp
                                                            <tr>
                                                                <td class="text-left name" colspan="2">
                                                                    <a href=""><img src="{{$product->thumb}}" alt="{{$product->name}}" title="{{$product->name}}" class="img-thumbnail" style="width=80px ;height: 80px"></a>
                                                                    <a href="" class="product-name">{{ \Illuminate\Support\Str::limit($product->name, 40) }}</a>
                                                                </td>
                                                                <td class="text-left quantity">
                                                                    <div class="input-group">
                                                                        <input type="text" name="quantity[{{$product->id}}]" value="{{$carts[$product->id]}}" size="1" class="form-control">
                                                                    </div>
                                                                </td>
                                                                <td class="text-right price">{{number_format($price,0,'','.')}}</td>
                                                                <td class="text-right total">{{number_format($priceEnd,0,'','.')}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <td colspan="4" class="text-left">Tạm tính:</td>
                                                            <td class="text-right">{{number_format($total, 0, '','.')}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" class="text-left">Giảm giá:</td>
                                                            <td class="text-right">0</td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="4" class="text-left">Tổng tiền:</td>
                                                            <td class="text-right">{{number_format($total, 0, '','.')}}</td>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="section-left">
                                        <div class="ship-payment">
                                            <div class="checkout-content checkout-payment-methods">
                                                <h2 class="secondary-title"><i class="fa fa-credit-card"></i>Chọn hình thức thanh toán </h2>
                                                <div class="box-inner">
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="payment_method" value="cod" checked="checked"> Thanh toán khi nhận hàng
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="payment_method" value="vnpay" > Thanh toán bằng VNPay
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="payment_method" value="visa" > Thanh toán bằng thẻ quốc tế Visa, Master
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="checkout-content confirm-section">
                                            <div>
                                                <h2 class="secondary-title"><i class="fa fa-comment"></i>Ghi chú</h2>
                                                <label>
                                                    <textarea name="content" rows="8" class="form-control  requried "></textarea>
                                                </label>
                                            </div>

                                            <div class="confirm-order">
                                                <button id="so-checkout-confirm-button" data-loading-text="Loading..." class="btn btn-primary button confirm-button">Xác nhận mua hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                </section>
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
    </div>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
        method: "GET",
        responseType: "application/json",
    };
    var promise = axios(Parameter);
    promise.then(function (result) {
        renderCity(result.data);
    });

    function renderCity(data) {
        for (const x of data) {
            citis.options[citis.options.length] = new Option(x.Name, x.Name); // Sử dụng tên của tỉnh/thành phố làm giá trị
        }
        citis.onchange = function () {
            districts.length = 1;
            wards.length = 1;
            if(this.value != ""){
                const result = data.filter(n => n.Name === this.value); // Sử dụng tên của tỉnh/thành phố để tìm dữ liệu tương ứng

                for (const k of result[0].Districts) {
                    districts.options[districts.options.length] = new Option(k.Name, k.Name); // Sử dụng tên của quận/huyện làm giá trị
                }
            }
        };
        districts.onchange = function () {
            wards.length = 1;
            const dataCity = data.filter((n) => n.Name === citis.value);
            if (this.value != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Name === this.value)[0].Wards;

                for (const w of dataWards) {
                    wards.options[wards.options.length] = new Option(w.Name, w.Name); // Sử dụng tên của phường/xã làm giá trị
                }
            }
        };
    }
</script>
<script>
    document.getElementById('so-checkout-confirm-button').addEventListener('click', function(event) {
        event.preventDefault();
        var paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        var form = document.getElementById('checkout-form');

        // Tạo một input ẩn để truyền giá trị của $total vào form nếu biến tồn tại
        @if(isset($total))
            var totalInput = document.createElement("input");
            totalInput.setAttribute("type", "hidden");
            totalInput.setAttribute("name", "total");
            totalInput.setAttribute("value", "{{$total}}");
            form.appendChild(totalInput);
        @endif

        // Xác định hành động (action) của form dựa trên phương thức thanh toán được chọn
        if (paymentMethod === 'vnpay') {
            form.action = '/vnpay_payment';
            form.submit();
        } else if (paymentMethod === 'visa') {
            form.action = '/visa_payment';
            form.submit();
        } else {
            form.submit(); // Giữ nguyên action ban đầu khi chọn COD
        }
    });
</script>
