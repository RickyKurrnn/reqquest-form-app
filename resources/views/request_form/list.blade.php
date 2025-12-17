@extends('layouts.app')

@section('content')
    <div class="content">

        <div class="container-fluid mb-4">
            <h3 class="fw-semibold mb-0">List Request</h3>
        </div>

        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-semibold text-uppercase text-secondary">
                        Filter List
                    </h5>
                </div>

                <div class="card-body" id="listDataTableFilter">
                    <form id="listDataTableFilterForm">
                        <div class="row g-3">

                            <div class="col-md-3">
                                <label class="form-label" for="filter_request_date">Request Date</label>
                                <input type="date" class="form-control" id="filter_request_date" name="request_date">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="filter_application">Application</label>
                                <input type="text" class="form-control" id="filter_application" name="application"
                                    placeholder="Search Application">
                            </div>

                            {{-- <div class="col-md-3">
                                <label class="form-label" for="filter_task">Task</label>
                                <input type="text" class="form-control" id="filter_task" name="task"
                                    placeholder="Search Task">
                            </div> --}}

                            <div class="col-md-3">
                                <label class="form-label" for="filter_requestor">Requestor</label>
                                <input type="text" class="form-control" id="filter_requestor" name="requestor"
                                    placeholder="Search Requestor">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="filter_status">Status</label>
                                <select class="form-select" id="filter_status" name="status">
                                    <option value="">All</option>
                                    <option value="Open">Open</option>
                                    <option value="Close">Close</option>
                                </select>
                            </div>

                            <div class="col-md-3 d-flex align-items-end">
                                <button id="btnFilterListDataTable" class="btn btn-primary w-100" type="button">
                                    Apply Filter
                                </button>
                            </div>

                            <div class="col-md-3 d-flex align-items-end">
                                <button id="btnClearFilter" class="btn btn-secondary w-100" type="button">
                                    Clear Filter
                                </button>
                            </div>


                        </div>
                    </form>
                </div>

            </div>
        </div>

        <div class="container-fluid mt-3" id="listFormResult">
            <div class="card header-info-filter">
                <div class="card-body">
                    <div class="button-row" style="display: flex; justify-content: start; gap: 10px; margin-bottom: 15px;">
                        <button id="csvButton" class="btn btn-info btn-sm px-3 text-white">Export CSV</button>
                    </div>

                    <table id="listDataTable" width="100%" class="table table-striped nowrap w-100">
                        <thead class="mt-30">
                            <tr>
                                <th>No</th>
                                <th>Request Date</th>
                                <th>Task Received</th>
                                <th>Application</th>
                                <th>Task</th>
                                <th>Requestor</th>
                                <th>Approved By</th>
                                <th>Executed By</th>
                                <th>Acknowledged By</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        table = $('#listDataTable').DataTable({
            responsive: false,
            scrollX: true,
            scrollY: "500px",
            scrollCollapse: true,
            autoWidth: false,
            paging: true,
            searching: false,
            order: [],
            columnDefs: [{
                    targets: [0, 10],
                    className: 'text-center'
                }, // No dan Action di tengah
                {
                    targets: '_all',
                    className: 'align-middle'
                } // Semua kolom rata tengah secara vertikal
            ],

            dom: "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [{
                extend: 'csvHtml5',
                className: 'd-none',
                title: 'List Request',
                filename: function() {
                    return 'List_Request_' + new Date().getTime();
                },
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            }],

            ajax: {
                url: "{{ route('form.data') }}",
                type: "GET",
                data: function(d) {
                    d.request_date = $('#filter_request_date').val();
                    d.application = $('#filter_application').val();
                    d.requestor = $('#filter_requestor').val();
                    d.status = $('#filter_status').val();
                }
            }
        });

        $('#btnFilterListDataTable').on('click', function() {
            table.ajax.url("{{ route('form.search') }}").load(function() {
                table.columns.adjust().draw();
            });
        });

        $('#btnClearFilter').on('click', function() {
            $('#listDataTableFilterForm')[0].reset();
            table.ajax.url("{{ route('form.data') }}").load(function() {
                table.columns.adjust().draw();
            });
        });

        table.columns.adjust();

        $('#csvButton').on('click', function() {
            table.buttons('.buttons-csv').trigger();
        });
    </script>
@endpush
