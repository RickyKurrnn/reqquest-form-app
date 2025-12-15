@extends('layouts.app')

@section('content')

<!-- DATATABLES -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- EXPORT -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<style>
.container { max-width:100%!important; }
.table-wrap { width:100%; }

table.data-table {
    width:100%;
    border-collapse:collapse;
    table-layout:fixed;
    font-size:13px;
    font-family: Arial;
}

/* HEADER */
table.data-table thead th {
    background:#1d2d50;
    color:#fff;
    border:2px solid #000;
    padding:10px;
    text-align:center;
    vertical-align:middle;
    cursor:pointer;
}

/* BODY */
table.data-table tbody td {
    border:2px solid #000;
    padding:10px;
    text-align:center;
    vertical-align:middle;
}

/* GROUP Mount */
tr.group td {
    background:#c7dea8;
    font-weight:bold;
    text-align:center;
}

/* NO */
table.data-table td:nth-child(1) {
    font-weight:600;
}

/* TASK RECEIVED RED */
table.data-table th:nth-child(3),
table.data-table td:nth-child(3) {
    color:#d7263d !important;
    font-weight:700;
}

/* NOTES */
table.data-table td:nth-child(12) {
    text-align:left;
    line-height:1.6;
    word-break:break-word;
    width:350px;
}

/* ACTION */
table.data-table th:nth-child(13),
table.data-table td:nth-child(13) {
    width:90px;
}

/* LINK */
.link-blue {
    color:#1a56d6;
    font-weight:bold;
    text-decoration:underline;
}

table.data-table thead th.sorting:after,
table.data-table thead th.sorting:before,
table.data-table thead th.sorting_asc:after,
table.data-table thead th.sorting_asc:before,
table.data-table thead th.sorting_desc:after,
table.data-table thead th.sorting_desc:before {
    display:none !important;
}

/*EXPORT EXCEL*/
.dt-buttons .buttons-excel {
    background:#1e7e34 !important; 
    color:#fff !important;
    font-size:10px !important;   
    padding:3px 7px !important;    
    border-radius:5px !important;
    border:none !important;
}

</style>

<div class="container py-4 table-wrap">

    <h2>Request Data Table</h2>

    <!-- SEARCH CUSTOM -->
    <input id="table-filter" placeholder="Filter..."
        style="padding:10px;width:350px;border-radius:8px;border:2px solid #ccc;margin-bottom:20px;">

    <table id="mainTable" class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Request Date</th>
                <th>Task Received</th>
                <th>Application</th>
                <th>File Name Form</th>
                <th>Task</th>
                <th>Requestor</th>
                <th>Approved By</th>
                <th>Executed By</th>
                <th>Acknowledged By</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        @php $no=1; @endphp
        @foreach($forms as $item)
        <tr>
            <td>{{ $no++ }}</td>
            <td data-month="{{ \Carbon\Carbon::parse($item->request_date)->format('F Y') }}">
                {{ $item->request_date }}
            </td>
            <td>{{ $item->task_received ?? '-' }}</td>
            <td>{{ $item->application_name ?? '-' }}</td>
            <td>-</td>
            <td>{{ $item->task ?? '-' }}</td>
            <td>{{ $item->requested_by_name ?? '-' }}</td>
            <td>{{ $item->approved_by_name ?? '-' }}</td>
            <td>{{ $item->executed_by_name ?? '-' }}</td>
            <td>{{ $item->acknowledged_by_name ?? '-' }}</td>
            <td>{{ $item->type ?? '-' }}</td>
            <td>{{ $item->notes ?? '-' }}</td>
            <td>
                <a class="link-blue" href="{{ route('form.print',$item->id) }}">Export PDF</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {

    let table = $('#mainTable').DataTable({
        paging:true,
        pageLength:5,
        ordering:true,
        searching:true,
        info:false,
        autoWidth:false,

        dom:'Brtip', 

        buttons:[{
            extend:'excelHtml5',
            text:'Export Excel', 
            title:'Request_Data'
        }],

        columnDefs:[
            { orderable:false, targets:[12] }
        ],

        language:{
            zeroRecords:'No data found',
            emptyTable:'No data found'
        },

        // GROUPING Mounth
        drawCallback:function(settings){
            let api = this.api();
            let rows = api.rows({page:'current'}).nodes();
            let last = null;

            api.column(1,{page:'current'}).data().each(function(data,i){
                let month = $(rows).eq(i).find('td:eq(1)').data('month');
                if(last !== month){
                    $(rows).eq(i).before(
                        '<tr class="group"><td colspan="13">'+month+'</td></tr>'
                    );
                    last = month;
                }
            });
        }
    });

    $('#table-filter').on('keyup', function(){
        table.search(this.value).draw();
    });

});
</script>

@endsection
