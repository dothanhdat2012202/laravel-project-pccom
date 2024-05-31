@extends('admin.main')

@section('content')
<form action="{{ route('blog.update', $blog->id) }}" method="POST">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Tiêu đề tin tức</label>
                    <input type="text" name="name" value="{{ old('name', $blog->name) }}" class="form-control" id="menu" placeholder="Nhập tên sản phẩm">
                </div>
            </div>
            <div class="form-group">
                <label for="menu">Ảnh đại diện</label>
                <input type="file" class="form-control" id="upload">
                <div id="image_show">
                    <a href="{{ $blog->thumb }}" target="_blank">
                        <img src="{{ $blog->thumb }}" width="100px">
                    </a>
                </div>
                <input type="hidden" name="thumb" value="{{ old('thumb', $blog->thumb) }}" id="thumb">
            </div>
        </div>
        <div class="form-group">
            <label>Nội dung</label>
            <textarea name="content" id="content" class="form-control">{{ old('content', $blog->content) }}</textarea>
        </div>
        <div class="form-group">
            <label>Kích hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="1" type="radio" id="active" name="active" {{ $blog->active == 1 ? 'checked' : '' }}>
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="0" type="radio" id="notactive" name="active" {{ $blog->active == 0 ? 'checked' : '' }}>
                <label for="notactive" class="custom-control-label">Không</label>
            </div>
        </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Chỉnh sửa tin tức</button>
    </div>
    @csrf
</form>
@endsection

@section('footer')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
