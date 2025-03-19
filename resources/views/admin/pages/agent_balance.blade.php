@extends('admin.layouts.master')
@section('pageTitle', __('admin.Agents'))
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{__('admin.Dashboard')}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('/')}}">{{__('admin.Home')}}</a></li>
                <li class="breadcrumb-item active">{{__('admin.Agents')}}</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="card table-overflow">
                <div class="card-body">
                    <div class=" my-3 d-flex justify-content-between">
                        <h3 class="">{{$agent->fname}} {{$agent->lname}}</h3>
                        <button class="btn btn-success" onclick="downloadCSV()">
                            <i class="fa fa-download"></i> {{ __('Download CSV') }}
                        </button>
                    </div>
                    <div class="mt-3">
                        <h5 class="text-end">
                            <strong>{{ __('Available Balance:') }}</strong> 
                            <span class="text-success">{{ $agent->balance }}</span>
                        </h5>
                    </div>
                    <!-- Assign Credits Form -->
                    
                        <!-- Table with stripped rows -->
                        <table class="table datatable" id="creditTable">
                            <thead>
                                <tr>=
                                    <th scope="col">{{__('Description')}}</th>
                                    <th scope="col">{{__('Credits')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($CreditHistory as $val)
                                <tr>
                                   <td>{{ $val['description'] }}</td>
                                   <td>{{ $val['credits'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</section>
</main>


@endsection
@section('script')
@section('script')
<script>
    function downloadCSV() {
        let table = document.getElementById("creditTable");
        if (!table) {
            console.error("Table element not found!");
            return;
        }

        let csvContent = "data:text/csv;charset=utf-8,";

        // Fetch agent details
        let agentName = "{{ $agent->fname }} {{ $agent->lname }}";
        let availableBalance = "{{ $agent->balance }}";

        // Add agent's name at the top
        csvContent += "Agent Name:," + agentName + "\n\n";

        // Add table headers (only once)
        csvContent += "Description,Credits\n";

        // Loop through table rows (skip first row if it's repeating headers)
        let rows = table.querySelectorAll("tbody tr");
        rows.forEach(row => {
            let cols = row.querySelectorAll("td");
            let rowData = [];
            cols.forEach(col => rowData.push(col.innerText.trim()));
            csvContent += rowData.join(",") + "\n";
        });

        // Add available balance at the bottom
        csvContent += "\nAvailable Balance:," + availableBalance + "\n";

        // Create a download link
        let encodedUri = encodeURI(csvContent);
        let link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "agent_credit_history.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
@endsection

@endsection
