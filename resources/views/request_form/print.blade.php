<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Request Form #{{ $form->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; color:#111; }
        .header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
        .card { border:1px solid #ddd; padding:16px; border-radius:6px; }
        table { width:100%; border-collapse: collapse; margin-top:10px; }
        td, th { padding:8px; border:1px solid #eee; vertical-align: top; }
        h2 { margin:0 0 8px 0; }
        .small { font-size:13px; color:#666; }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h2>Request Form #{{ $form->id }}</h2>
            <div class="small">Request Date: {{ $form->request_date }}</div>
        </div>
        <div>
            <!-- You can add logo here -->
        </div>
    </div>

    <div class="card">
        <h4>Request Data</h4>
        <table>
            <tr>
                <th style="width:200px">Request Type</th><td>{{ $form->request_type }}</td>
            </tr>
            <tr>
                <th>Application Name</th><td>{{ $form->application_name }}</td>
            </tr>
            <tr>
                <th>Existing Condition</th><td>{{ $form->existing_condition }}</td>
            </tr>
            <tr>
                <th>Expectations</th><td>{{ $form->expectations }}</td>
            </tr>
            <tr>
                <th>Requested By</th>
                <td>
                    {{ $form->requested_by_name }} ({{ $form->requested_by_position }})
                </td>
            </tr>
            <tr>
                <th>Approved By</th>
                <td>
                    {{ $form->approved_by_name }} ({{ $form->approved_by_position }})
                </td>
            </tr>
            <tr>
                <th>Executed By</th>
                <td>
                    {{ $form->executed_by_name }} ({{ $form->executed_by_position }})
                </td>
            </tr>
            <tr>
                <th>Acknowledged By</th>
                <td>
                    {{ $form->acknowledged_by_name }} ({{ $form->acknowledged_by_position }})
                </td>
            </tr>
            <tr>
                <th>Notes</th><td>{{ $form->notes }}</td>
            </tr>
            <tr>
                <th>Attachment</th>
                <td>
                    @if($form->attachment_path)
                        <a href="{{ asset('storage/' . $form->attachment_path) }}" target="_blank">{{ basename($form->attachment_path) }}</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div style="margin-top:16px;">
        <button onclick="window.print()">Print / Save as PDF</button>
    </div>
</body>
</html>
