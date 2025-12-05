@extends('layouts.app')

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-body p-4">

        <h3 class="fw-bold mb-4">Add New Form Request</h3>

        <h5 class="fw-semibold mb-3">Request Data</h5>

        <form action="{{ route('form.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Row 1 -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Request Type</label>
                    <input type="text" name="request_type" class="form-control" placeholder="Type of Request">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Document Number</label>
                    <input type="text" name="document_number" class="form-control" placeholder="Auto-number or custom">
                </div>
            </div>

            <!-- Row 2 -->
           <div class="row mb-3">
                 <div class="col-md-6">
                      <label for="application_name_input" class="form-label">Application Name</label>
                        <input 
                            type="text" 
                            name="application_name" 
                            id="application_name_input" 
                            class="form-control" 
                            placeholder="Enter Application Name" 
                            required
                            value="{{ old('application_name') }}">
        
        @error('application_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
                </div>
            </div>

                <div class="col-md-6">
                    <label class="form-label">Request Date</label>
                    <input type="date" name="request_date" class="form-control">
                </div>
            </div>

            <!-- Row 3 -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label">Existing / Current Condition</label>
                    <textarea name="current_condition" rows="4" class="form-control" placeholder="Describe current condition"></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Expectations</label>
                    <textarea name="expectations" rows="4" class="form-control" placeholder="Describe your expectations"></textarea>
                </div>
            </div>

            <!-- SECTION: Requested By + Approved By -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h6 class="fw-bold">Requested By:</h6>

                    <label class="form-label">Name</label>
                    <input type="text" name="requested_by_name" class="form-control mb-2">

                    <label class="form-label">Position</label>
                    <input type="text" name="requested_by_position" class="form-control mb-2">

                    <label class="form-label">Date</label>
                    <input type="date" name="requested_at" class="form-control mb-2">

                    <label class="form-label">Add Signature</label>
                    <input type="file" name="requested_by_signature_path" class="form-control">
                </div>

                <div class="col-md-6 mb-4">
                    <h6 class="fw-bold">Approved By:</h6>

                    <label class="form-label">Name</label>
                    <input type="text" name="approved_by_name" class="form-control mb-2">

                    <label class="form-label">Position</label>
                    <input type="text" name="approved_by_position" class="form-control mb-2">

                    <label class="form-label">Date</label>
                    <input type="date" name="approved_at" class="form-control mb-2">

                    <label class="form-label">Add Signature</label>
                    <input type="file" name="approved_by_signature_path" class="form-control">
                </div>
            </div>

            <!-- SECTION: Executed + Acknowledged -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h6 class="fw-bold">Executed By:</h6>

                    <label class="form-label">Name</label>
                    <input type="text" name="executed_by_name" class="form-control mb-2">

                    <label class="form-label">Position</label>
                    <input type="text" name="executed_by_position" class="form-control mb-2">

                    <label class="form-label">Date</label>
                    <input type="date" name="executed_at" class="form-control mb-2">

                    <label class="form-label">Add Signature</label>
                    <input type="file" name="executed_by_signature_path" class="form-control">
                </div>

                <div class="col-md-6 mb-4">
                    <h6 class="fw-bold">Acknowledged By:</h6>

                    <label class="form-label">Name</label>
                    <input type="text" name="acknowledged_by_name" class="form-control mb-2">

                    <label class="form-label">Position</label>
                    <input type="text" name="acknowledged_by_position" class="form-control mb-2">

                    <label class="form-label">Date</label>
                    <input type="date" name="acknowledged_at" class="form-control mb-2">

                    <label class="form-label">Add Signature</label>
                    <input type="file" name="acknowledged_by_signature_path" class="form-control">
                </div>
            </div>

            <!-- Attachments -->
            <div class="mb-4">
                <label class="form-label">Attachment</label>
                <input type="file" name="attachment" class="form-control">
            </div>

            <!-- Type + Notes -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select">
                        <option disabled selected>Select Open/Close</option>
                        <option>Open</option>
                        <option>Close</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" rows="3" class="form-control" placeholder="Describe your notes"></textarea>
                </div>
            </div>

            <!-- Save button -->
            <div class="text-end">
                <button type="submit" class="btn btn-primary px-4">Save</button>
            </div>

        </form>
    </div>
</div>

@endsection
