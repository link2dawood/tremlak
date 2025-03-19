@extends('pages.layouts.master')
@section('blog-mata')
    <title{{$blog->title}}</title>
    <meta name="description" content="{{$blog->seo_description}}">
    <meta name="keywords" content="{{$blog->seo_keywords}}">
    <meta name="author" content="{{$blog->seo_author}}">
    <link rel="canonical" href="{{$blog->seo_canonical}}">
@endsection
@section('blog-style')
<style>

    table , tr , td{
        border: 1px solid #000000;
    }
    img{
        max-width: 100%;
    }
    a{
        color:#e30a17;
    }
    .mxw-80Per img{
        margin: auto!important;
        justify-content: center !important;
        border-radius: 20px !important;

    }
</style>
@endsection
@section('content')
    <section class="our-blog pt50">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-delay="100ms">
                <div class="col-lg-12">
                    <h2 class="blog-title">{{$blog->title}}</h2>
                    <div class="blog-single-meta">
                        <div class="post-author d-sm-flex align-items-center">
                            <?php
                            $image_path=getImageUrl($blog->cover_image->_id,400)
                            ?>
                            <a class="ml15" href="#">{{date('F, d, Y',$blog->_created)}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mxw-80Per mt-4">
            <div class="large-thumb"><img class="w-100" src="{{$image_path != '' ? $image_path : asset('blog/images/placeholder.png') }}" alt=""></div>
        </div>
        <div class="mx-auto mxw-80Per w-100" data-wow-delay="300ms">


            <br>
            <br>
            <br>
        </div>
        <div class="container">
            <div class="roww wow fadeInUp" data-wow-delay="500ms">
                <div class="col-xl-8 offset-xl-2">
                    {!! showBlogDescription($blog->content) !!}
{{--                    {!! $blog->content !!}--}}
                </div>
            </div>
        </div>
    </section>
@endsection
