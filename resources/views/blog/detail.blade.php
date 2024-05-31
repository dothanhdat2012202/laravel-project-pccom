@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
    <style>
        .center-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Đảm bảo chiều cao tối thiểu 100% chiều cao viewport */
        }
        .blog-detail {
            max-width: 800px; /* Giới hạn độ rộng của nội dung */
            width: 100%; /* Đảm bảo nó chiếm toàn bộ chiều rộng trong khung */
        }
        .article-date {
            display: flex;
            align-items: center;
        }
        .article-date i {
            margin-right: 5px;
            position: relative;
            top: 1px; /* Điều chỉnh giá trị này để căn chỉnh với văn bản */
        }
        .article-date p {
            margin: 0; /* Đảm bảo không có margin đẩy văn bản xuống */
        }
    </style>
</head>
<body class="res layout-1">
<div id="wrapper" class="wrapper-fluid banners-effect-10">
    @include('header')

    <div class="breadcrumbs">
        <div class="container">
            <div class="title-breadcrumb">
                {{ $title }}
            </div>
            <ul class="breadcrumb-cate">
                <li><a href="/"><i class="fa fa-home"></i> Trang chủ</a></li>
                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                <li><a href="">{{ $title }}</a></li>
            </ul>
        </div>
    </div>

    <div class="container center-content">
        <div class="row">
            <div id="content" class="col-sm-12">
                <div class="blog-detail">
                    <h1>{{ $blog->name }}</h1>
                    <div class="blog-meta">
                        <span class="article-date">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <p>{{ Carbon::parse($blog->updated_at)->locale('vi')->translatedFormat('l d/m/Y') }}</p>
                        </span>
                        <span class="author">Đăng bởi Admin</span>
                    </div>
                    <div class="blog-content">
                        <p>{!! $blog->content !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('footer')
</div>
</body>
</html>
