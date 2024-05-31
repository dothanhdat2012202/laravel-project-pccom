@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sản phẩm</th>
                <th>IMEI/Serial Number</th>
                <th>Ngày bắt đầu bảo hành</th>
                <th>Ngày hết hạn bảo hành</th>
            </tr>
        </thead>
        <tbody>
            @foreach($imeis as $imei)
            <tr>
                <td>{{ $imei->id }}</td>
                <td>{{ $imei->product ? $imei->product->name : 'N/A' }}</td>
                <td>{{ $imei->imei }}</td>
                <td>{{ $imei->start_date }}</td>
                <td>{{ $imei->end_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
        {!! $imeis->links() !!}
    </div>
@endsection
