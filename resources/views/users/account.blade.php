<!DOCTYPE html>
<html lang="en">

@include('head')

<body class="account res layout-1 layout-subpage">

    <div id="wrapper" class="wrapper-fluid banners-effect-10">

    @include('header')

    <div class="main-container container">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li><a href="/my_account">Tài khoản</a></li>
            <li><a href="#">Tài khoản của tôi</a></li>
        </ul>

        <div class="row">
            <div class="col-md-9" id="content">
                <h2 class="title">Tài khoản của tôi</h2>
                @if(\Illuminate\Support\Facades\Auth::check())
                    <p class="lead">Xin chào, <strong>{{\Illuminate\Support\Facades\Auth::user()->name}}!</strong> - Cập nhật thông tin tài khoản của bạn.</p>
                @else
                    <p class="lead">Xin chào, <strong>Khách!</strong> - Bạn cần đăng nhập để cập nhật thông tin tài khoản của bạn.</p>
                @endif

                @if (\Illuminate\Support\Facades\Auth::check())
                    <form action="{{ route('update-account') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <fieldset id="personal-details">
                                    <legend>Thông tin cá nhân</legend>
                                    <div class="form-group input-lastname required">
                                        <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="Nhập họ tên của bạn *" id="name" class="form-control" required>
                                    </div>
                                    <div class="form-group required">
                                        <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="Email của bạn *" id="email" class="form-control" required>
                                    </div>
                                    <div class="form-group required">
                                        <input type="text" name="phone" value="{{ Auth::user()->phone }}" placeholder="Nhập số điện thoại của bạn *" id="phone" class="form-control">
                                    </div>
                                </fieldset>
                                <br>
                            </div>
                            <div class="col-sm-6">
                                <fieldset>
                                    <legend>Đổi mật khẩu</legend>
                                    <div class="form-group required">
                                        <label for="old-password" class="control-label">Mật khẩu cũ</label>
                                        <input type="password" class="form-control" placeholder="Mật khẩu cũ" name="old-password">
                                    </div>
                                    <div class="form-group required">
                                        <label for="new-password" class="control-label">Mật khẩu mới</label>
                                        <input type="password" class="form-control" placeholder="Mật khẩu mới" name="new-password">
                                    </div>
                                    <div class="form-group required">
                                        <label for="new-password_confirmation" class="control-label">Nhập lại mật khẩu mới</label>
                                        <input type="password" class="form-control" placeholder="Nhập lại mật khẩu mới" name="new-password_confirmation">
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <fieldset id="shipping-address">
                                    <legend>Địa chỉ giao hàng</legend>
                                    <div id="address" name="addresss" style="display: block">
                                        <div class="form-group required">
                                            <select name="city" id="city" class="form-control">
                                                <option value="">Tỉnh/ Thành phố</option>
                                                <option value="{{ Auth::user()->city }}" selected>{{ Auth::user()->city }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group required">
                                            <select name="district" id="district" class="form-control">
                                                <option value="">Quận/ Huyện</option>
                                                <option value="{{ Auth::user()->district }}" selected>{{ Auth::user()->district }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group required">
                                            <select name="ward" id="ward" class="form-control">
                                                <option value="">Phường/ Xã</option>
                                                <option value="{{ Auth::user()->ward }}" selected>{{ Auth::user()->ward }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group company-input">
                                            <input type="text" name="street" value="{{ Auth::user()->street }}" placeholder="Số nhà, tên đường" id="street" class="form-control">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="buttons clearfix">
                            <div class="pull-right">
                                <input type="submit" class="btn btn-md btn-primary" value="Lưu lại">
                            </div>
                        </div>
                    </form>
                @endif
            </div>

            <aside class="col-md-3 col-sm-4 col-xs-12 content-aside right_column sidebar-offcanvas">
                <span id="close-sidebar" class="fa fa-times"></span>
                <div class="module">
                    <h3 class="modtitle"><span>Danh mục </span></h3>
                    <div class="module-content custom-border">
                        <ul class="list-box">
                            <li><a href="{{ route('history_cart') }}">Lịch sử mua hàng</a></li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    @include('footer')
</body>

</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
        method: "GET",
        responseType: "application/json",
    };
    var promise = axios(Parameter);
    promise.then(function (result) {
        renderCity(result.data);
    });

    function renderCity(data) {
        for (const x of data) {
            citis.options[citis.options.length] = new Option(x.Name, x.Name);
        }
        citis.onchange = function () {
            district.length = 1;
            ward.length = 1;
            if (this.value != "") {
                const result = data.filter(n => n.Name === this.value);
                for (const k of result[0].Districts) {
                    district.options[district.options.length] = new Option(k.Name, k.Name);
                }
            }
        };
        district.onchange = function () {
            ward.length = 1;
            const dataCity = data.filter((n) => n.Name === citis.value);
            if (this.value != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Name === this.value)[0].Wards;
                for (const w of dataWards) {
                    wards.options[wards.options.length] = new Option(w.Name, w.Name);
                }
            }
        };
    }
</script>
<script>
    function showSuccessAlert(message) {
        Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            text: message,
        });
    }

    function showErrorAlert(message) {
        Swal.fire({
            icon: 'error',
            title: 'Lỗi!',
            text: message,
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        @if(Session::has('success'))
            showSuccessAlert("{{ Session::get('success') }}");
        @endif

        @if ($errors->any())
            showErrorAlert("{{ $errors->first() }}");
        @endif
    });
</script>
