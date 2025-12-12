<!DOCTYPE html>
<html>

@php
    $requested = $signatures->where('role', 'requested')->first();
    $approved = $signatures->where('role', 'approved')->first();
    $executed = $signatures->where('role', 'executed')->first();
    $acknowledged = $signatures->where('role', 'acknowledged')->first();
@endphp

<head>
    <meta charset="UTF-8">
    <title>Request Form Header</title>
    <style>
        @page {
            margin-top: 0;
        }

        body {
            /* font-family: Arial, sans-serif; */
            font-family: Calibri, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10pt;
        }

        .container-fluid {
            padding: 20px;
            margin-top: 7.4em;
        }

        .header-section {
            position: fixed;
            top: 0;
            left: 0;
            width: calc(100% - 40px);
            margin-left: 20px;
            margin-right: 20px;

            border-bottom: 1px solid #000;
            padding: 10px 0 0 0;
            background: #fff;
            height: 90px;
            /* line-height: 60px; */
            z-index: 1000;
        }

        /* Condition header table */
        .condition-header-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0.1em;
        }

        .condition-header-table td {
            border: 1px solid #000;
            padding: 5px;
            font-weight: bold;
            background: #f8f8f8;
        }

        .condition-box {
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            height: 120px;
            padding: 8px;
            font-size: 9pt;
        }

        /* detail header table */
        .expectations-header-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.2em;
        }

        .expectations-header-table td {
            border: 1px solid #000;
            padding: 5px;
            font-weight: bold;
            background: #f8f8f8;
        }

        .expectations-box {
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            height: 120px;
            padding: 8px;
            font-size: 9pt;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;

            padding: 0 20px;
            background: #fff;
            font-size: 9pt;
        }

        .footer-table {
            width: 100%;
            border-top: 1px solid #000;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .footer-center {
            text-align: center;
            white-space: nowrap;
        }

        .fw-bold {
            font-weight: bold;
        }

        .fs-4 {
            font-size: 1.5rem;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .text-muted {
            color: #6c757d;
        }
    </style>

</head>

<body>

    <div class="container-fluid" style="padding: 20px;">

        <div class="header-section">
            <div style="width: 70%; display: inline-block; vertical-align: middle; line-height: normal;">
                {{-- <span style="font-size: 2em; font-weight: bold;">emtek</span>
                <span style="font-size: 2em;">media</span> --}}
                <img src="{{ public_path('images/emtek_digital_logo.png') }}" style="height:180px;">

            </div>

            <div
                style="width: 29%; display: inline-block; text-align: right; vertical-align: middle; line-height: normal;">
                <h4 style="margin: 0; font-size: 1.8em;">Form Request</h4>
            </div>

        </div>

        <table width="100%" style="margin-bottom: 15px;">
            <tr>
                <!-- LEFT -->
                <td style="vertical-align: top; width: 50%;">
                    <div style="font-weight: bold; font-size: 16pt;">Request Form</div>
                    <div>Deployment Request</div>
                </td>

                <!-- RIGHT -->
                <td style="vertical-align: top; width: 50%;">

                    <table width="100%" style="border-collapse: collapse; font-size: 10pt;">
                        <tr>
                            <td
                                style="border: 1px solid #000; padding: 10px 5px; font-weight: bold; background:#f8f8f8; width: 50%;">
                                Request Date <span style="float: right;">:</span>
                            </td>
                            <td style="border: 1px solid #000; padding: 10px 5px; width: 50%;">
                                {{ $form->request_date }}
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>

        <div class="mb-2" style="margin-top: 1.5em;">Doc Number: {{ $form->id }}</div>
        <div class="mb-2" style="margin-top: 1.5em;">Application Name: {{ $form->application_name }}</div>

        <div class="mt-3" style="margin-top: 1.5em;">This form is to request change(s) of the following data:</div>

        <table class="condition-header-table" style="width:100%; border-collapse: collapse;">
            <tr>
                <td class="col-left" style="border: 1px solid #000; border-right: none; padding:5px;">
                    Existing/Current Condition (Optional)
                </td>
                <td class="col-right" style="border-left: none; text-align:right; padding:5px; font-weight:normal;">
                    <em>(Deskripsi kondisi saat ini)</em>
                </td>
            </tr>
        </table>

        <div class="condition-box" style="position: relative; height: 120px; padding: 8px;">

            @if (!empty($form->existing_condition))
                <span>{{ $form->existing_condition }}</span>
            @else
                <em class="text-muted" style="position: absolute; bottom: 8px;">
                    *Diisi oleh requester
                </em>
            @endif

        </div>


        <table class="expectations-header-table" style="width:100%; border-collapse: collapse; ">
            <tr>
                <td class="col-left" style="border: 1px solid #000; border-right: none; padding:5px;">
                    Expectations/Detail Request
                </td>
                <td class="col-right" style="border-left: none; text-align:right; padding:5px; font-weight:normal;">
                    <em>(Deskripsi kondisi yang diharapkan)</em>
                </td>
            </tr>
        </table>

        <div class="expectations-box">
            <span>{{ $form->expectations }}</span>
        </div>

        <table
            style="width:100%; border-collapse: collapse; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; margin-top:1.2em;">
            <!-- Header -->
            <tr style="background:#f8f8f8; font-weight:bold;">
                <td
                    style="border:1px solid #000; border-right:1px solid #000; text-align:center; vertical-align:middle; padding:5px; width:50%;">
                    Requested By
                </td>
                <td
                    style="border:1px solid #000; border-left:0; text-align:center; vertical-align:middle; padding:5px; width:50%;">
                    Approved By
                </td>
            </tr>

            <!-- Box Tanda Tangan -->
            <tr>
                <td style="border-right:1px solid #000; vertical-align:bottom; height:100px; padding-left:1em;">

                    <div style="text-align:center;">
                        {{-- <img src="{{ public_path($requested?->signature_path) }}" style="height:90px;"> --}}
                        <img src="{{ public_path('storage/' . $requested?->signature_path) }}" style="height:90px;">
                    </div>

                    <div>
                        Date: {{ $requested?->date }}
                    </div>

                </td>

                <td style="vertical-align:bottom; height:100px; padding-left:1em;">

                    <div style="text-align:center;">
                        {{-- <img src="{{ public_path($approved?->signature_path) }}" style="height:90px;"> --}}
                        <img src="{{ public_path('storage/' . $approved?->signature_path) }}" style="height:90px;">
                    </div>

                    <div>
                        Date: {{ $approved?->date }}
                    </div>

                </td>
            </tr>

            <!-- Box Nama Pemilik Tanda Tangan -->
            <tr>
                <td style="border:1px solid #000; height:20px; text-align:center;">
                    <div style="font-weight:bold;">{{ $requested?->name }}</div>
                    <div style="font-weight:normal;">{{ $requested?->position }}</div>
                </td>

                <td style="border:1px solid #000; height:20px; text-align:center;">
                    <div style="font-weight:bold;">{{ $approved?->name }}</div>
                    <div style="font-weight:normal;">{{ $approved?->position }}</div>
                </td>
            </tr>
        </table>

        <table
            style="width:100%; border-collapse: collapse; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; margin-top:1.2em;">
            <!-- Header -->
            <tr style="background:#f8f8f8; font-weight:bold;">
                <td
                    style="border:1px solid #000; border-right:1px solid #000; text-align:center; vertical-align:middle; padding:5px; width:50%;">
                    Executed By
                </td>
                <td
                    style="border:1px solid #000; border-left:0; text-align:center; vertical-align:middle; padding:5px;width:50%;">
                    Acknowledged By
                </td>
            </tr>

            <!-- Box Tanda Tangan -->
            <tr>
                <td style="border-right:1px solid #000; vertical-align:bottom; height:100px; padding-left:1em;">

                    <div style="text-align:center;">
                        {{-- <img src="{{ public_path($executed?->signature_path) }}" style="height:90px;"> --}}
                        <img src="{{ public_path('storage/' . $executed?->signature_path) }}" style="height:90px;">
                    </div>

                    <div>
                        Date: {{ $executed?->date }}
                    </div>

                </td>

                <td style="vertical-align:bottom; height:100px; padding-left:1em;">

                    <div style="text-align:center;">
                        {{-- <img src="{{ public_path($acknowledged?->signature_path) }}" style="height:90px;"> --}}
                        <img src="{{ public_path('storage/' . $acknowledged?->signature_path) }}" style="height:90px;">
                    </div>

                    <div>
                        Date: {{ $acknowledged?->date }}
                    </div>
                </td>
            </tr>

            <!-- Box Nama Pemilik Tanda Tangan -->
            <tr>
                <td style="border:1px solid #000; height:20px; text-align:center;">
                    <div style="font-weight:bold;">{{ $executed?->name }}</div>
                    <div style="font-weight:normal;">{{ $executed?->position }}</div>
                </td>

                <td style="border:1px solid #000; height:20px; text-align:center;">
                    <div style="font-weight:bold;">{{ $acknowledged?->name }}</div>
                    <div style="font-weight:normal;">{{ $acknowledged?->position }}</div>
                </td>
            </tr>
        </table>

        <div class="footer">
            <table class="footer-table">
                <tr>
                    <td style="text-align:left;">Emtek Media - Information Technology</td>
                    <td></td>
                    <td style="text-align:right;">Page 1</td>
                </tr>

                <tr>
                    <td style="text-align:left;">of 2</td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td></td>
                    <td class="footer-center">
                        IT Business Application - IT Custom Application
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>

        <!-- Page Break -->
        <div style="page-break-before: always;"></div>

        <div class="header-section">
            <div style="width: 70%; display: inline-block; vertical-align: middle; line-height: normal;">
                {{-- <span style="font-size: 2em; font-weight: bold;">emtek</span>
                <span style="font-size: 2em;">media</span> --}}
                <img src="{{ public_path('images/emtek_digital_logo.png') }}" style="height:180px;">

            </div>

            <div
                style="width: 29%; display: inline-block; text-align: right; vertical-align: middle; line-height: normal;">
                <h4 style="margin: 0; font-size: 1.8em;">Form Request</h4>
            </div>

        </div>

        <div style="margin-top: 7.4em; padding:20px;">
            <span style="margin-left:-20px; display:inline-block;">Lampiran:</span>

            <div style="margin-top: 10px; text-align:center;">
                @if ($form->attachment_path)
                    <img src="{{ public_path('storage/' . $form->attachment_path) }}"
                        style="max-width: 100%; border:1px solid #000;">
                @else
                    <div style="border:1px solid #000; padding:10px;">Tidak ada lampiran</div>
                @endif

            </div>
        </div>

        <div class="footer">
            <table class="footer-table">
                <tr>
                    <td style="text-align:left;">Emtek Media - Information Technology</td>
                    <td></td>
                    <td style="text-align:right;">Page 2</td>
                </tr>

                <tr>
                    <td style="text-align:left;">of 2</td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td></td>
                    <td class="footer-center">
                        IT Business Application - IT Custom Application
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>

    </div>

</body>

</html>
