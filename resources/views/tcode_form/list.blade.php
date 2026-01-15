@extends('layouts.app')

@section('content')
    <div class="content">

        <div class="container-fluid mb-4">
            <h3 class="fw-semibold">List TCode Request</h3>
        </div>

        {{-- FILTER --}}
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-body">
                    <form id="filterForm">
                        <div class="row g-3">

                            <div class="col-md-3">
                                <label class="form-label">Request Date</label>
                                <input type="date" id="filter_request_date" class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Document Number</label>
                                <input type="text" id="filter_document_number" class="form-control"
                                    placeholder="Document Number">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Employee Name</label>
                                <input type="text" id="filter_name" class="form-control" placeholder="Employee Name">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">SAP Module</label>
                                <select id="filter_sap_module" class="form-select">
                                    <option value="">All</option>
                                    <option value="FI">FI</option>
                                    <option value="CO">CO</option>
                                    <option value="PM">PM</option>
                                    <option value="MM">MM</option>
                                    <option value="PS">PS</option>
                                </select>
                            </div>

                            <div class="col-md-3 d-flex align-items-end">
                                <button type="button" id="btnFilter" class="btn btn-primary w-100">
                                    Apply Filter
                                </button>
                            </div>

                            <div class="col-md-3 d-flex align-items-end">
                                <button type="button" id="btnClear" class="btn btn-secondary w-100">
                                    Clear
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="button-row" style="display: flex; justify-content: start; gap: 10px; margin-bottom: 15px;">
                        <button id="csvButton" class="btn btn-info btn-sm px-3 text-white">Export CSV</button>
                    </div>

                    <table id="tcodeTable" class="table table-striped nowrap w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Request Date</th>
                                <th>Document No</th>
                                <th>Employee Name</th>
                                <th>Company</th>
                                <th>SAP Username</th>
                                <th>SAP Module</th>
                                <th>Client</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="modalDetailForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" style="box-shadow: 0 0.5rem 1rem rgba(0,0,0,.5);">

                <div class="modal-header">
                    <h5 class="modal-title">Detail TCode Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- DOCUMENT INFO --}}
                    <h6 class="fw-bold mb-3">Document Information</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Document Number</label>
                            <input type="text" id="document_number" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Request Date</label>
                            <input type="date" id="request_date" class="form-control form-control-sm">
                        </div>
                    </div>

                    {{-- EMPLOYEE INFO --}}
                    <h6 class="fw-bold mb-3 mt-4">Employee Information</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Employee Name</label>
                            <input type="text" id="name" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Company</label>
                            <input type="text" id="company" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Employee ID</label>
                            <input type="text" id="employee_id" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">SAP Username</label>
                            <input type="text" id="sap_username" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Division</label>
                            <input type="text" id="division" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Department</label>
                            <input type="text" id="department" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="text" id="email" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">SAP Module</label>
                            <select id="sap_module" class="form-select form-select-sm">
                                <option value="">-</option>
                                <option value="FI">Finance Accounting (FI)</option>
                                <option value="CO">Controlling (CO)</option>
                                <option value="PM">Plant Maintenance (PM)</option>
                                <option value="MM">Material Management (MM)</option>
                                <option value="PS">Project System (PS)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Client</label>
                            <input type="text" id="client" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Authorization Added Date</label>
                            <input type="date" id="authorization_added" class="form-control form-control-sm">
                        </div>
                    </div>

                    <div class="mb-3 mt-3">
                        <label class="form-label">Request Description</label>
                        <textarea id="request_description" class="form-control form-control-sm" rows="3"></textarea>
                    </div>

                    {{-- APPROVAL TABLE --}}
                    <h6 class="fw-bold mb-3 mt-4">Approval Information</h6>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Role</th>
                                <th style="width: 50%;">Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Requested By</td>
                                <td id="requested_by">-</td>
                            </tr>
                            <tr>
                                <td>Approved By</td>
                                <td id="approved_by">-</td>
                            </tr>
                            <tr>
                                <td>Added By</td>
                                <td id="added_by">-</td>
                            </tr>
                            <tr>
                                <td>Acknowledged By</td>
                                <td id="acknowledged_by">-</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <a href="#" class="btn btn-success btn-sm" id="btnExportPdf" target="_blank">Export PDF</a>

                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnSaveDetail">Save</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let table = $('#tcodeTable').DataTable({
            processing: true,
            serverSide: false,
            searching: false,
            scrollX: true,
            lengthChange: false,
            ajax: {
                url: "{{ route('form.tcode.data') }}",
                data: function(d) {
                    d.request_date = $('#filter_request_date').val();
                    d.document_number = $('#filter_document_number').val();
                    d.name = $('#filter_name').val();
                    d.sap_module = $('#filter_sap_module').val();
                }
            },
            columnDefs: [{
                    targets: 0,
                    className: 'text-center',
                    width: '50px'
                },
                {
                    targets: 8,
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                }
            ],
            buttons: [{
                extend: 'csvHtml5',
                className: 'd-none',
                title: 'List Request Tcode',
                filename: function() {
                    return 'List_Request_Tcode' + new Date().getTime();
                },
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            }]
        });

        function modalShow(el) {
            let id = $(el).data('id');
            $('#modalDetailForm').data('id', id);

            const sapModuleMap = {
                FI: 'Finance Accounting (FI)',
                CO: 'Controlling (CO)',
                PM: 'Plant Maintenance (PM)',
                MM: 'Material Management (MM)',
                PS: 'Project System (PS)',
            };

            let url = "{{ route('form.tcode.detail', ':id') }}".replace(':id', id);

            $.get(url, function(res) {
                // Document & Employee
                $('#document_number').val(res.document_number);
                $('#request_date').val(res.request_date?.split('T')[0]);


                $('#name').val(res.name);
                $('#company').val(res.company);
                $('#employee_id').val(res.employee_id);
                $('#sap_username').val(res.sap_username);
                $('#division').val(res.division);
                $('#department').val(res.department);
                $('#email').val(res.email);
                $('#sap_module').val(res.sap_module);
                if (!sapModuleMap[res.sap_module]) {
                    $('#sap_module').val('');
                }
                $('#client').val(res.client);
                $('#authorization_added').val(res.authorization_added?.split('T')[0]);
                $('#request_description').val(res.request_description);

                // Approval table
                $('#requested_by').text(res.requested_by ?? '-');
                $('#approved_by').text(res.approved_by ?? '-');
                $('#added_by').text(res.added_by ?? '-');
                $('#acknowledged_by').text(res.acknowledged_by ?? '-');

                $('#modalDetailForm').modal('show');
            });

            let exportUrl = "{{ route('pdf.export.tcode', ':id') }}".replace(':id', id);
            $('#btnExportPdf').attr('href', exportUrl);
        }

        function deleteData(el) {
            let id = $(el).data('id');

            if (!confirm('Yakin ingin menghapus data ini?')) return;

            $.ajax({
                url: "{{ route('form.tcode.delete', ':id') }}".replace(':id', id),
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


        $('#btnSaveDetail').on('click', function() {
            let id = $('#modalDetailForm').data('id');

            let payload = {
                document_number: $('#document_number').val(),
                request_date: $('#request_date').val(),
                name: $('#name').val(),
                company: $('#company').val(),
                employee_id: $('#employee_id').val(),
                sap_username: $('#sap_username').val(),
                division: $('#division').val(),
                department: $('#department').val(),
                email: $('#email').val(),
                sap_module: $('#sap_module').val(),
                client: $('#client').val(),
                authorization_added: $('#authorization_added').val(),
                request_description: $('#request_description').val(),
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: "{{ route('form.tcode.update', ':id') }}".replace(':id', id),
                type: 'PUT',
                data: payload,
                success: function(res) {
                    alert('Data berhasil disimpan');
                    $('#modalDetailForm').modal('hide');

                    // kalau pakai datatable
                    if (typeof table !== 'undefined') {
                        table.ajax.reload(null, false);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Gagal menyimpan data');
                }
            });
        });

        // APPLY FILTER
        $('#btnFilter').click(function() {
            table.ajax.url("{{ route('form.tcode.search') }}").load();
        });

        // CLEAR FILTER
        $('#btnClear').click(function() {
            $('#filterForm')[0].reset();
            table.ajax.url("{{ route('form.tcode.data') }}").load();
        });

        $('#csvButton').on('click', function() {
            table.buttons('.buttons-csv').trigger();
        });
    </script>
@endpush
