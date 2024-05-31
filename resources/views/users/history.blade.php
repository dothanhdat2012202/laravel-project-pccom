<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
</head>
<body class="account res layout-1 layout-subpage">
    <div id="wrapper" class="wrapper-fluid banners-effect-5">
        @include('header')
        <div class="main-container container">
            <ul class="breadcrumb">
                <li><a href="/"><i class="fa fa-home"></i> Trang chủ</a></li>
                <li><a href="/history_cart">Lịch sử mua hàng</a></li>
            </ul>
            <div class="row">
                <div id="content">
                    <h2 class="title" style="padding-left: 20px;">Lịch sử đơn hàng</h2>
                    @if ($customers->isEmpty())
                        <h4 class="text-center">Không tìm thấy lịch sử mua của khách hàng.</h4>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Tên Khách Hàng</th>
                                        <th>Email</th>
                                        <th>Số Điện Thoại</th>
                                        <th class="text-center">Địa Chỉ</th>
                                        <th class="text-center">Phương Thức Thanh Toán</th>
                                        <th class="text-center">Ngày Đặt Hàng</th>
                                        <th style="">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td class="text-center">{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td class="text-center">{{ $customer->phone }}</td>
                                            <td>{{ $customer->street }}, {{ $customer->ward }}, {{ $customer->district }}, {{ $customer->city }}</td>
                                            <td class="text-center">{{ $customer->payment_method }}</td>
                                            <td class="text-center">{{ $customer->created_at }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" href="/history_cart/view/{{ $customer->id }}" >
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @include('footer')
    </div>
</body>
</html>
