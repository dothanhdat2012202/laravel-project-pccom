@extends('admin.main')
<!-- kế thừa từ main -->

@section('content')
<form action="{{ route('imeis.store') }}" method="POST">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="product_id">Chọn sản phẩm:</label>
                    <select name="product_id" id="product_id" class="form-control">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="imei">Mã IMEI/Serial Number:</label>
                    <input type="text" name="imei" id="imei" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="start_date">Ngày bắt đầu bảo hành:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="end_date">Ngày hết hạn bảo hành:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Tạo thông tin bảo hành</button>
    </div>
</form>
@endsection
