@extends('admin.main')
<!-- kế thừa từ main -->
@section('head')

@endsection

@section('content')
<form action="" method="POST">
    <div class="card-body">

      <div class="form-group">
        <label for="menu">Tên danh mục</label>
        <input type="text" name="name" class="form-control"  placeholder="Nhập tên danh mục">
      </div>

      <div class="form-group">
        <label>Danh mục</label>
        <select class="form-control" name="parent_id">
            <option value="0">Danh mục cha</option>
            @foreach($menus as $menu)
                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
            @endforeach
        </select>
      </div>

      <div class="form-group">
        <label >Mô tả</label>
        <textarea name="description" class="form-control"></textarea>
      </div>

      <div class="form-group">
        <label >Mô tả chi tiết</label>
        <textarea name="content" id="content" class="form-control"></textarea>
      </div>

      <div class="form-group">

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

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Tạo danh mục</button>
    </div>
    @csrf
  </form>

@endsection

@section('footer')
<script>
  ClassicEditor
      .create( document.querySelector( '#content' ) )
      .catch( error => {
          console.error( error );
      } );
</script>
@endsection
