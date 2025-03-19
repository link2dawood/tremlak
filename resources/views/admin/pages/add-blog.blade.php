@extends('admin.layouts.master')
@section('pageTitle', 'Add Blog')
@section('css')

    .mce-notification{
    display: none;
    }

@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Add Blog</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row pt-4">
                <div class="card table-overflow">
                    <div class="card-body">
                        <div class=" my-3 d-flex justify-content-between">
                            <h3 class="">Add Blog</h3>
                        </div>
                        <div class="card-body">
                            <form action='{{ route('save_blog') }}' method="post" id="myform">
                                @csrf
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row d-flex mb-3">
                                    <div class="form-group col-md-6 mb-3">
                                        <label class="fw-bold mb-2" for="">Mata Title</label>
                                        <input class="form-control f-14" required name="mata_title" type="text" value="">
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label class="fw-bold mb-2" for="">Mata Tags</label>
                                        <input class="form-control f-14" required name="mata_tags" type="text" value="">
                                    </div>
                                    <div class="form-group col-md-4 mb-3">
                                        <label class="fw-bold mb-2" for="">Cover Image</label>
                                        <input class="form-control f-14" required name="cover_picture" accept=".png, .jpg, .jpeg"type="file" value="">
                                    </div>
                                    <div class="form-group col-md-12 mb-3">
                                        <label class="fw-bold mb-2" for="">Mata Description</label>
                                        <input class="form-control f-14" required name="mata_description" type="text" value="">
                                    </div>
                                    </div>
                                    <div class="box-group" id="accordion">

                                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                        @foreach ($language_global as $key => $language)
                                            <!-- Escape the english details -->
                                            <div class="panel box mt-3">
                                                <div class="box-header with-border">
                                                    <h4 class="box-title">
                                                        <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#collapse{{ $language->short_name }}" aria-expanded="false" class="collapsed">
                                                            {{ $language->name }}
                                                        </a>
                                                    </h4>
                                                </div>

                                                <div id="collapse{{ $language->short_name }}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                    <div class="box-body">

                                                        <div class="form-group col-md-6 mb-3">
                                                            <label for="exampleInputEmail1">Title</label>
                                                            <input class="form-control f-14" name="{{ $language->short_name }}[subject]" type="text" value="Title">

                                                            <input type="hidden" name="{{ $language->short_name }}[id]" value="{{ $language->id }}">
                                                        </div>

                                                        <div class="form-group">
                                                        <textarea class="compose-textarea" name="{{ $language->short_name }}[body]" class="form-control f-14 editor" style="height: 300px">
                                                            Body
                                                        </textarea>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- /.box-body -->
                                <div class="box-footer my-2">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

@endsection
@section('script')
    <script src="{{asset('admin/assets/js/tinymce.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $("#add-blogli").addClass("nav-active");

        });

        var uploadRoute = '{{ route('upload-image') }}';
        tinymce.init({

            selector: 'textarea.compose-textarea',
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });
            },
            toolbar: "undo redo | styleselect | fontselect | link image | media | bold italic | alignleft aligncenter alignright alignjustify | outdent indent",
            font_formats: "Noto-Nastaliq-Urdu = Noto Nastaliq Urdu; Noto-Sans-Arabic = Noto Sans Arabic;Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Oswald=oswald; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats",
            content_style: "@import url('https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400;500;600;700&family=Noto+Sans+Arabic:wght@100;200;300;400;500;600;700;800;900&display=swap'); body { font-family: Noto-Nastaliq-Urdu; }",
            height: 500,
            plugins: 'image code media',
            automatic_uploads : true,
            file_picker_types: 'image',
            image_title: true,
            image_generaltab:false,
            image_sourcetab:false,
            images_upload_url: uploadRoute,
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];

                    var formData = new FormData(); // Create FormData object to send files
                    formData.append('file', file); // Append the file to FormData

                    fetch(uploadRoute, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content'), // Include CSRF token in headers
                        },
                        body: formData, // Set the body of the request to FormData
                    })
                        .then(response => response.json())
                        .then(data => {
                            cb(data.location, { title: file.name });
                        })
                        .catch(error => console.error('Error uploading image:', error));
                };
            }
        });
    </script>

    @if(session()->has('icon') && session()->has('title') && session()->has('text'))
        <script>
            Swal.fire({
                icon: '{{session('icon')}}',
                title: '{{session('title')}}',
                text: '{{session('text')}}',
            }).then(() => {

            });
        </script>
    @endif
@endsection


