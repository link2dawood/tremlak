@extends('admin.layouts.master')
@section('pageTitle', __('admin.Visitors by Country'))
@section('content')
<main id="main" class="main">
	<div class="pagetitle">
		<h1>{{__('admin.Dashboard')}}</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('admin.Home')}}</a></li>
				<li class="breadcrumb-item active">{{__('admin.Visitors by Country')}}</li>
			</ol>
		</nav>
		<div class="my-3 d-flex justify-content-between">
			<a href="{{ route('admin.download.visitors') }}" class="btn btn-dark">{{ __('Download CSV') }}</a>
		</div>


	</div>
	<!-- End Page Title -->

	<section class="section dashboard">
		<div class="row pt-4">
			<div class="card table-overflow">
				<div class="card-body">
					<div class="my-3 d-flex justify-content-between">
						<h3 class="">{{__('Visitors')}}</h3>
					</div>
					<table id="visitorTable" class="table table-style3 table at-savesearch display responsive nowrap">
						<thead class="t-head">
							<tr>
								<th scope="col">Date</th>
								<th scope="col">Total Visitors</th>
								<th scope="col">Actions</th>
							</tr>
						</thead>
						<tbody class="t-body">
							@foreach($visitorsByDate as $visitor)
							<tr>
								<td>{{ $visitor['visit_date'] }}</td>
								<td>{{ $visitor['total_visitors'] }}</td>
								<td>
									<button class="btn btn-info btn-sm view-details" data-date="{{ $visitor['visit_date'] }}">
										View Details
									</button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<!-- Modal -->
					<div class="modal fade" id="visitorDetailsModal" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Visitors Details for <span id="selected-date"></span></h5>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">
									<table class="table">
										<thead>
											<tr>
												<th scope="col">Country</th>
												<th scope="col">Visitors</th>
											</tr>
										</thead>
										<tbody id="visitor-details-body">
											<!-- Data will be inserted here -->
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>
	</section>
</main>
@endsection
@section('script')
<script>
	$(document).ready(function () {
		$(".view-details").click(function () {
			let date = $(this).data("date");
			$("#selected-date").text(date);

			$.ajax({
				url: "/admin/visitors/details/" + date,
				type: "GET",
				success: function (data) {
					let tableBody = "";
					if (data.length > 0) {
						data.forEach(visitor => {
							tableBody += `<tr>
								<td>${visitor.country}</td>
								<td>${visitor.total}</td>
								</tr>`;
							});
					} else {
						tableBody = `<tr><td colspan="2">No data available</td></tr>`;
					}
					$("#visitor-details-body").html(tableBody);
					$("#visitorDetailsModal").modal("show");
				},
				error: function () {
					alert("Error fetching data.");
				}
			});
		});
	});

</script>
<script>
    $(document).ready(function() {
        $('#visitorTable').DataTable({
            responsive: true,
            ordering: true,
            searching: true,
            paging: true,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            columnDefs: [
                { orderable: false, targets: 2 } // Disable sorting on the Actions column
            ],
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                infoFiltered: "(filtered from _MAX_ total entries)"
            }
        });
        
        // Handle view details button click
        $(document).on('click', '.view-details', function() {
            var date = $(this).data('date');
            // Your code to handle the view details action
            // For example, you could redirect to a details page or open a modal
            console.log('View details for date: ' + date);
        });
    });
</script>
@endsection

