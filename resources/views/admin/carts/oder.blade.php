@extends('admin.main')
<!-- kế thừa từ main -->

@section('content')
<table class="table">
    <thead>
    <tr>
        <th style="">ID</th>
        <th>Tên Khách Hàng</th>
        <th class="text-center">Địa Chỉ </th>
        <th class="text-center">Phương thức thanh toán</th>
        <th class="text-center">Ngày Đặt Hàng</th>
        <th class="text-center">Trạng thái đơn hàng</th>
        <th style="">&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $key => $customer)
        <tr>
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{$customer->street}},{{$customer->ward}},{{$customer->district}},{{$customer->city}}</td>
            <td class="text-center">{{$customer->payment_method}}</td>
            <td class="text-center">{{ $customer->created_at }}</td>
            <td class="text-center">{{ $customer->order_status }}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="/admin/customers/view/{{ $customer->id }}" >
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a class="btn btn-primary btn-sm" href="{{ route('admin.customers.update', $customer->id) }}">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="card-footer clearfix">
    {!! $customers->links() !!}
</div>
@endsection
