@extends('admin.main')
<!-- kế thừa từ main -->

@section('content')
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
@endsection

