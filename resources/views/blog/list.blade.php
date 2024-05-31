@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  @include('head')
  <style>
    .article-date {
        display: flex;
        align-items: center;
    }
    .article-date i {
        margin-right: 5px;
        position: relative;
        top: 1px; /* Adjust this value to align with text */
    }
    .article-date p {
        margin: 0; /* Ensure there's no extra margin pushing the text down */
    }
  </style>
</head>

<body class="res layout-1">

<div id="wrapper" class="wrapper-fluid banners-effect-10">

    <!-- Header Container  -->
  @include('header')

    <!-- Main Container  -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="title-breadcrumb">
                {{$title}}
            </div>
            <ul class="breadcrumb-cate">
                <li><a href="/"><i class="fa fa-home"></i> Trang chủ</a></li>
                <li><a href="">{{$title}}</a></li>
            </ul>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div id="content" class="col-sm-12">
                <div class="blog-header">
                    <h3>Thủ thuật-Mẹo công nghệ</h3>
                </div>
                <div class="blog-listitem row">
                    @foreach ($blogs as $blog)
                        @if ($blog->active == 1)
                        <div class="blog-item col-md-6 col-sm-6">
                            <div class="blog-item-inner">
                                <div class="itemBlogImg left-block">
                                    <div class="article-image banners">
                                        <div>
                                            <a class="popup-gallery" href="{{ $blog->thumb }}">
                                                <img src="{{ $blog->thumb }}" alt="{{ $blog->name }}" style="height: 433px">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="itemBlogContent right-block">
                                    <div class="blog-content">
                                        <div class="article-date">
                                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                            <p>{{ Carbon::parse($blog->updated_at)->locale('vi')->translatedFormat('l d/m/Y') }}</p>
                                        </div>
                                        <div class="article-title font-title">
                                            <h4><a href="{{ route('blog.show', $blog->id) }}">{!! \Illuminate\Support\Str::limit($blog->name, 60) !!}</a></h4>
                                        </div>
                                        <p class="article-description">
                                            {!! \Illuminate\Support\Str::limit($blog->content, 150) !!}
                                        </p>
                                        <div class="blog-meta">
                                            <span class="author"><span>Đăng bởi </span>Admin</span>
                                        </div>
                                        <div class="readmore hidden">
                                            <a class="btn-readmore font-title" href="{{ route('blog.show', $blog->id) }}">Đọc thêm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

<!-- //Main Container -->

<!-- Footer Container -->
@include('footer')
<!-- end Footer Container -->

</div>
</body>
</html>
