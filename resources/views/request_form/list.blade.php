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
                                {{-- <th>Task Received</th> --}}
                                <th>Application</th>
                                <th>Document Number</th>
                                {{-- <th>Task</th> --}}
                                <th>Requestor</th>
                                <th>Approved By</th>
                                <th>Executed By</th>
                                <th>Acknowledged By</th>
                                <th>Status</th>
                                <th>Action</th>
                                {{-- <th>Action 2</th> --}}
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

    <div class="modal fade" id="modalDetailForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" style="box-shadow: 0 0.5rem 1rem rgba(0,0,0,.5);">

                <div class="modal-header">
                    <h5 class="modal-title">Detail Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- REQUEST INFO --}}
                    <h6 class="fw-bold mb-3">Request Information</h6>
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Request Type</label>
                            <input type="text" id="request_type" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Document Number</label>
                            <input type="text" id="document_number" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Application</label>
                            <input type="text" id="application_name" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Request Date</label>
                            <input type="date" id="request_date" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Existing Condition</label>
                            <textarea id="existing_condition" class="form-control form-control-sm" rows="2"></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Expectations</label>
                            <textarea id="expectations" class="form-control form-control-sm" rows="2"></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select id="type" class="form-select form-select-sm">
                                <option value="Open">Open</option>
                                <option value="Close">Close</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Notes</label>
                            <textarea id="notes" class="form-control form-control-sm" rows="3"></textarea>
                        </div>
                    </div>

                    <hr>

                    {{-- REQUESTED BY --}}
                    {{-- <h6 class="fw-bold mb-3">Requested By</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="text" id="requested_by_name" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="requested_by_position" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="requested_at" class="form-control form-control-sm">
                        </div>
                    </div>

                    <hr> --}}

                    {{-- APPROVAL FLOW --}}
                    <h6 class="fw-bold mb-3">Approval Information</h6>

                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Requested By</td>
                                <td id="requested_by_name"></td>
                                <td id="requested_by_position"></td>
                                <td id="requested_at"></td>
                            </tr>
                            <tr>
                                <td>Approved By</td>
                                <td id="approved_by_name"></td>
                                <td id="approved_by_position"></td>
                                <td id="approved_at"></td>
                            </tr>
                            <tr>
                                <td>Executed By</td>
                                <td id="executed_by_name"></td>
                                <td id="executed_by_position"></td>
                                <td id="executed_at"></td>
                            </tr>
                            <tr>
                                <td>Acknowledged By</td>
                                <td id="acknowledged_by_name"></td>
                                <td id="acknowledged_by_position"></td>
                                <td id="acknowledged_at"></td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <a href="#" class="btn btn-success btn-sm" id="btnExportPdf" target="_blank">
                        Export PDF
                    </a>

                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>

                        <button type="button" class="btn btn-primary" id="btnSaveDetail">
                            Save
                        </button>
                    </div>
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
            fixedHeader: false,
            order: [],
            // columns: [{
            //         data: 0
            //     },
            //     {
            //         data: 1
            //     },
            //     {
            //         data: 2
            //     },
            //     {
            //         data: 3
            //     },
            //     {
            //         data: 4
            //     },
            //     {
            //         data: 5
            //     },
            //     {
            //         data: 6
            //     },
            //     {
            //         data: 7
            //     },
            //     {
            //         data: 8,
            //         orderable: false,
            //         searchable: false
            //     }
            // ],
            columnDefs: [{
                    targets: 0,
                    width: "50px",
                    className: "text-center"
                },
                {
                    targets: [9],
                    width: "120px",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }
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
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
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

        function modalShow(el) {
            let id = $(el).data('id');

            $('#modalDetailForm').data('id', id);

            let url = "{{ route('form.detail', ':id') }}".replace(':id', id);

            $.get(url, function(res) {

                $('#request_type').val(res.request_type);
                $('#document_number').val(res.document_number);
                $('#application_name').val(res.application_name);
                $('#request_date').val(res.request_date);
                $('#existing_condition').val(res.existing_condition);
                $('#expectations').val(res.expectations);
                $('#type').val(res.type);
                $('#notes').val(res.notes);

                $('#requested_by_name').text(res.requested_by_name);
                $('#requested_by_position').text(res.requested_by_position);
                $('#requested_at').text(res.requested_at);

                $('#approved_by_name').text(res.approved_by_name ?? '-');
                $('#approved_by_position').text(res.approved_by_position ?? '-');
                $('#approved_at').text(res.approved_at ?? '-');

                $('#executed_by_name').text(res.executed_by_name ?? '-');
                $('#executed_by_position').text(res.executed_by_position ?? '-');
                $('#executed_at').text(res.executed_at ?? '-');

                $('#acknowledged_by_name').text(res.acknowledged_by_name ?? '-');
                $('#acknowledged_by_position').text(res.acknowledged_by_position ?? '-');
                $('#acknowledged_at').text(res.acknowledged_at ?? '-');

                $('#modalDetailForm').modal('show');
            });

            let exportUrl = "{{ route('form.export.new', ':id') }}".replace(':id', id);
            $('#btnExportPdf').attr('href', exportUrl);

        }

        $('#btnSaveDetail').on('click', function() {
            let id = $('#modalDetailForm').data('id');

            let payload = {
                request_type: $('#request_type').val(),
                document_number: $('#document_number').val(),
                application_name: $('#application_name').val(),
                request_date: $('#request_date').val(),
                existing_condition: $('#existing_condition').val(),
                expectations: $('#expectations').val(),
                type: $('#type').val(),
                notes: $('#notes').val(),
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: "{{ route('form.update', ':id') }}".replace(':id', id),
                type: 'PUT',
                data: payload,
                success: function() {
                    alert('Data berhasil disimpan');
                    $('#modalDetailForm').modal('hide');
                    table.ajax.reload(null, false);
                },
                error: function() {
                    alert('Gagal menyimpan data');
                }
            });
        });

        function deleteData(el) {
            let id = $(el).data('id');

            if (!confirm('Yakin ingin menghapus data ini?')) return;

            $.ajax({
                url: "{{ route('form.delete', ':id') }}".replace(':id', id),
                type: 'PUT',
                data: {
                    status: 'Hide',
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    alert('Data berhasil dihapus');

                    if (typeof table !== 'undefined') {
                        table.ajax.reload(null, false);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Gagal menghapus data');
                }
            });
        }


        table.on('init draw', function() {
            table.columns.adjust();
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
