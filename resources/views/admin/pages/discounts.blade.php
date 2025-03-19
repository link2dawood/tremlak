@extends('admin.layouts.master')
@section('pageTitle', __('admin.Credit Discounts'))
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{__('admin.Dashboard')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('admin.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('admin.Credit Discounts')}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row pt-4">
                <div class="card table-overflow">
                    <div class="card-body">
                        <div class=" my-3 d-flex justify-content-between">
                            <h3 class="">{{__('admin.Credit Discounts')}}</h3>
                            <button class="btn btn-dark " type="button" onclick="adddiscountmodal()" >{{__('admin.Add New Discount')}}</button>
                        </div>
                        <table class="table" id="example">
                            <thead>
                            <tr>
                                <th scope="col">{{__('admin.ID')}}#</th>
                                <th scope="col">{{__('admin.Package')}}</th>
                                <th scope="col">{{__('admin.Discount')}}%</th>
                                <th scope="col">{{__('admin.Status')}}</th>
                                <th scope="col">{{__('admin.Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <div class="modal fade" id="adddiscountmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Add New Discount')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <form class="row g-3" id="discount_submit">
                            <div class="col-12">
                                <label for="credits" class="form-label">{{__('admin.Select Package')}}</label>
                                <select class="form-select" id="package_id">
                                    @foreach($packages as $package)
                                        <option value="{{$package->id}}">{{$package->credits}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="credits" class="form-label">{{__('admin.Discount')}} <small> in %</small> </label>
                                <input type="number" id="discount" class="form-control"  required>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-dark w-100" id="submit_btn" type="submit">{{__('admin.Submit')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editdiscountmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Edit Discount')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="card mb-3">
                    <div class="card-body">

                        <form class="row g-3" id="edit_discount_from">
                            <input type="hidden" id="discount_id">
                            <div class="col-12">
                                <label for="credits" class="form-label">{{__('admin.Select Package')}}</label>
                                <select class="form-select" id="edit_package_id">
                                    @foreach($packages as $package)
                                        <option value="{{$package->id}}">{{$package->credits}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="credits" class="form-label">{{__('admin.Discount')}} <small> in %</small> </label>
                                <input type="number" id="edit_discount" class="form-control"  required>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-dark w-100" id="edit_discount_btn" type="submit">{{__('admin.Update')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script>
        $(document).ready(function() {
            $("#discountsli").addClass("nav-active");
            $("#property_discount").addClass("active");
            $("#property_discount").removeClass("collapse");
            $("#property_discount_link").removeClass("collapsed");
            $("#property_discount_link").addClass("active");

            var table= $('#example').DataTable({
                ajax: "{{ route('discounts') }}", // Ajax route
                serverSide: true,
                processing: true,
                columns: [
                    // Define your data columns here
                    { data: "id", name: "id" },
                    { data: "range", name: "range" },
                    { data: "discount", name: "discount" },
                    { data: "status", name: "status" },
                    { data: "action", name: "action" },
                ],
                "responsive": true, "lengthChange": true, "autoWidth": false,
                // dom: 'lBfrtip',
                // buttons: [
                //     'csv'
                // ],

            });

            table.draw();

        });

        function adddiscountmodal(){
            $("#adddiscountmodal").modal('show');
        }
        function EditDiscount(id,discount,package_id){

            $('#discount_id').val(id);
            $('#edit_discount').val(discount);
            $('#edit_package_id').val(package_id);
            $("#editdiscountmodal").modal('show')

        }//EditDiscount

    </script>

@endsection
