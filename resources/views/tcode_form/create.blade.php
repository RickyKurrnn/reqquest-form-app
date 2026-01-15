@extends('layouts.app')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <h3 class="fw-bold mb-4">Add New TCode Form Request</h3>

            <form action="{{ route('form.tcode.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ================= DOCUMENT INFO ================= --}}
                <h5 class="fw-semibold mb-3">Document Information</h5>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Document Number</label>
                        <input type="text" name="document_number" class="form-control" placeholder="Auto Number / Manual"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Request Date</label>
                        <input type="date" name="request_date" class="form-control" required>
                    </div>
                </div>

                {{-- ================= MAIN DATA ================= --}}
                <h5 class="fw-semibold mb-3 mt-4">Requestor Information</h5>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Employee Name</label>
                        <input type="text" id="employee_name" name="name" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Company</label>
                        <input type="text" name="company" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Employee ID</label>
                        <input type="text" name="employee_id" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">SAP Username</label>
                        <input type="text" name="sap_username" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Division</label>
                        <input type="text" name="division" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Department</label>
                        <input type="text" name="department" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Position</label>
                        <input type="text" name="position" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">SAP Module</label>
                        <select name="sap_module" class="form-select" required>
                            <option disabled selected>Select SAP Module</option>
                            <option value="FI">Finance Accounting (FI)</option>
                            <option value="CO">Controlling (CO)</option>
                            <option value="PM">Plant Maintenance (PM)</option>
                            <option value="MM">Material Management (MM)</option>
                            <option value="PS">Project System (PS)</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Client</label>
                        <input type="text" name="client" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Authorization Added Date</label>
                        <input type="date" name="authorization_added" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Request Description</label>
                        <textarea name="request_description" rows="4" class="form-control" required></textarea>
                    </div>
                </div>

                {{-- ================= SIGNATURES ================= --}}
                <h5 class="fw-semibold mb-3 mt-4">Approval & Signatures</h5>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h6 class="fw-bold">Requested By</h6>
                        <input type="text" id="signature_requested_name" name="signatures[requested][name]"
                            class="form-control mb-2" placeholder="Name" readonly>
                        <input type="file" name="signatures[requested][file]" class="form-control">
                    </div>

                    <div class="col-md-6 mb-4">
                        <h6 class="fw-bold">Approved By</h6>
                        <input type="text" name="signatures[approved][name]" class="form-control mb-2"
                            placeholder="Name" required>
                        <input type="file" name="signatures[approved][file]" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h6 class="fw-bold">Added By</h6>
                        <input type="text" name="signatures[added][name]" class="form-control mb-2"
                            placeholder="Name" required>
                        <input type="file" name="signatures[added][file]" class="form-control">
                    </div>

                    <div class="col-md-6 mb-4">
                        <h6 class="fw-bold">Acknowledged By</h6>
                        <input type="text" name="signatures[acknowledged][name]" class="form-control mb-2"
                            placeholder="Name" required>
                        <input type="file" name="signatures[acknowledged][file]" class="form-control">
                    </div>
                </div>

                {{-- ================= ATTACHMENT ================= --}}
                <div class="mb-4">
                    <label class="form-label">Attachment</label>
                    <input type="file" name="attachment_path" class="form-control">
                </div>

                {{-- ================= SUBMIT ================= --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        Save
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#employee_name').on('input', function() {
                $('#signature_requested_name').val($(this).val());
            });
        });
    </script>
@endpush
