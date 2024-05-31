<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
    <style>
        .progress-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 50px auto;
            width: 100%;
            background: none; /* Remove background color */
            position: relative;
        }
        .step {
            text-align: center;
            position: relative;
            flex: 1;
        }
        .circle {
            width: 50px;
            height: 50px;
            background-color: #f0f0f0;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            border: 2px solid #ccc;
            z-index: 1;
        }
        .circle.active {
            background-color: #4caf50;
            border-color: #4caf50;
            color: white;
        }
        .label {
            margin-top: 10px;
            font-size: 14px;
            color: #999;
        }
        .label.active {
            color: #4caf50;
            font-weight: bold;
        }
        .progress-bar .step:not(:last-child)::after {
            content: "";
            position: absolute;
            top: 36%;
            left: 100%;
            transform: translateX(-50%); /* Điều chỉnh căn chỉnh */
            width: calc(100% - 50px); /* Điều chỉnh độ rộng dựa trên kích thước vòng tròn */
            height: 2px;
            background-color: #ccc;
            z-index: 0;
        }
        .progress-bar .step.active:not(:last-child)::after {
            background-color: #4caf50;
        }
    </style>
</head>
<body class="account res layout-1 layout-subpage">
    <div id="wrapper" class="wrapper-fluid banners-effect-5">
        @include('header')
        <div class="main-container container">
            <ul class="breadcrumb">
                <li><a href="/"><i class="fa fa-home"></i> Trang chủ</a></li>
                <li><a href="/history_cart"> Lịch sử mua hàng</a></li>
                <li><a href="">{{ $title }}</a></li>
            </ul>
            <div class="customer">
                <ul>
                    <li>Tên Khách Hàng: <strong>{{$customer->name}}</strong></li>
                    <li>Địa Chỉ Email: <strong>{{$customer->email}}</strong></li>
                    <li>Số Điện Thoại: <strong>{{$customer->phone}}</strong></li>
                    <li>Địa Chỉ: <strong>{{$customer->street}},{{$customer->ward}},{{$customer->district}},{{$customer->city}}</strong></li>
                    <li>Phương Thức Thanh Toán: <strong>{{$customer->payment_method}}</strong></li>
                    <li>Ghi Chú: <strong>{{$customer->content}}</strong></li>
                </ul>
            </div>

            <div class="carts">
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
                     </tr>
                     </thead>

                     <tbody>
                     @foreach($carts as $key => $cart)
                         @php
                             $price = $cart->price * $cart->quantity;
                             $total += $price;
                         @endphp
                         <tr>
                             <td class="text-center"> <a href="#"><img src="{{$cart->product->thumb}}" alt="{{$cart->product->name}}" title="{{$cart->product->name}}" class="img-thumbnail" width="100px" height="100px"></a> </td>
                             <td class="text-left">{{$cart->product->name}} </td>
                             <td class="text-center">{{$cart->id}}</td>
                             <td class="text-center">{{$cart->quantity}}</td>
                             <td class="text-center">{{number_format($cart->price,0,'','.')}}</td>
                             <td class="text-center">{{number_format($price,0,'','.')}}</td>
                         </tr>
                         @csrf
                     @endforeach
                     <tr>
                         <td colspan="5" class="text-right">Tổng tiền</td>
                         <td>{{number_format($total, 0,'','.')}}</td>
                     </tr>

                     </tbody>
                </table>
            </div>

            {{-- Trạng thái giao hàng --}}
            <h4>Trạng thái đơn hàng</h4>
            <div class="progress-bar">
                <div class="step" id="step-1">
                    <div class="circle"><i class="fa fa-check"></i></div>
                    <div class="label">Đang chờ xác nhận</div>
                </div>
                <div class="step" id="step-2">
                    <div class="circle"><i class="fa fa-cogs"></i></div>
                    <div class="label">Lắp ráp, cài đặt</div>
                </div>
                <div class="step" id="step-3">
                    <div class="circle"><i class="fa fa-truck"></i></div>
                    <div class="label">Đang giao hàng</div>
                </div>
                <div class="step" id="step-4">
                    <div class="circle"><i class="fa fa-star"></i></div>
                    <div class="label">Giao hàng thành công</div>
                </div>
            </div>
        </div>
        @include('footer')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const orderStatus = "{{ $customer->order_status }}";

            // Map trạng thái từ database tới các bước
            const statusMap = {
                'Đang chờ xác nhận': 1,
                'Lắp ráp, cài đặt': 2,
                'Đang giao hàng': 3,
                'Giao hàng thành công': 4
            };

            // Cập nhật giao diện dựa trên trạng thái hiện tại
            const currentStatusStep = statusMap[orderStatus];
            updateProgress(currentStatusStep);
        });

        function updateProgress(status) {
            for (let i = 1; i <= status; i++) {
                const stepElement = document.getElementById(`step-${i}`);
                if (stepElement) {
                    const circle = stepElement.querySelector('.circle');
                    const label = stepElement.querySelector('.label');
                    circle.classList.add('active');
                    label.classList.add('active');
                    if (stepElement.querySelector('.line')) {
                        stepElement.querySelector('.line').classList.add('active');
                    }
                    stepElement.classList.add('active');
                }
            }
        }
    </script>
</body>
</html>
