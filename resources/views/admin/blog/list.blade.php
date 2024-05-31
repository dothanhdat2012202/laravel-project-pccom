@extends('admin.main')

@section('content')
    <h1>Danh sách Blog</h1>
    <table class="table">
        <thead>
            <tr>
                <th  class="text-center">ID</th>
                <th  class="text-left">Tiêu đề tin tức</th>
                <th class="text-center">Ảnh đại diện</th>
                <th>Cập Nhật</th>
                <th>Active</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $blog)
                <tr>
                    <td  class="text-center">{{ $blog->id }}</td>
                    <td class="text-left">{{ $blog->name }}</td>
                    <td  class="text-center"><a href="{{$blog->thumb}}" target="_blank">
                        <img src="{{ $blog->thumb }}" height="40px">
                    </a>
                    </td>
                    <td>{{ $blog->updated_at }}</td>
                    <td>{!! \App\Helpers\Helper::active($blog->active) !!}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/blog/edit/{{ $blog->id }}" >
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="#"
                           onclick="removeRow({{$blog->id}}, '/admin/blog/destroy' )">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
