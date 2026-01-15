<!DOCTYPE html>
<html>

<head>
    <style>
        @page {
            margin-top: 0;
            /* margin-bottom: 3em; */
            counter-increment: page;
        }

        .page-number:after {
            content: "Page " counter(page) " of 5";
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
            margin-top: 10px;
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

        .master-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            table-layout: fixed;
            border: 1px solid #000;
        }

        .master-table>tbody>tr>td {
            vertical-align: top;
            padding: 0;
            border-right: 1px solid #000;
        }

        .sub-table {
            width: 100%;
            border-collapse: collapse;
        }

        /* 1. Pastikan tinggi dasar terjaga agar tetap sinkron 6 baris */
        .sub-table td {
            border-bottom: 1px solid #000;
            border-right: 1px solid #000;
            padding: 4px 6px;
            height: 22px;
            /* Menjaga tinggi baris standar */
            font-size: 9.5pt;
            vertical-align: middle;
        }

        /* 2. TAMBAHKAN INI: Khusus untuk Case Desc yang mengambil 2 baris */
        /* vertical-align: top agar teks panjang mulai dari atas sel */
        .sub-table td[rowspan="2"] {
            vertical-align: top;
            padding-top: 6px;
            height: 44px;
            /* Tinggi akumulasi 2 baris (22px * 2) */
        }

        /* 3. Pastikan teks di Scenario & Case Desc bisa membungkus (wrap) */
        .sub-table td.content-text {
            white-space: normal;
            line-height: 1.2;
        }

        .sub-table td.label-bg {
            background-color: #f2f2f2;
            font-weight: bold;
            font-size: 9.5pt !important;
        }

        .sub-table tr:last-child td {
            border-bottom: none;
        }

        .sub-table td:last-child {
            border-right: none;
        }

        .check-box {
            width: 25px;
            text-align: center;
            font-weight: bold;
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
                        <div class="title-team" style="padding-bottom: 3%; margin-top:-12px;">IT SAP Team</div>
                    </td>
                </tr>
            </table>
        </div>
        <table width="100%" style="margin-bottom: 3px; margin-top: 0.8em; border-collapse: collapse; padding-top:1%;">
            <tr>
                <td style="vertical-align: top; width: 65%;">
                    <div style="font-weight: bold; font-size: 15pt; margin-top: 8px;">
                        SAP Functional Test Form
                    </div>
                </td>

                <td colspan="2">
                    <div style="font-size: 10pt;">
                        Doc. No: 057/FUNC/DS/NE/CO/ITD/ITBA/2025
                    </div>
                </td>
            </tr>
        </table>

        <table class="master-table">
            <tr>
                <td style="width: 45%;">
                    <table class="sub-table">
                        <tr>
                            <td rowspan="2" class="label-bg" style="width: 80px;">Scenario <span
                                    style="float:right;">:</span></td>
                            <td rowspan="2" style="white-space: normal; vertical-align: middle;">
                                Pembuatan master data order menggunakan order type capex C21A
                            </td>
                        </tr>
                        <tr></tr>

                        <tr>
                            <td rowspan="2" class="label-bg">Case Desc <span style="float:right;">:</span></td>
                            <td rowspan="2" style="white-space: normal; vertical-align: middle;">
                                Pembuatan master data order menggunakan order type capex C21A
                            </td>
                        </tr>
                        <tr></tr>

                        <tr>
                            <td class="label-bg">Run Date <span style="float:right;">:</span></td>
                            <td>05/11/2025</td>
                        </tr>
                        <tr>
                            <td class="label-bg">Status <span style="float:right;">:</span></td>
                            <td>OK</td>
                        </tr>
                        <tr>
                            <td class="label-bg">T-Code <span style="float:right;">:</span></td>
                            <td>KO01, KO30, S_ALR_87013019</td>
                        </tr>
                    </table>
                </td>

                <td style="width: 30%;">
                    <table class="sub-table">
                        <tr>
                            <td rowspan="7" class="label-bg" style="width: 65px; vertical-align: top;">Module:</td>
                            <td rowspan="2" class="check-box" style="vertical-align: middle;">X</td>
                            <td rowspan="2" style="vertical-align: middle;">Finance Accounting (FI)</td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td class="check-box"></td>
                            <td>Controlling (CO)</td>
                        </tr>
                        <tr>
                            <td class="check-box"></td>
                            <td>Plant Maintenance (PM)</td>
                        </tr>
                        <tr>
                            <td class="check-box"></td>
                            <td>Material Management (MM)</td>
                        </tr>
                        <tr>
                            <td class="check-box"></td>
                            <td>Project System (PS)</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="background-color:#f2f2f2; height:22px;"></td>
                        </tr>
                    </table>
                </td>

                <td style="width: 25%;">
                    <table class="sub-table">
                        <tr>
                            <td rowspan="7" class="label-bg" style="width: 55px; vertical-align: top;">Client:</td>
                            <td colspan="2" rowspan="2" class="label-bg"
                                style="text-align:center; border-bottom: 3px double #000; vertical-align: middle;">QA
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td class="check-box"></td>
                            <td>200 (ECC)</td>
                        </tr>
                        <tr>
                            <td class="check-box"></td>
                            <td>250 (ECC)</td>
                        </tr>
                        <tr>
                            <td class="check-box"></td>
                            <td>710 (ECC)</td>
                        </tr>
                        <tr>
                            <td class="check-box"></td>
                            <td>810 (ECC)</td>
                        </tr>
                        <tr>
                            <td class="check-box">X</td>
                            <td>200 (HANA)</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div style="font-size:10pt;"><em>(Insert "X" in the corresponding module checkbox)</em></div>

        <div style="font-size:10pt; font-weight:bold; margin-top: 5px;">Transactional Steps :</div>

        <table
            style="width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 9pt; font-family: Arial, sans-serif; border: 1px solid #000;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="border: 1px solid #000; padding: 8px; text-align: center; width: 30px;">No</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center; width: 180px;">Business Process
                        Steps</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center; width: 100 px;">Tcode</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">Input Data Information</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center; width: 80px;">Job or Position
                        in SAP Role</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center; width: 150px;">Output/Expected
                        Results</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center; width: 90px;">Team Tester</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center; width: 60px;">OK/Error</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid #000; padding: 6px; text-align: center;">1.</td>
                    <td style="border: 1px solid #000; padding: 6px;">Create Internal Order : Master Data</td>
                    <td style="border: 1px solid #000; padding: 6px; text-align: center;">KO01</td>
                    <td style="border: 1px solid #000; padding: 6px;">Controlling Area = 1000<br>Order Type = C21A</td>
                    <td style="border: 1px solid #000; padding: 6px; text-align: center;">-</td>
                    <td style="border: 1px solid #000; padding: 6px;">Order
                        <span style="text-decoration: underline wavy red;">berhasil dicreate</span> (gambar 1)
                    </td>
                    <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                        <span style="text-decoration: underline wavy red;">Astrian</span> M.
                    </td>
                    <td style="border: 1px solid #000; padding: 6px; text-align: center;">OK</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 6px; text-align: center;">2.</td>
                    <td style="border: 1px solid #000; padding: 6px;">Change Original Budget</td>
                    <td style="border: 1px solid #000; padding: 6px; text-align: center;">KO22</td>
                    <td style="border: 1px solid #000; padding: 6px;">Order = 20000</td>
                    <td style="border: 1px solid #000; padding: 6px; text-align: center;">-</td>
                    <td style="border: 1px solid #000; padding: 6px;">Budget
                        <span style="text-decoration: underline wavy red;">berhasil diinput</span> (gambar 2)
                    </td>
                    <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                        <span style="text-decoration: underline wavy red;">Astrian</span> M.
                    </td>
                    <td style="border: 1px solid #000; padding: 6px; text-align: center;">OK</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 6px; text-align: center;">3.</td>
                    <td style="border: 1px solid #000; padding: 6px;">List : Budget/Actual/Commitments</td>
                    <td style="border: 1px solid #000; padding: 6px; text-align: center;">S_ALR_87013019</td>
                    <td style="border: 1px solid #000; padding: 6px;">Controlling Area = 1000<br>Or value = 20000</td>
                    <td style="border: 1px solid #000; padding: 6px; text-align: center;">-</td>
                    <td style="border: 1px solid #000; padding: 6px;">Report
                        <span style="text-decoration: underline wavy red;">berhasil didisplay</span> (gambar 3)
                    </td>
                    <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                        <span style="text-decoration: underline wavy red;">Astrian</span> M.
                    </td>
                    <td style="border: 1px solid #000; padding: 6px; text-align: center;">OK</td>
                </tr>
            </tbody>
        </table>

        <!-- Page Break -->
        <div style="page-break-before: always; padding-top:4em;"></div>

        <strong>Date :</strong> 05/11/2025

        <table width="85%" style="border-collapse: collapse; font-size:10pt; margin:15px auto; padding-top:2em;">

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
                    User
                </td>

                <td
                    style="border:1px solid #000; font-weight:bold; height:70px;
                   vertical-align: middle; padding-left:8px;">
                    Acknowledged By
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
                    Tested By
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
                    Approved By
                </td>

                <td
                    style="border:1px solid #000; height:70px;
                   vertical-align: middle; padding-left:8px;">
                    Daniel Kosasi
                </td>

                <td style="border:1px solid #000; height:70px;"></td>
            </tr>

        </table>

        <table
            style="width: 40%; border-collapse: collapse; margin-top: 20px; font-family: Arial, sans-serif; font-size: 10pt; margin-left: auto; padding-top:2em;">
            <tr>
                <td
                    style="border: 1px solid #000; background-color: #f2f2f2; width: 50%; padding: 8px; text-align: center;">
                    Transport Date:
                </td>
                <td style="border: 1px solid #000; padding: 8px; width: 50%;">
                </td>
            </tr>
        </table>

        <!-- Page Break -->
        <div style="page-break-before: always; padding-top:4em;"></div>
        <strong>Lampiran :</strong> <br>

        <div style="font-weight: bold; padding-top:1em; padding-bottom:1em;">Gambar 1</div>

        <div style="margin-top: 10px; text-align:center;">
            @if ($form->attachment_path)
                {{-- <img src="{{ public_path('storage/' . $form->attachment_path) }}"
                        style="max-width: 100%; border:1px solid #000;"> --}}
                <img src="{{ public_path('images/scm_logo-removebg-preview.png') }}" style="max-width: 100%;">
            @else
                <div style="border:1px solid #000; padding:10px;">Tidak ada lampiran</div>
                <img src="{{ public_path('images/scm_logo-removebg-preview.png') }}" style="max-width: 100%;">
            @endif
        </div>

        <div style="font-weight: bold; padding-top:1em; padding-bottom:1em;">Gambar 2</div>

        <div style="margin-top: 10px; text-align:center;">
            @if ($form->attachment_path)
                {{-- <img src="{{ public_path('storage/' . $form->attachment_path) }}"
                        style="max-width: 100%; border:1px solid #000;"> --}}
                <img src="{{ public_path('images/scm_logo-removebg-preview.png') }}" style="max-width: 100%;">
            @else
                <div style="border:1px solid #000; padding:10px;">Tidak ada lampiran</div>
                <img src="{{ public_path('images/scm_logo-removebg-preview.png') }}" style="max-width: 100%;">
            @endif
        </div>

        <div style="font-weight: bold; padding-top:1em; padding-bottom:1em;">Gambar 3</div>

        <div style="margin-top: 10px; text-align:center;">
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


    {{-- </div> --}}

    {{-- <div class="footer">
        <table class="footer-table">
            <tr>
                <td class="footer-right">
                    SAP Functional Test Script
                </td>
            </tr>
            <tr>
                <td class="footer-right page-number"></td>
            </tr>
        </table>
    </div> --}}

    <!-- ✅ PAGE NUMBER DOMPDF -->
    <script type="text/php">
    if (isset($pdf)) {

        $font = $fontMetrics->getFont("Helvetica", "normal");

        // BARIS ATAS
        $pdf->page_text(
            655,
            540,
            "SAP Functional Test Script",
            $font,
            10,
            array(0,0,0) // ⬅️ PENTING
        );

        // BARIS BAWAH
        $pdf->page_text(
            724,
            555,
            "Page {PAGE_NUM} of {PAGE_COUNT}",
            $font,
            10,
            array(0,0,0)
        );

    }
    </script>


</body>

</html>
