

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.smartaddons.com/templates/html/topdeal/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 03 May 2024 08:50:36 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
   @include('head')
</head>

<body class="account-login account res layout-1">

<div id="wrapper" class="wrapper-fluid banners-effect-10">


    <!-- Header Container  -->
    @include('header')
    <!-- //Header Container  -->


    <!-- Main Container  -->

    <div class="container">
        <div class="row">
            <ul class="breadcrumb">
                <li><a href="/"><i class="fa fa-home"> Trang chủ</i></a></li>
                <li><a href="#">Account</a></li>
                <li><a href="#">Login</a></li>
            </ul>
            <div id="content" class="col-md-9">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="well ">
                            <h2>Bạn là người mới</h2>
                            <p><strong>Đăng ký tài khoản</strong></p>
                            <p>Bằng cách tạo tài khoản, bạn sẽ có thể mua sắm nhanh hơn, cập nhật trạng thái đơn hàng và theo dõi các đơn hàng bạn đã thực hiện trước đó.</p>
                            <a href="{{route('register')}}" class="btn btn-primary">Tạo tài khoản ngay</a></div>
                    </div>
                    <div class="col-sm-6">

                        <div class="well col-sm-12">

                            <h2>Đăng Nhập Tài Khoản</h2>
                            <p><strong>Tôi là thành viên</strong></p>
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label" for="input-email">Nhập Tài Khoản E-mail</label>
                                    <input type="text" name="email" value="" placeholder="Nhập Email" id="input-email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="input-password">Mật Khẩu</label>
                                    <input type="password" name="password" value="" placeholder="Mật khẩu" id="input-password" class="form-control" required>
                                    <a href="#">Bạn quên mật khẩu?</a>
                                </div>
                                <div class="icheck-primary">
                                    <input type="checkbox" name="remember" id="remember">
                                    <label for="remember">
                                        Lưu tài khoản
                                    </label>
                                </div>

                                <input type="submit" value="Đăng Nhập" class="btn btn-primary pull-left">

                            <column id="column-login" class="col-sm-8 pull-right">
                                <div class="row">
                                    <div class="social_login pull-right" id="so_sociallogin">
                                        <a href="#" class="btn btn-social-icon btn-sm btn-facebook"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></a>
                                        <a href="#" class="btn btn-social-icon btn-sm btn-google-plus"><i class="fa fa-google fa-fw" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </column>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- //Main Container -->


    <!-- Footer Container -->
    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Kiểm tra xem có thông báo thành công từ controller không
            @if(session('success'))
            // Nếu có, hiển thị hộp thoại thông báo thành công
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
            @endif

            // Kiểm tra xem có thông báo lỗi từ controller không
            @if(session('error'))
            // Nếu có, hiển thị hộp thoại thông báo lỗi
            Swal.fire({
                icon: 'error',
                title: 'Thất bại!',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
            @endif
        });
    </script>
</div>
</body>
</html>
