@extends('admin.main')
<!-- kế thừa từ main -->

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="">ID</th>
            <th>Tên Khách Hàng</th>
            <th>Email</th>
            <th>Số Điện Thoại</th>
            <th>Địa Chỉ </th>
            <th>Phương thức thanh toán</th>
            <th>Ngày Đặt Hàng</th>
            <th style="">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $key => $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email}}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{$customer->street}},{{$customer->ward}},{{$customer->district}},{{$customer->city}}</td>
                <td>{{$customer->payment_method}}</td>
                <td>{{ $customer->created_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/customers/view/{{ $customer->id }}" >
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="#"
                       onclick="removeRow({{$customer->id}}, '/admin/customers/destroy' )">
                        <i class="fas fa-trash"></i>
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

