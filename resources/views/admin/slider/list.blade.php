@extends('admin.main')
<!-- kế thừa từ main -->

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="">ID</th>
            <th>Tiêu Đề</th>
            <th>Link</th>
            <th>Ảnh</th>
            <th>Trạng Thái</th>
            <th>Cập Nhật</th>
            <th style="">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sliders as $key => $slider)
            <tr>
                <td>{{ $slider->id }}</td>
                <td>{{ $slider->name }}</td>
                <td>{{ $slider->url }}</td>
                <td><a href="{{$slider->thumb}}" target="_blank">
                        <img src="{{ $slider->thumb }}" height="40px">
                    </a>
                </td>

                <td>{!! \App\Helpers\Helper::active($slider->active) !!}</td>
                <td>{{ $slider->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/sliders/edit/{{ $slider->id }}" >
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="#"
                       onclick="removeRow({{$slider->id}}, '/admin/sliders/destroy' )">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $sliders->links() !!}
@endsection