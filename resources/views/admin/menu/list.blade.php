@extends('admin.main')
<!-- kế thừa từ main -->

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tên Danh Mục</th>
            <th>Kích Hoạt</th>
            <th>Cập Nhật</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        {!! \App\Helpers\Helper::menu($menus) !!}
        </tbody>
    </table>
@endsection
