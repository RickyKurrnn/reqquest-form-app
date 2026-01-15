<!DOCTYPE html>
<html>

<head>
    <style>
        @page {
            margin-top: 1em;
            margin-bottom: 3em;
            counter-increment: page;
        }

        .page-number:after {
            content: "Page " counter(page) " of 1";
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 9.5pt;
        }

        /* ================= FOOTER ================= */
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
            color: #888;
        }

        /* ================= HEADER ================= */
        .logo-column img {
            height: 45px;
            width: auto;
        }

        .title-main {
            font-size: 20px;
            font-weight: bold;
            white-space: nowrap;
        }

        .title-sub {
            font-size: 15px;
            font-weight: bold;
        }

        .title-team {
            font-size: 14px;
            font-weight: bold;
        }

        /* ================= COMMON ================= */
        .text-bold {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .bg-gray-light {
            background-color: #f2f2f2;
        }

        .bg-gray-dark {
            background-color: #e0e0e0;
        }

        /* ================= CHECKBOX TABLE ================= */
        .new-layout-container {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .new-layout-container>tbody>tr>td {
            border: 1px solid #000;
            vertical-align: top;
            padding: 0;
            width: 50%;
        }

        .table-inner {
            width: 100%;
            border-collapse: collapse;
            font-size: 9.5pt;
        }

        .table-inner td {
            border-bottom: 1px solid #000;
            border-right: 1px solid #000;
            padding: 3px 5px;
            height: 22px;
            white-space: nowrap;
        }

        .table-inner tr:last-child td {
            border-bottom: none;
        }

        .table-inner td:last-child {
            border-right: none;
        }

        .col-check {
            width: 20px;
            text-align: center;
            font-size: 8.5pt;
        }

        .double-bottom {
            border-bottom: 3px double #000 !important;
        }

        /* ================= LABEL MODULE ================= */
        .label-module {
            background-color: #f2f2f2;
            font-weight: bold;
            padding: 8px !important;
            vertical-align: top;
        }
    </style>

</head>


<body>

    <div class="container-fluid" style="padding: 20px;">

        <table width="100%" style="border-collapse:collapse; margin-bottom:4px;">
            <tr>
                <td style="width:220px; vertical-align:middle;">
                    <img src="{{ public_path('images/emtek_digital_logo3.png') }}" style="height:45px; width:auto;">
                </td>
                <td style="vertical-align:middle; padding-left:15px;">
                    <div style="font-size:20px; font-weight:bold; white-space:nowrap;">
                        INFORMATION TECHNOLOGY DIVISION
                    </div>
                    <div style="font-size:15px; font-weight:bold; margin-top:4px;">
                        Business Application Department
                    </div>
                    <div style="font-size:14px; font-weight:bold; margin-top:2px;">
                        IT SAP Team
                    </div>
                </td>
            </tr>
        </table>

        <table width="100%" style="border-collapse:collapse; margin-bottom:10px;">
            <tr>
                <td style="height:5px; background:#5b84c1;"></td>
            </tr>
        </table>

        <table width="100%" style="margin-bottom: 3px; margin-top: 0.8em; border-collapse: collapse;">
            <tr>
                <td style="vertical-align: top; width: 50%;">
                    <div style="font-weight: bold; font-size: 15pt; margin-top: 8px;">
                        SAP Transport/SCC4 Form
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

        <table width="100%" style="border-collapse:collapse; font-size:9.5pt; margin-top:5px;">

            <tr>
                <!-- Name -->
                <td width="17%" style="border:1px solid #000; background:#f0f0f0; padding:0;">
                    <table width="100%" style="font-size:9.5pt;">
                        <tr>
                            <td style="white-space:nowrap; font-weight:bold; padding:4px 6px;">
                                Name
                            </td>
                            <td style="text-align:right; width:10px; font-weight:bold; padding:4px 6px;">
                                :
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="31%" style="border:1px solid #000; padding:6px 8px; font-size:9.5pt;">
                    {{ $form->name ?? 'Yan Pratama' }}
                </td>

                <!-- Division -->
                <td width="17%" style="border:1px solid #000; background:#f0f0f0; padding:0;">
                    <table width="100%" style="font-size:9.5pt;">
                        <tr>
                            <td style="white-space:nowrap; font-weight:bold; padding:4px 6px;">
                                Division
                            </td>
                            <td style="text-align:right; width:10px; font-weight:bold; padding:4px 6px;">
                                :
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="35%" style="border:1px solid #000; padding:6px 8px; font-size:9.5pt;"></td>
            </tr>

            <tr>
                <!-- Company -->
                <td style="border:1px solid #000; background:#f0f0f0; padding:0;">
                    <table width="100%" style="font-size:9.5pt;">
                        <tr>
                            <td style="white-space:nowrap; font-weight:bold; padding:4px 6px;">
                                Company
                            </td>
                            <td style="text-align:right; width:10px; font-weight:bold; padding:4px 6px;">
                                :
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="border:1px solid #000; padding:6px 8px; font-size:9.5pt;"></td>

                <!-- Department -->
                <td style="border:1px solid #000; background:#f0f0f0; padding:0;">
                    <table width="100%" style="font-size:9.5pt;">
                        <tr>
                            <td style="white-space:nowrap; font-weight:bold; padding:4px 6px;">
                                Department
                            </td>
                            <td style="text-align:right; width:10px; font-weight:bold; padding:4px 6px;">
                                :
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="border:1px solid #000; padding:6px 8px; font-size:9.5pt;"></td>
            </tr>

            <tr>
                <!-- Employee ID -->
                <td style="border:1px solid #000; background:#f0f0f0; padding:0;">
                    <table width="100%" style="font-size:9.5pt;">
                        <tr>
                            <td style="white-space:nowrap; font-weight:bold; padding:4px 6px;">
                                Employee ID
                            </td>
                            <td style="text-align:right; width:10px; font-weight:bold; padding:4px 6px;">
                                :
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="border:1px solid #000; padding:6px 8px; font-size:9.5pt;"></td>

                <!-- Position -->
                <td style="border:1px solid #000; background:#f0f0f0; padding:0;">
                    <table width="100%" style="font-size:9.5pt;">
                        <tr>
                            <td style="white-space:nowrap; font-weight:bold; padding:4px 6px;">
                                Position
                            </td>
                            <td style="text-align:right; width:10px; font-weight:bold; padding:4px 6px;">
                                :
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="border:1px solid #000; padding:6px 8px; font-size:9.5pt;"></td>
            </tr>

            <tr>
                <!-- SAP Username -->
                <td style="border:1px solid #000; background:#f0f0f0; padding:0;">
                    <table width="100%" style="font-size:9.5pt;">
                        <tr>
                            <td style="white-space:nowrap; font-weight:bold; padding:4px 6px;">
                                SAP Username
                            </td>
                            <td style="text-align:right; width:10px; font-weight:bold; padding:4px 6px;">
                                :
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="border:1px solid #000; padding:6px 8px; font-size:9.5pt;"></td>

                <!-- Email -->
                <td style="border:1px solid #000; background:#f0f0f0; padding:0;">
                    <table width="100%" style="font-size:9.5pt;">
                        <tr>
                            <td style="white-space:nowrap; font-weight:bold; padding:4px 6px;">
                                Email
                            </td>
                            <td style="text-align:right; width:10px; font-weight:bold; padding:4px 6px;">
                                :
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="border:1px solid #000; padding:6px 8px; font-size:9.5pt; word-break:break-word;">
                    {{ $form->email ?? 'yan.pratama@sctv.co.id' }}
                </td>
            </tr>

        </table>


        <table class="new-layout-container" style="font-size:9.5pt;">
            <tr>
                <!-- SAP MODULE -->
                <td>
                    <table class="table-inner" style="font-size:9.5pt;">
                        <tr>
                            <td rowspan="6" class="bg-gray-light text-bold"
                                style="width:90px; vertical-align:top; font-size:9.5pt;">
                                SAP Module :
                            </td>
                            <td class="col-check" style="font-size:8.5pt;">X</td>
                            <td style="font-size:9.5pt;">Finance Accounting (FI)</td>
                        </tr>
                        <tr>
                            <td class="col-check" style="font-size:8.5pt;"></td>
                            <td>Controlling (CO)</td>
                        </tr>
                        <tr>
                            <td class="col-check" style="font-size:8.5pt;"></td>
                            <td>Plant Maintenance (PM)</td>
                        </tr>
                        <tr>
                            <td class="col-check" style="font-size:8.5pt;"></td>
                            <td>Material Management (MM)</td>
                        </tr>
                        <tr>
                            <td class="col-check" style="font-size:8.5pt;"></td>
                            <td>Project System (PS)</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="bg-gray-dark" style="height:25px;"></td>
                        </tr>
                    </table>
                </td>

                <!-- CLIENT -->
                <td>
                    <table class="table-inner" style="font-size:9.5pt;">
                        <tr>
                            <td rowspan="6" class="bg-gray-light text-bold"
                                style="width:60px; vertical-align:top; font-size:9.5pt;">
                                Client :
                            </td>
                            <td colspan="2" class="bg-gray-light text-bold text-center double-bottom"
                                style="font-size:9.5pt;">
                                QA
                            </td>
                            <td colspan="2" class="bg-gray-light text-bold text-center double-bottom"
                                style="font-size:9.5pt;">
                                Prod
                            </td>
                        </tr>
                        <tr>
                            <td class="col-check" style="font-size:8.5pt;"></td>
                            <td>200 (ECC)</td>
                            <td class="col-check" style="font-size:8.5pt;"></td>
                            <td>300 (ECC)</td>
                        </tr>
                        <tr>
                            <td class="col-check" style="font-size:8.5pt;"></td>
                            <td>250 (ECC)</td>
                            <td class="col-check" style="font-size:8.5pt;"></td>
                            <td>360 (ECC)</td>
                        </tr>
                        <tr>
                            <td class="col-check" style="font-size:8.5pt;"></td>
                            <td>710 (ECC)</td>
                            <td class="col-check" style="font-size:8.5pt;"></td>
                            <td>720 (ECC)</td>
                        </tr>
                        <tr>
                            <td class="col-check" style="font-size:8.5pt;"></td>
                            <td>810 (ECC)</td>
                            <td class="col-check" style="font-size:8.5pt;"></td>
                            <td>820 (ECC)</td>
                        </tr>
                        <tr>
                            <td class="col-check" style="font-size:8.5pt;">X</td>
                            <td>200 (HANA)</td>
                            <td class="col-check" style="font-size:8.5pt;">X</td>
                            <td>888 (HANA)</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>


        <div style="font-size:10pt;"><em>(Insert "X" in the corresponding module checkbox)</em></div>

        <table width="100%" style="border-collapse: collapse; font-size:9.5pt; margin-top:10px;">
            <tr>
                <!-- Request Description -->
                <td class="label-module"
                    style="width:25%; min-width:150px; border:1px solid #000; padding:0; vertical-align:top; font-size:9.5pt;">
                    <table width="100%" style="border-collapse:collapse; font-size:9.5pt;">
                        <tr>
                            <td style="font-weight:bold; white-space:nowrap;">
                                Request Description
                            </td>
                            <td style="text-align:right; width:10px; font-weight:bold;">:</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="height:5.5%;"></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-weight:normal; vertical-align:bo;">
                                <em>(T-Code, Request ECC, reason, etc.)</em>
                            </td>
                        </tr>
                    </table>
                </td>

                <!-- CONTENT -->
                <td style="border:1px solid #000; padding:8px; vertical-align: top; font-size:9.5pt;">
                    <div style="line-height:1.3; font-size:9.5pt;">
                        Transport terkait request untuk pembuatan order type capex untuk company 2111 :
                        <br>

                        <table style="width:100%; border-collapse:collapse; font-size:9.5pt;">
                            <tr>
                                <td style="width:33%; padding:0;">Order type</td>
                                <td style="width:10px; text-align:center; padding:0;">:</td>
                                <td style="padding:0;">C21A - SSI Capex Budget (Statistical)</td>
                            </tr>
                            <tr>
                                <td style="padding:0;">Number range</td>
                                <td style="text-align:center; padding:0;">:</td>
                                <td style="padding:0;">20000 sd 29999</td>
                            </tr><br>
                            <tr>
                                <td colspan="3" style="padding-top:6px; word-break:break-word;">
                                    S4DK904076 100 IT_ASTRIAN CO - MEITA - 2111 Set up new order type
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

        <table width="100%" style="border-collapse: collapse; font-size:9.5pt; margin-top:15px;">

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
            vertical-align: middle; height:140px; font-weight:bold;">
                    Requestor
                </td>

                <td
                    style="border:1px solid #000; font-weight:bold; height:70px;
            vertical-align: middle; padding-left:8px;">
                    Requested By
                </td>

                <td style="border:1px solid #000; height:70px;
            vertical-align: middle; padding-left:8px;">
                    Yan Pratama
                </td>

                <td style="border:1px solid #000; height:70px;
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

                <td style="border:1px solid #000; height:70px;
            vertical-align: middle; padding-left:8px;">
                </td>

                <td style="border:1px solid #000; height:70px;"></td>
            </tr>

            <!-- IT Division -->
            <tr>
                <td rowspan="2"
                    style="border:1px solid #000; background:#f2f2f2; text-align:center;
            vertical-align: middle; height:140px; font-weight:bold;">
                    IT Division
                </td>

                <td
                    style="border:1px solid #000; font-weight:bold; height:70px;
            vertical-align: middle; padding-left:8px;">
                    SAP Functional
                </td>

                <td style="border:1px solid #000; height:70px;
            vertical-align: middle; padding-left:8px;">
                    Astrian Meitasari
                </td>

                <td style="border:1px solid #000; height:70px;
            vertical-align: middle; text-align:center;">
                    <img src="{{ public_path('images/ttd.jpg') }}" style="height:70px;">
                </td>
            </tr>

            <tr>
                <td
                    style="border:1px solid #000; font-weight:bold; height:70px;
            vertical-align: middle; padding-left:8px;">
                    IT BA Dept Head
                </td>

                <td style="border:1px solid #000; height:70px;
            vertical-align: middle; padding-left:8px;">
                    Daniel Kosasi
                </td>

                <td style="border:1px solid #000; height:70px;"></td>
            </tr>

        </table>



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
