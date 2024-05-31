@extends('admin.main')

@section('content')
<div class="container">

    <form action="{{ route('admin.customers.updateStatus', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="order_status">Trạng thái đơn hàng:</label>
                <select name="order_status" id="order_status" class="form-control">
                    <option value="Đang chờ xác nhận" {{ $customer->order_status == 'Đang chờ xác nhận' ? 'selected' : '' }}>Đang chờ xác nhận</option>
                    <option value="Lắp ráp, cài đặt" {{ $customer->order_status == 'Lắp ráp, cài đặt' ? 'selected' : '' }}>Lắp ráp, cài đặt</option>
                    <option value="Đang giao hàng" {{ $customer->order_status == 'Đang giao hàng' ? 'selected' : '' }}>Đang giao hàng</option>
                    <option value="Giao hàng thành công" {{ $customer->order_status == 'Giao hàng thành công' ? 'selected' : '' }}>Giao hàng thành công</option>
                </select>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cập nhật trạng thái</button>
            </div>
        </div>
    </form>

</div>
@endsection
