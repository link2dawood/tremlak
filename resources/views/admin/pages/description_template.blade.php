@extends('admin.layouts.master')
@section('pageTitle', __('admin.Description'))
@section('content')
    {{--    {{dd($desceiption[1]->body)}}--}}
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{__('admin.Dashboard')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{('admin.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('admin.Dashboard')}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class=" pt-4">
                <div class="col-md-12">
                    <div class="card table-overflow" style="min-height: 0px !important;">
                        <div class="card-body">
                            <div class=" d-flex justify-content-between">
                                <h3>{{__('admin.Dictionary')}}</h3>

                            </div>
                            <div class="card-body">
                                <ul class="m-0 p-0 ">
                                    <h4 class="">{{__('admin.Form Builder Inputs')}}</h4>
                                    <div class="row d-flex">
                                        <div class="form-group col-md-12 ">

                                            @foreach($required_labels as $label )
                                                <li> <span class="fw-bold mb-2 " >{{$label->label}}: </span>  <span class="me-2">{ {{str_replace(' ','_',$label->label)}} } </span></li>
                                            @endforeach
                                        </div>
                                    </div>
                                    <h4 class="my-3">{{__('admin.Features')}}</h4>
                                    <div class="row d-flex ">
                                        <div class="form-group col-md-12 mb-3">

                                            @foreach($outlooks as $looks )
                                                {{--                                                <li> <span class="fw-bold mb-2 " >{{$looks->title}}: </span> <span class="me-2">{ {{str_replace(' ','_',$looks->title)}} } </span></li>--}}
                                                <li> <span class="fw-bold mb-2 " >{{$looks->title}}: </span> <span class="me-2">{ {{str_replace(' ','_',$looks->title)."::text"}} } Or { {{str_replace(' ','_',$looks->title) .":: text in case true || text in case false"}} } </span></li>
                                            @endforeach
                                        </div>
                                    </div>
                                    <h4 class="my-3">{{__('admin.Select Options')}}</h4>
                                    <div class="row mb-3 ">

                                        @if($selected_type == 1)
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Type of apartment')}}: </span>  <span class="me-2">{ type } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Condition')}}: </span>  <span class="me-2">{ conditionp } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Gross m²')}}: </span>  <span class="me-2">{ grossm2 } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Net m²')}}: </span>  <span class="me-2">{ netm2 } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Bedrooms')}}: </span>  <span class="me-2">{ bed_rooms } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Living rooms')}}: </span>  <span class="me-2">{ living_rooms } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Bathrooms')}}: </span>  <span class="me-2">{ bath_rooms } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Age')}}: </span>  <span class="me-2">{ age } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Status')}}: </span>  <span class="me-2">{ status } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Floors')}}: </span>  <span class="me-2">{ floors } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Building-Floors')}}: </span>  <span class="me-2">{ building_floors } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Heating')}}: </span>  <span class="me-2">{ heating } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Elevator')}}: </span>  <span class="me-2">{ elevator } </span></li>
                                        @elseif($selected_type ==2)

                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Condition')}}: </span>  <span class="me-2">{ conditionp } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Villa m² gross')}}: </span>  <span class="me-2">{ grossm2 } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Villa m² net')}}: </span>  <span class="me-2">{ netm2 } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Land m²')}}: </span>  <span class="me-2">{ landm2 } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Bedrooms')}}: </span>  <span class="me-2">{ bed_rooms } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Living rooms')}}: </span>  <span class="me-2">{ living_rooms } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Bathrooms')}}: </span>  <span class="me-2">{ bath_rooms } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Age')}}: </span>  <span class="me-2">{ age } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Floors')}}: </span>  <span class="me-2">{ floors } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Garden')}}: </span>  <span class="me-2">{ garden } </span></li>

                                        @elseif($selected_type ==3)

                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Condition')}}: </span>  <span class="me-2">{ conditionp } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.House m² gross')}}: </span>  <span class="me-2">{ grossm2 } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.House m² net')}}: </span>  <span class="me-2">{ netm2 } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Land m²')}}: </span>  <span class="me-2">{ landm2 } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Bedrooms')}}: </span>  <span class="me-2">{ bed_rooms } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Living rooms')}}: </span>  <span class="me-2">{ living_rooms } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Bathrooms')}}: </span>  <span class="me-2">{ bath_rooms } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Age')}}: </span>  <span class="me-2">{ age } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Floors')}}: </span>  <span class="me-2">{ floors } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Garden')}}: </span>  <span class="me-2">{ garden } </span></li>

                                        @elseif($selected_type ==4)

                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Condition')}}: </span>  <span class="me-2">{ conditionp } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Building m²')}}: </span>  <span class="me-2">{ grossm2 } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Flats in Building')}}: </span>  <span class="me-2">{ flats } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Shops in Building')}}: </span>  <span class="me-2">{ shops } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Storage Rooms in Building')}}: </span>  <span class="me-2">{ storage_rooms } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Age')}}: </span>  <span class="me-2">{ age } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Floors')}}: </span>  <span class="me-2">{ floors } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Elevator')}}: </span>  <span class="me-2">{ elevator } </span></li>

                                        @elseif($selected_type ==5)

                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Land m²')}}: </span>  <span class="me-2">{ landm2 } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Status')}}: </span>  <span class="me-2">{ status } </span></li>
                                            <li class="col-md-4"> <span class="fw-bold mb-2 " >{{__('agent.Type of land')}}: </span>  <span class="me-2">{ type } </span></li>

                                        @else
                                        @endif

                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card table-overflow">
                        <div class="card-body">
                            <div class=" my-3 d-flex justify-content-between">
                                <h3>{{__('admin.Dashboard')}}</h3>

                            </div>
                            <div class="card-body">
                                <form action='{{ route('description_template') }}' method="post" id="myform">
                                    @csrf
                                    <div class="row d-flex align-items-center mb-3">
                                        <div class="col-md-4">
                                            <label class="heading-color ff-heading fw600">{{__('admin.Property Types')}}</label>
                                            <div class="location-area">
                                                <select class="form-select" name="property_type" id="">
                                                    {{--                                                    <option value="">---Select typ---</option>--}}
                                                    @foreach($propertyType_global as $type)
                                                        <option
                                                            {{$selected_type == $type->id ? 'selected' : ''}} value="{{$type->id}}">{{$type->property_type_details[0]->title}}</option>
                                                    @endforeach

                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn mt-4 btn-dark ">
                                                {{__('admin.Load')}}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <form action='{{ route('description_template_update') }}' method="post" id="myform">
                                    @csrf
                                    <input type="hidden" value="{{$selected_type}}" name="property_type">
                                    <!-- /.box-header -->
                                    <div class="box-body">

                                        <div class="box-group" id="accordion">
                                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                            @foreach ($language_global as $key => $language)
                                                <div class="panel box mt-3">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                            <a data-bs-toggle="collapse" data-bs-parent="#accordion"
                                                               href="#collapse{{ $language->short_name }}"
                                                               aria-expanded="false" class="collapsed">
                                                                {{ $language->name }}
                                                            </a>
                                                        </h4>
                                                    </div>

                                                    <div id="collapse{{ $language->short_name }}"
                                                         class="panel-collapse collapse" aria-expanded="false"
                                                         style="height: 0px;">
                                                        <div class="box-body">
                                                            <div class="form-group col-md-12 mb-3">
                                                                <label for="exampleInputEmail1">{{__('admin.Title')}}</label>
                                                                <input class="form-control f-14"
                                                                       name="{{ $language->short_name }}[title]"
                                                                       type="text" value="{{$desceiption[$key]->title ?? 'Title' }}">

                                                                <input type="hidden" name="{{ $language->short_name }}[id]"
                                                                       value="{{ $language->id }}">
                                                            </div>
                                                            <div class="form-group col-md-12 mb-3">
                                                        <textarea
                                                            name="{{ $language->short_name }}[body]"
                                                            class="form-control f-14 editor"
                                                            rows="10"
                                                        >{!! $desceiption[$key]->body ?? 'Description' !!}</textarea>
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
                                            <button type="submit" class="btn btn-dark ">{{__('admin.Update')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
        $(document).ready(function () {
            $("#description_templateli").addClass("nav-active");

            $("#property_settings_nev").addClass("active");
            $("#property_settings_nev").removeClass("collapse");
            $("#property_settings_nev_link").removeClass("collapsed");
            $("#property_settings_nev_link").addClass("active");
            // $(".editor").text($("textarea.editor").val().trim())
        });


        tinymce.init({
            selector: '.compose-textarea',
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
            },
            toolbar: "undo redo | styleselect | fontselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent",
            font_formats: "Noto-Nastaliq-Urdu = Noto Nastaliq Urdu; Noto-Sans-Arabic = Noto Sans Arabic;Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Oswald=oswald; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats",
            content_style: "@import url('https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400;500;600;700&family=Noto+Sans+Arabic:wght@100;200;300;400;500;600;700;800;900&display=swap'); body { font-family: Noto-Nastaliq-Urdu; }",
            height: 300,
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


