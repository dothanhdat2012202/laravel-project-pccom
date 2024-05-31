@extends('admin.main')

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tên Sản Phẩm</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="menu" placeholder="Nhập tên sản phẩm">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Danh mục</label>
                        <select class="form-control" name="menu_id" id="menu_id">
                            <option value="0">Danh Mục Cha</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Danh mục con</label>
                        <select class="form-control" name="children_id" id="children_id">
                            <option value="0">Chọn danh mục con</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Giá Gốc</label>
                        <input type="number" name="price" value="{{ old('price') }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Giá Giảm</label>
                        <input type="number" name="price_sale" value="{{ old('price_sale') }}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Mô Tả</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label>Mô Tả Chi Tiết</label>
                <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
            </div>

            <div class="form-group">
                <label for="menu">Ảnh Mô Tả</label>
                <input type="file" class="form-control" id="upload">
                <div id="image_show">

                </div>
                <input type="hidden" name="thumb" id="thumb">
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="notactive" name="active" >
                    <label for="notactive" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo Sản Phẩm</button>
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
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });

        document.getElementById('menu_id').addEventListener('change', function() {
            let menuId = this.value;
            if (menuId != 0) {
                fetch(`/admin/menus/${menuId}/children`)
                    .then(response => response.json())
                    .then(data => {
                        let childrenSelect = document.getElementById('children_id');
                        childrenSelect.innerHTML = '<option value="0">Chọn danh mục con</option>';
                        data.forEach(child => {
                            let option = document.createElement('option');
                            option.value = child.id;
                            option.textContent = child.name;
                            childrenSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('children_id').innerHTML = '<option value="0">Chọn danh mục con</option>';
            }
        });
    </script>
@endsection
