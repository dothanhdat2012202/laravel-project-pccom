@extends('admin.main')
<!-- kế thừa từ main -->

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tiêu Đề</label>
                        <input type="text" name="name" value="{{ $slider->name }}" class="form-control"  placeholder="Nhập tên tiêu đề">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Đường Dẫn</label>
                        <input type="text" name="url" value="{{ $slider->url }}" class="form-control"  >
                    </div>
                </div>

            </div>

            <div class="form-group">
                <label for="menu">Ảnh Sảnh Phẩm</label>
                <input type="file" class="form-control" id="upload">
                <div id="image_show">
                    <a href="{{ $slider->thumb }}">
                        <img src="{{ $slider->thumb }}" width="100px">
                    </a>
                </div>
                <input type="hidden" name="thumb" value="{{ $slider->thumb }}" id="thumb">
            </div>

            <div class="form-group">
                <label>Sắp Xếp</label>
                <input type="number" name="sort_by" value="{{ $slider->sort_by }}" class="form-control">
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{ $slider->active ==1 ? 'checked' :'' }}
                    >
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="notactive" name="active"
                        {{ $slider->active ==0 ? 'checked' :'' }}>
                    <label for="notactive" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập Nhật Slider</button>
        </div>
        @csrf
    </form>
@endsection

