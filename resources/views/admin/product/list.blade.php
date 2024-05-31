@extends('admin.main')
<!-- kế thừa từ main -->

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="">ID</th>
            <th>Tên Sản Phẩm</th>
            <th>Danh Mục</th>
            <th>Giá Gốc</th>
            <th>Giá Khuyến Mãi</th>
            <th>Kích Hoạt</th>
            <th>Cập Nhật</th>
            <th style="">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $key => $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->menu-> name }}</td> {{--  sử dụng toán tử an toàn menu? thay vì menu--}}
                <td>{{ $product->price }}</td>
                <td>{{ $product->price_sale }}</td>
                <td>{!! \App\Helpers\Helper::active($product->active) !!}</td>
                <td>{{ $product->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/products/edit/{{ $product->id }}" >
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="#"
                       onclick="removeRow({{$product->id}}, '/admin/products/destroy' )">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
        {!! $products->links() !!}
    </div>
@endsection
