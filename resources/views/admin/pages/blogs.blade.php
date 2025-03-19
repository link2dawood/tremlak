@extends('admin.layouts.master')
@section('pageTitle', 'Blogs')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Blogs</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row pt-4">
                <div class="card table-overflow">
                    <div class="card-body">
                        <div class=" my-3 d-flex justify-content-between">
                            <h3 class="">Blogs</h3>
                        </div>
                        <table class="table" id="example">
                            <thead>
                            <tr>
                                <th scope="col">ID#</th>
                                <th scope="col">Cover Image</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($blogs as $blog)
                                <tr>
                                    <td>{{$blog->id}}</td>
                                    <td>

                                        <div class="avatar">
                                            <img class="rounded-circle w-100 h-100" src="{{$blog->image_path !='' ? asset($blog->image_path) :asset('agent/images/placeholder.png') }}">
                                        </div>

                                    </td>
                                    <td><a class="text-decoration-none" href="{{ route('blog_details',['slug' => $blog->slug])}}"> {{$blog['slug']}} </a></td>
                                    <td>
                                        @if($blog['status']==1)
                                            <span class="bg-success rounded-pill badge">Active</span>
                                        @else
                                            <span class="bg-danger rounded-pill badge">Blocked</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($blog['status']==1)
                                            <a class="btn btn-sm btn-info  my-1" onclick="UpdateBlogStatus(`{{$blog['id']}}`,0)" id="update_status{{$blog['id']}}" title="Block Blog"><i class="fa fa-ban"></i></a>
                                        @else
                                            <a class="btn btn-sm btn-success my-1" onclick="UpdateBlogStatus(`{{$blog['id']}}`,1)" id="update_status{{$blog['id']}}" title="Activate Blog"><i class="fa fa-check"></i></a>
                                        @endif
                                        <a class="btn btn-sm btn-danger my-1" onclick="deleteBlog(`{{$blog['id']}}`)" title="Delete Blog" id="delete_user{{$blog['id']}}" ><i class="fa fa-trash"></i></a>
                                        <a class="btn btn-sm btn-secondary my-1" href="{{route('update_blog',['slug'=>$blog->slug])}}" title="Edit Blog" ><i class="fa fa-edit"></i></a>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

@endsection
@section('script')

    <script>
        $(document).ready(function() {
            $("#blogsli").addClass("nav-active");
        });
    </script>

@endsection
