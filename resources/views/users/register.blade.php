

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.smartaddons.com/templates/html/topdeal/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 03 May 2024 08:50:36 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
   @include('head')
</head>

<body class="account res layout-1 layout-subpage">

<div id="wrapper" class="wrapper-fluid banners-effect-10">


    <!-- Header Container  -->
    @include('header')
    <!-- //Header Container  -->

    <!-- Main Container  -->
    <div class="main-container container">

        <ul class="breadcrumb">
            <li><a href="/"><i class="fa fa-home"> Trang chủ</i></a></li>
            <li><a href="#">Tài khoản</a></li>
            <li><a href="#">Tạo tài khoản</a></li>
        </ul>

        <div class="row ">
            <div id="content" class="col-md-9">
                <h2 class="title">Đăng Ký Tài Khoản</h2>
                <p>Nếu bạn đã có tài khoản với chúng tôi, vui lòng đăng nhập tại trang đăng nhập</a>.</p>
                <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal account-register clearfix">
                    @csrf
                    <fieldset id="account">
                        <legend>Thông Tin Cá Nhân Của Bạn</legend>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-name">Họ và tên</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" value="" placeholder="Nhập tên của bạn" id="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" value="" placeholder="Nhập E-Mail của bạn" id="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-telephone">Số điện thoại</label>
                            <div class="col-sm-10">
                                <input type="number" name="phone" value="" placeholder="Nhập số điện thoại" id="telephone" class="form-control" required>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Mật khẩu của bạn</legend>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-password">Mật khẩu</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" value="" placeholder="Nhập mật khẩu" id="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-confirm">Nhập lại mật khẩu</label>
                            <div class="col-sm-10">
                                <input type="password" name="confirm" value="" placeholder="Nhập lại mật khẩu" id="confirm" class="form-control" required>
                            </div>
                        </div>
                    </fieldset>
                    <div class="buttons">
                        <div class="pull-right">
                            <a href="{{ route('login_user') }}" style="padding-right: 20px">Tôi đã có tài khoản</a>
                            <input type="submit" value="Tạo tài khoản" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- //Main Container -->


    <!-- Footer Container -->
    @include('footer')

</body>
</html>
