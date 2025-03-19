@extends('pages.layouts.master')
@section('pageTitle',__('user.Blogs'))
@section('content')
    <section class="breadcumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcumb-style1">
                        <h2 class="title">{{__('user.Blogs')}}</h2>
                        <div class="breadcumb-list">
                            <a href="{{route('/')}}">{{__('user.home')}}</a>
                            <a href="#">{{__('user.Blogs')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="our-blog pt-0">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-delay="300ms">
                <div class="col-xl-12">
                    <div class="navpill-style1">
                        <div class="row">
                            @foreach($blogs as $blog)
                                    <?php
                                    $image_path=getImageUrl($blog->cover_image->_id,400)
                                    ?>
                                <div class="col-sm-6 col-lg-4">
                                    <a href="{{ route('blog_details',['slug' => $blog->slug])}}">
                                        <div class="blog-style1">
                                            <div class="blog-img new_blog_cover_img"><img class="w-100" src="{{$image_path != '' ? $image_path : asset('blog/images/placeholder.png') }}" alt=""></div>
                                            <div class="blog-content">
                                                <div class="date">
                                                    <span class="month">{{date('F',$blog->_created)}}</span>
                                                    <span class="day">{{date('d',$blog->_created)}}</span>
                                                </div>
                                                {{--                                            <a class="tag" href="#">Living Room</a>--}}
                                                <h6 class="title mt-1">{{$blog->title}}</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{--            <div class="row">--}}
            {{--                <div class="mbp_pagination text-center">--}}
            {{--                    <ul class="page_navigation">--}}
            {{--                        <li class="page-item">--}}
            {{--                            <a class="page-link" href="#"> <span class="fas fa-angle-left"></span></a>--}}
            {{--                        </li>--}}
            {{--                        <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
            {{--                        <li class="page-item active" aria-current="page">--}}
            {{--                            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>--}}
            {{--                        </li>--}}
            {{--                        <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
            {{--                        <li class="page-item"><a class="page-link" href="#">4</a></li>--}}
            {{--                        <li class="page-item"><a class="page-link" href="#">5</a></li>--}}
            {{--                        <li class="page-item"><a class="page-link" href="#">...</a></li>--}}
            {{--                        <li class="page-item"><a class="page-link" href="#">20</a></li>--}}
            {{--                        <li class="page-item">--}}
            {{--                            <a class="page-link" href="#"><span class="fas fa-angle-right"></span></a>--}}
            {{--                        </li>--}}
            {{--                    </ul>--}}
            {{--                    <p class="mt10 pagination_page_count text-center">1 – 20 of 300+ property available</p>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </section>
@endsection
