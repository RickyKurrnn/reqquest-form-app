<!DOCTYPE html>
<html>

@php
    $requested = $signatures->where('role', 'requested')->first();
    $approved = $signatures->where('role', 'approved')->first();
    $added = $signatures->where('role', 'added')->first();
    $acknowledged = $signatures->where('role', 'acknowledged')->first();
@endphp

<head>
    <style>
        @page {
            margin-top: 2em;
            margin-bottom: 3em;
            counter-increment: page;
        }

        .page-number:after {
            content: "Page " counter(page) " of 2";
        }

        .footer {
            position: fixed;
            bottom: -25px;
            right: 0;
            left: 0;
            font-size: 9pt;
            color: #000;
            padding-right: 20px;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .footer-right {
            text-align: right;
            padding-right: 20px;
            color: #888888;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .header {
            width: 100%;
            border-bottom: 5px solid #5b84c1;
            padding-bottom: 3px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .logo-column {
            width: 200px;
            vertical-align: middle;
        }

        .logo-column img {
            height: 70px;
            display: block;
        }

        .info-column {
            text-align: left;
            vertical-align: middle;
            padding-left: 10px;
        }

        .title-main {
            font-size: 21px;
            font-weight: bold;
            margin: 0;
            line-height: 1.2;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .title-sub {
            font-size: 16.5px;
            font-weight: bold;
            margin: 0;
            line-height: 1.2;
            padding-top: 3px;
        }

        .title-team {
            font-size: 14.5px;
            font-weight: bold;
            margin: 0;
            line-height: 1.2;
            margin-top: -7px
        }

        .module-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 10pt;
        }

        .module-table td {
            border: 1px solid #000;
            vertical-align: middle;
            padding: 0;
            /* Padding nol agar nested table rapat */
        }

        .label-module {
            background-color: #f2f2f2;
            font-weight: bold;
            width: 15%;
            padding: 8px !important;
            text-align: left;
            /* Ubah dari middle ke top agar tulisan naik ke atas */
            vertical-align: top;
        }

        /* Tabel kecil di dalam cell untuk checkbox */
        .inner-table {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }

        .inner-table td {
            border: none;
            border-bottom: 1px solid #000;
            padding: 4px 8px !important;
        }

        .inner-table tr:last-child td {
            border-bottom: none;
        }

        .check-box {
            width: 30px;
            text-align: center;
            border-right: 1px solid #000 !important;
            font-weight: bold;
        }

        .client-label {
            background-color: #f2f2f2;
            font-weight: bold;
            width: 80px;
            border-right: 1px solid #000 !important;
            padding: 4px 8px !important;
            vertical-align: middle;
        }

        .colon {
            float: right;
            /* Ini yang akan melempar titik dua ke ujung kanan td */
        }
    </style>

</head>


<body>

    <div class="container-fluid" style="padding: 20px;">

        <div class="header">
            <table class="header-table">
                <tr>
                    <td class="logo-column">
                        <img src="{{ public_path('images/scm_logo-removebg-preview.png') }}">
                    </td>
                    <td class="info-column">
                        <div class="title-main">INFORMATION TECHNOLOGY DIVISION</div>
                        <div class="title-sub">Business Application Department</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="info-column">
                        <div class="title-team">IT SAP Team</div>
                    </td>
                </tr>
            </table>
        </div>
        <table width="100%" style="margin-bottom: 3px; margin-top: 0.8em; border-collapse: collapse;">
            <tr>
                <td style="vertical-align: top; width: 50%;">
                    <div style="font-weight: bold; font-size: 15pt; margin-top: 8px;">
                        SAP Tcode Request Form
                    </div>
                </td>

                <td style="vertical-align: top; width: 40%;">
                    <table width="100%" style="border-collapse: collapse; font-size: 10pt;">
                        <tr>
                            <td
                                style="border: 1px solid #000; padding: 10px 5px; font-weight: bold; background:#f8f8f8;">
                                Request Date <span style="float:right;">:</span>
                            </td>
                            <td style="border: 1px solid #000; padding: 10px 5px;">
                                {{ \Carbon\Carbon::parse($form->request_date)->format('d/m/Y') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <div style="font-size: 10pt;">
                        Doc. Number: {{ $form->document_number }}
                    </div>
                </td>
            </tr>
        </table>

        <div style="font-weight: bold; font-size: 12pt; margin-top: 5px;">
            Requestor
        </div>

        <table width="100%" style="border-collapse:collapse; font-size:10pt; margin-top:5px;">

            <tr>
                <!-- Name -->
                <td width="17%" style="border:1px solid #000; background:#f0f0f0; padding:0;">
                    <table width="100%">
                        <tr>
                            <td style="white-space:nowrap; font-weight:bold; padding:4px 6px;">Name</td>
                            <td style="text-align:right; width:10px; font-weight:bold; padding:4px 6px;">:</td>
                        </tr>
                    </table>
                </td>
                <td width="31%" style="border:1px solid #000; padding:6px 8px;">
                    {{ $form->name}}
                </td>

                <!-- Division -->
                <td width="17%" style="border:1px solid #000; background:#f0f0f0; padding:0;">
                    <table width="100%">
                        <tr>
                            <td style="white-space:nowrap; font-weight:bold; padding:4px 6px;">Division</td>
                            <td style="text-align:right; width:10px; font-weight:bold; padding:4px 6px;">:</td>
                        </tr>
                    </table>
                </td>
                <td width="35%" style="border:1px solid #000; padding:6px 8px;">{{ $form->division}}</td>
            </tr>

            <tr>
                <!-- Company -->
                <td style="border:1px solid #000; background:#f0f0f0; padding:0;">
                    <table width="100%">
                        <tr>
                            <td style="white-space:nowrap; font-weight:bold; padding:4px 6px;">Company</td>
                            <td style="text-align:right; width:10px; font-weight:bold; padding:4px 6px;">:</td>
                        </tr>
                    </table>
                </td>
                <td style="border:1px solid #000; padding:6px 8px;">{{ $form->company}}</td>

                <!-- Department -->
                <td style="border:1px solid #000; background:#f0f0f0; padding:0;">
                    <table width="100%">
                        <tr>
                            <td style="white-space:nowrap; font-weight:bold; padding:4px 6px;">Department</td>
                            <td style="text-align:right; width:10px; font-weight:bold; padding:4px 6px;">:</td>
                        </tr>
                    </table>
                </td>
                <td style="border:1px solid #000; padding:6px 8px;">{{ $form->department}}</td>
            </tr>

            <tr>
                <!-- Employee ID -->
                <td style="border:1px solid #000; background:#f0f0f0; padding:0;">
                    <table width="100%">
                        <tr>
                            <td style="white-space:nowrap; font-weight:bold; padding:4px 6px;">Employee ID</td>
                            <td style="text-align:right; width:10px; font-weight:bold; padding:4px 6px;">:</td>
                        </tr>
                    </table>
                </td>
                <td style="border:1px solid #000; padding:6px 8px;">{{ $form->employee_id}}</td>

                <!-- Position -->
                <td style="border:1px solid #000; background:#f0f0f0; padding:0;">
                    <table width="100%">
                        <tr>
                            <td style="white-space:nowrap; font-weight:bold; padding:4px 6px;">Position</td>
                            <td style="text-align:right; width:10px; font-weight:bold; padding:4px 6px;">:</td>
                        </tr>
                    </table>
                </td>
                <td style="border:1px solid #000; padding:6px 8px;">{{ $form->position}}</td>
            </tr>

            <tr>
                <!-- SAP Username -->
                <td style="border:1px solid #000; background:#f0f0f0; padding:0;">
                    <table width="100%">
                        <tr>
                            <td style="white-space:nowrap; font-weight:bold; padding:4px 6px;">SAP Username</td>
                            <td style="text-align:right; width:10px; font-weight:bold; padding:4px 6px;">:</td>
                        </tr>
                    </table>
                </td>
                <td style="border:1px solid #000; padding:6px 8px;">{{ $form->sap_username}}</td>

                <!-- Email -->
                <td style="border:1px solid #000; background:#f0f0f0; padding:0;">
                    <table width="100%">
                        <tr>
                            <td style="white-space:nowrap; font-weight:bold; padding:4px 6px;">Email</td>
                            <td style="text-align:right; width:10px; font-weight:bold; padding:4px 6px;">:</td>
                        </tr>
                    </table>
                </td>
                <td style="border:1px solid #000; padding:6px 8px; word-break:break-word;">
                    {{ $form->email}}
                </td>
            </tr>

        </table>


        <table class="module-table">
            <tr>
                <td class="label-module" style="vertical-align: top; width:16%;">
                    SAP Module <span class="colon">:</span>
                </td>

                <td style="width: 35%;">
                    <table class="inner-table">
                        <tr>
                            <td class="check-box">{{ $form->sap_module == 'FI' ? 'X' : '' }}</td>
                            <td>Finance Accounting (FI)</td>
                        </tr>
                        <tr>
                            <td class="check-box">{{ $form->sap_module == 'CO' ? 'X' : '' }}</td>
                            <td>Controlling (CO)</td>
                        </tr>
                        <tr>
                            <td class="check-box">{{ $form->sap_module == 'PM' ? 'X' : '' }}</td>
                            <td>Plant Maintenance (PM)</td>
                        </tr>
                    </table>
                </td>

                <td style="width: 35%; vertical-align: top;">
                    <table class="inner-table">
                        <tr>
                            <td class="check-box">{{ $form->sap_module == 'MM' ? 'X' : '' }}</td>
                            <td>Material Management (MM)</td>
                        </tr>
                        <tr>
                            <td class="check-box">{{ $form->sap_module == 'PS' ? 'X' : '' }}</td>
                            <td>Project System (PS)</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 0 !important;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <tr>
                                        <td class="client-label">
                                            Client <span class="colon">:</span>
                                        </td>
                                        <td style="padding: 4px 8px;">{{$form->client}}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div style="font-size:10pt;"><em>(Insert "X" in the corresponding module checkbox)</em></div>

        <table width="100%" style="border-collapse: collapse; font-size:10pt; margin-top:10px;">
            <tr>
                <!-- Request Description -->
                <td class="label-module" style="width:25%; min-width:150px; border:1px solid #000; padding:0;">
                    <table width="100%">
                        <tr>
                            <td style="font-weight:bold; white-space:nowrap;">
                                Request Description
                            </td>
                            <td style="text-align:right; width:10px; font-weight:bold;">:</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-weight:normal; white-space:nowrap;">
                                <em>(Tcode, reason, etc.)</em>
                            </td>
                        </tr>
                    </table>
                </td>

                {{-- <td style="border:1px solid #000; padding:8px; vertical-align: top;">
                    Permohonan untuk menambahkan otorisasi di SAP S/4HANA:<br><br>

                    <strong>Tcode</strong>: S_ALR_87013620<br>
                    <strong>User</strong>: ACCT_RIZAL<br>
                    <strong>Company Code</strong>:
                    2100, 2104, 2110, 2111, 3100, 3500, 3700, 3800, 3810, 3820,
                    3821, 5000, 5100, 5110, 5200, 5300
                </td> --}}
                <td style="border:1px solid #000; padding:8px; vertical-align: top; height:100px;">
                    {{$form->request_description}}
                </td>
            </tr>

            <tr>
                <!-- Authorization Added -->
                <td class="label-module"
                    style="width:25%; min-width:150px; border:1px solid #000; padding:0; vertical-align: middle;">
                    <table width="100%">
                        <tr>
                            <td style="font-weight:bold; white-space:nowrap;">
                                Authorization Added
                            </td>
                            <td style="text-align:right; width:10px; font-weight:bold;">:</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-weight:normal; white-space:nowrap;">
                                <em>(Date of Authorization)</em>
                            </td>
                        </tr>
                    </table>
                </td>

                <td style="border:1px solid #000; height:45px; padding:8px;">
                    {{ $form->authorization_added->format('d F Y') }}
                </td>
            </tr>
        </table>

        <table width="100%" style="border-collapse: collapse; font-size:10pt; margin-top:15px;">

            <!-- Header -->
            <tr>
                <td style="border:1px solid #000; background:#9c9c9c; width:20%;"></td>
                <td
                    style="border:1px solid #000; background:#f2f2f2; font-weight:bold; text-align:center; width:22.5%;">
                    Approval
                </td>
                <td
                    style="border:1px solid #000; background:#f2f2f2; font-weight:bold; text-align:center; width:37.5%;">
                    Name
                </td>
                <td style="border:1px solid #000; background:#f2f2f2; font-weight:bold; text-align:center; width:20%;">
                    Signature
                </td>
            </tr>

            <!-- Requestor -->
            <tr>
                <td rowspan="2"
                    style="border:1px solid #000; background:#f2f2f2; text-align:center;
                   vertical-align: middle; height:140px;">
                    Requestor
                </td>

                <td
                    style="border:1px solid #000; font-weight:bold; height:75px;
                   vertical-align: middle; padding-left:8px;">
                    Requested By
                </td>

                <td
                    style="border:1px solid #000; height:70px;
                   vertical-align: middle; padding-left:8px;">
                    {{ $requested?->name }}
                </td>

                <td
                    style="border:1px solid #000; height:70px;
                   vertical-align: middle; text-align:center;">
                    <img src="{{ public_path('storage/' . $requested?->signature_path) }}" style="height:70px;">
                </td>
            </tr>

            <tr>
                <td
                    style="border:1px solid #000; font-weight:bold; height:70px;
                   vertical-align: middle; padding-left:8px;">
                    Approved By
                </td>

                <td style="border:1px solid #000; height:70px;
                   vertical-align: middle; padding-left:8px;">
                   {{ $approved?->name }}
                </td>

                <td style="border:1px solid #000; height:70px;">
                    <img src="{{ public_path('storage/' . $approved?->signature_path) }}" style="height:70px;">
                </td>
            </tr>

            <!-- IT Division -->
            <tr>
                <td rowspan="2"
                    style="border:1px solid #000; background:#f2f2f2; text-align:center;
                   vertical-align: middle; height:140px;">
                    IT Division
                </td>

                <td
                    style="border:1px solid #000; font-weight:bold; height:70px;
                   vertical-align: middle; padding-left:8px;">
                    Added By
                </td>

                <td
                    style="border:1px solid #000; height:70px;
                   vertical-align: middle; padding-left:8px;">
                    {{ $added?->name }}
                </td>

                <td
                    style="border:1px solid #000; height:70px;
                   vertical-align: middle; text-align:center;">
                    <img src="{{ public_path('storage/' . $added?->signature_path) }}" style="height:70px;">
                </td>
            </tr>

            <tr>
                <td
                    style="border:1px solid #000; font-weight:bold; height:70px;
                   vertical-align: middle; padding-left:8px;">
                    Acknowledged By
                </td>

                <td
                    style="border:1px solid #000; height:70px;
                   vertical-align: middle; padding-left:8px;">
                    {{ $acknowledged?->name }}
                </td>

                <td style="border:1px solid #000; height:70px;">
                    <img src="{{ public_path('storage/' . $acknowledged?->signature_path) }}" style="height:70px;">
                </td>
            </tr>

        </table>

        <!-- Page Break -->
        <div style="page-break-before: always;"></div>
        <div style="padding:20px;">
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

        <div style="text-align:center; font-weight:bold; padding-top:10%;">END</div>


    </div>

    <div class="footer">
        <table class="footer-table">
            <tr>
                <td class="footer-right">
                    SAP User Access Form
                </td>
            </tr>
            <tr>
                <td class="footer-right page-number"></td>
            </tr>
        </table>
    </div>


</body>

</html>
