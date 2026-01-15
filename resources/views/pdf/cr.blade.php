<!DOCTYPE html>
<html>

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
                        SAP Change Request Form
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
                        Doc. Number: 50/TCODE/DS/NE/CO/ITD/ITBA/2025
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
                    {{ $form->name ?? 'Yan Pratama' }}
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
                <td width="35%" style="border:1px solid #000; padding:6px 8px;"></td>
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
                <td style="border:1px solid #000; padding:6px 8px;"></td>

                <!-- Department -->
                <td style="border:1px solid #000; background:#f0f0f0; padding:0;">
                    <table width="100%">
                        <tr>
                            <td style="white-space:nowrap; font-weight:bold; padding:4px 6px;">Department</td>
                            <td style="text-align:right; width:10px; font-weight:bold; padding:4px 6px;">:</td>
                        </tr>
                    </table>
                </td>
                <td style="border:1px solid #000; padding:6px 8px;"></td>
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
                <td style="border:1px solid #000; padding:6px 8px;"></td>

                <!-- Position -->
                <td style="border:1px solid #000; background:#f0f0f0; padding:0;">
                    <table width="100%">
                        <tr>
                            <td style="white-space:nowrap; font-weight:bold; padding:4px 6px;">Position</td>
                            <td style="text-align:right; width:10px; font-weight:bold; padding:4px 6px;">:</td>
                        </tr>
                    </table>
                </td>
                <td style="border:1px solid #000; padding:6px 8px;"></td>
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
                <td style="border:1px solid #000; padding:6px 8px;"></td>

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
                    {{ $form->email ?? 'yan.pratama@sctv.co.id' }}
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
                            <td class="check-box">{{ $form->module == 'FI' ? 'X' : '' }}</td>
                            <td>Finance Accounting (FI)</td>
                        </tr>
                        <tr>
                            <td class="check-box">X</td>
                            <td>Controlling (CO)</td>
                        </tr>
                        <tr>
                            <td class="check-box">{{ $form->module == 'PM' ? 'X' : '' }}</td>
                            <td>Plant Maintenance (PM)</td>
                        </tr>
                    </table>
                </td>

                <td style="width: 35%; vertical-align: top;">
                    <table class="inner-table">
                        <tr>
                            <td class="check-box">{{ $form->module == 'MM' ? 'X' : '' }}</td>
                            <td>Material Management (MM)</td>
                        </tr>
                        <tr>
                            <td class="check-box">{{ $form->module == 'PS' ? 'X' : '' }}</td>
                            <td>Project System (PS)</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 0 !important;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <tr>
                                        <td class="client-label">
                                            Client <span class="colon">:</span>
                                        </td>
                                        <td style="padding: 4px 8px;">888</td>
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
                <td class="label-module"
                    style="width:25%; min-width:150px; border:1px solid #000; padding:0; vertical-align:top;">
                    <table width="100%" style="border-collapse:collapse;">
                        <tr>
                            <td style="font-weight:bold; white-space:nowrap;">
                                Request Description
                            </td>
                            <td style="text-align:right; width:10px; font-weight:bold;">:</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-weight:normal; white-space:nowrap;">
                                <em>(Error, Tcode,<br> reason, document<br> no., etc.)</em>
                            </td>
                        </tr>
                    </table>
                </td>

                <td style="border:1px solid #000; padding:8px; vertical-align: top;">
                    <div style="min-height:150px; line-height:1.35;">
                        Pembuatan order type capex untuk company 2111 :<br><br>

                        <table style="width:100%; border-collapse:collapse;">
                            <tr>
                                <td style="width:33%; vertical-align:top; padding:0;">
                                    Order type
                                </td>
                                <td style="width:10px; text-align:center; padding:0;">
                                    :
                                </td>
                                <td style="padding:0;">
                                    C21A - SSI Capex Budget (Statistical)
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:0;">
                                    Number range
                                </td>
                                <td style="text-align:center; padding:0;">
                                    :
                                </td>
                                <td style="padding:0;">
                                    20000 sd 29999
                                </td>
                            </tr>
                        </table>
                    </div>
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
                    style="border:1px solid #000; font-weight:bold; height:70px;
                   vertical-align: middle; padding-left:8px;">
                    Requested By
                </td>

                <td
                    style="border:1px solid #000; height:70px;
                   vertical-align: middle; padding-left:8px;">
                    Yan Pratama
                </td>

                <td
                    style="border:1px solid #000; height:70px;
                   vertical-align: middle; text-align:center;">
                    {{-- signature --}}
                </td>
            </tr>

            <tr>
                <td
                    style="border:1px solid #000; font-weight:bold; height:70px;
                   vertical-align: middle; padding-left:8px;">
                    Approved By
                </td>

                <td
                    style="border:1px solid #000; height:70px;
                   vertical-align: middle; padding-left:8px;">
                </td>

                <td style="border:1px solid #000; height:70px;"></td>
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
                    SAP Functional
                </td>

                <td
                    style="border:1px solid #000; height:70px;
                   vertical-align: middle; padding-left:8px;">
                    Astrian Meitasari
                </td>

                <td
                    style="border:1px solid #000; height:70px;
                   vertical-align: middle; text-align:center;">
                    <img src="{{ public_path('images/ttd.jpg') }}" style="height:80px;">
                </td>
            </tr>

            <tr>
                <td
                    style="border:1px solid #000; font-weight:bold; height:70px;
                   vertical-align: middle; padding-left:8px;">
                    IT BA Dept Head
                </td>

                <td
                    style="border:1px solid #000; height:70px;
                   vertical-align: middle; padding-left:8px;">
                    Daniel Kosasi
                </td>

                <td style="border:1px solid #000; height:70px;"></td>
            </tr>

        </table>

        <!-- Page Break -->
        <div style="page-break-before: always;"></div>
        <div style="padding:20px;">
            <span style="margin-left:-20px; display:inline-block;">Lampiran:</span>

            <div style="margin-top: 10px; text-align:center;">
                @if ($form->attachment_path)
                    {{-- <img src="{{ public_path('storage/' . $form->attachment_path) }}"
                        style="max-width: 100%; border:1px solid #000;"> --}}
                    <img src="{{ public_path('images/scm_logo-removebg-preview.png') }}" style="max-width: 100%;">
                @else
                    <div style="border:1px solid #000; padding:10px;">Tidak ada lampiran</div>
                    <img src="{{ public_path('images/scm_logo-removebg-preview.png') }}" style="max-width: 100%;">
                @endif
                @if ($form->attachment_path)
                    {{-- <img src="{{ public_path('storage/' . $form->attachment_path) }}"
                        style="max-width: 100%; border:1px solid #000;"> --}}
                    <img src="{{ public_path('images/scm_logo-removebg-preview.png') }}" style="max-width: 100%;">
                @else
                    <div style="border:1px solid #000; padding:10px;">Tidak ada lampiran</div>
                    <img src="{{ public_path('images/scm_logo-removebg-preview.png') }}" style="max-width: 100%;">
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
