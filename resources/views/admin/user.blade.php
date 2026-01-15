@extends('layouts.app')

@section('content')
    <div class="content">

        {{-- TITLE --}}
        <div class="container-fluid mb-4">
            <h3 class="fw-semibold mb-0">User Management</h3>
        </div>

        {{-- FILTER --}}
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-semibold text-uppercase text-secondary">
                        Filter User
                    </h5>
                </div>

                <div class="card-body">
                    <form id="userFilterForm">
                        <div class="row g-3">

                            <div class="col-md-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="filter_name" placeholder="Search Name">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" id="filter_email" placeholder="Search Email">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Role</label>
                                <select class="form-select" id="filter_role">
                                    <option value="">All</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Approval Status</label>
                                <select class="form-select" id="filter_status">
                                    <option value="">All</option>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>

                            <div class="col-md-3 d-flex align-items-end">
                                <button id="btnFilterUser" class="btn btn-primary w-100" type="button">
                                    Apply Filter
                                </button>
                            </div>

                            <div class="col-md-3 d-flex align-items-end">
                                <button id="btnClearUser" class="btn btn-secondary w-100" type="button">
                                    Clear Filter
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="container-fluid mt-3">
            <div class="card">
                <div class="card-body">

                    <table id="userTable" class="table table-striped nowrap w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Approve</th>
                                <th>Reject</th>
                                <th>Make Admin</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>


                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>

        table = $('#userTable').DataTable({
            responsive: false,
            scrollX: true,
            scrollY: "500px",
            scrollCollapse: true,
            autoWidth: false,
            paging: true,
            searching: false,
            fixedHeader: false,
            order: [],
            columnDefs: [{
                    targets: 0,
                    width: "50px",
                    className: "text-center"
                }, // No
                {
                    targets: -1,
                    width: "120px",
                    className: "text-center"
                }, // Action
            ],

            dom: "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-5'i><'col-sm-7'p>>",

            ajax: {
                url: "{{ route('admin.users.data') }}",
                type: "GET",
                data: function(d) {
                    d.name = $('#filter_name').val();
                    d.email = $('#filter_email').val();
                    d.role = $('#filter_role').val();
                    d.status = $('#filter_status').val();
                }
            }
        });

        // let table = $('#userTable').DataTable({
        //     scrollX: true,
        //     paging: true,
        //     searching: false,
        //     ordering: false,

        //     columnDefs: [{
        //             targets: 0,
        //             width: "50px",
        //             className: "text-center"
        //         },
        //         {
        //             targets: [5, 6, 7],
        //             className: "text-center"
        //         },
        //     ],

        //     ajax: {
        //         url: "{{ route('admin.users.data') }}",
        //         type: "GET",
        //         data: function(d) {
        //             d.name = $('#filter_name').val();
        //             d.email = $('#filter_email').val();
        //             d.role = $('#filter_role').val();
        //             d.status = $('#filter_status').val();
        //         }
        //     }
        // });

        table.on('draw', function() {
            table.columns.adjust();
        });

        /* APPLY FILTER */
        $('#btnFilterUser').on('click', function() {
            table.ajax.url("{{ route('admin.users.search') }}").load();
        });

        /* CLEAR FILTER */
        $('#btnClearUser').on('click', function() {
            $('#userFilterForm')[0].reset();
            table.ajax.url("{{ route('admin.users.data') }}").load();
        });
    </script>
@endpush
