
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add New Form Request</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body{font-family:Arial;margin:20px}
    label{display:block;margin-top:10px;font-weight:600}
    input, textarea{width:48%;padding:8px;margin-top:6px;border:1px solid #ccc;border-radius:6px}
    textarea{height:120px}
    .btn{margin-top:14px;padding:10px 18px;background:#163463;color:#fff;border:none;border-radius:8px;cursor:pointer}
    .notice{padding:10px;border-radius:6px;margin-bottom:12px}
    .success{background:#e6f7e6;border:1px solid #b6e6b6;color:#114b17}
    .error{background:#fff0f0;border:1px solid #f2b6b6;color:#7a1414}
    .half{display:inline-block;vertical-align:top}
  </style>
</head>
<body>
  <h1>Add New Form Request</h1>

  @if(session('success'))
    <div class="notice success">{{ session('success') }}</div>
  @endif

  @if($errors->any())
    <div class="notice error">
      <ul style="margin:0;padding-left:18px">
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('form.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="half">
      <label>Request Type</label>
      <input name="request_type" placeholder="Type of Request" />

      <label>Application Name</label>
      <input name="application_name" placeholder="Enter Application Name" />

      <label>Existing / Current Condition</label>
      <textarea name="existing_condition"></textarea>
    </div>

    <div class="half" style="margin-left:4%">
      <label>Document Number</label>
      <input name="document_number" placeholder="Auto-number or custom" />

      <label>Request Date</label>
      <input name="request_date" type="date" />

      <label>Expectations</label>
      <textarea name="expectations"></textarea>
    </div>

    <div style="clear:both"></div>

    <label>Requested By - Name</label>
    <input name="requested_by_name" placeholder="Name" />

    <label>Requested By - Position</label>
    <input name="requested_by_position" placeholder="Position" />

    <label>Notes</label>
    <textarea name="notes"></textarea>

    <div>
      <button type="submit" class="btn">Save Request (demo)</button>
    </div>
  </form>

  <p style="margin-top:18px">
    Setelah submit, data akan disimpan sementara di session dan muncul di halaman <a href="{{ url('/request-table') }}">Request Table</a>.
  </p>
</body>
</html>

