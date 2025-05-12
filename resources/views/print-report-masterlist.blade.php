<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Print Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js']) --}}
    <style>
        /* Pastikan hanya style yang perlu dipakai di print */
        @page {
            size: A4;
            orientation: landscape !important;
            margin: 10mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            margin: 0;
            padding: 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 4px;
            text-align: center;
        }

        thead th {
            background: #eee;
        }

        .no-break {
            page-break-inside: avoid;
        }

        /* Hide print button during printing */
        @media print {
            button.print-button {
                display: none;
            }

            @page {
                size: A4 landscape;
                /* atau bisa pakai: size: landscape; */
                margin: 1cm;
            }

            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid py-0 px-1">
        <div class="row justify-content-center" style="margin-bottom: 3px;">
            <table class="table table-sm table-bordered align-middle">
                <thead>
                    <tr>
                        <th scope="col" colspan="1" rowspan="3" class="text-center align-middle"
                            style="width: 50px;">
                            <div class="d-grid gap-1 h-100 fs-5 fw-medium"
                                style="display: grid; justify-content: center; font-size: 10px; font-weight: 500; gap: 5px;">
                                <img src="{{ asset('image/logo-pt.png') }}" alt="Logo" width="30px"
                                    class="mx-auto" style="margin-left: auto; margin-right: auto;">
                                PT.CAR
                            </div>
                        </th>
                        <th scope="col" colspan="5" rowspan="3" class="text-center align-middle fs-4"
                            style="font-size: 20pt;">
                            VERIFIKASI HASIL KALIBRASI</th>
                        <th scope="col">NO.FORM</th>
                        <th scope="col">:</th>
                        <th scope="col">FR-QAC-098</th>
                    </tr>
                    <tr>
                        <th scope="col">TGL.FORM</th>
                        <th scope="col">:</th>
                        <th scope="col">11/01/2023</th>
                    </tr>
                    <tr>
                        <th scope="col">Revisi</th>
                        <th scope="col">:</th>
                        <th scope="col">0</th>
                    </tr>
                    <tr>
                        <th scope="col" colspan="2">Equipment Name</th>
                        <th scope="col" colspan="4">{{ $result->masterList->equipment->name }}</th>
                        <th scope="col">Merk</th>
                        <th scope="col">:</th>
                        <th scope="col">{{ $result->masterList->brand }}</th>
                    </tr>
                    <tr>
                        <th scope="col" colspan="2">No. ID</th>
                        <th scope="col" colspan="4">{{ $result->id_num }}</th>
                        <th scope="col">Cal Equipment</th>
                        <th scope="col">:</th>
                        <th scope="col">{{ $result->calibrator_equipment ?? 'N/A' }}</th>
                    </tr>
                    <tr>
                        <th scope="col" colspan="2">Calibration Date</th>
                        <th scope="col" colspan="4">
                            {{ $result->calibration_date->locale('id')->translatedFormat('d F Y') }}</th>
                        <th scope="col">Std Keberterimaan</th>
                        <th scope="col">:</th>
                        <th scope="col">{{ $result->masterList->acceptance_criteria }}</th>
                    </tr>
                    <tr>
                        <th scope="col" style="width: 15px;">No</th>
                        <th scope="col" colspan="2">Standard Indication ({{ $result->masterList->unit->symbol }})
                        </th>
                        <th scope="col" colspan="2">Actual Indication ({{ $result->masterList->unit->symbol }})
                        </th>
                        <th scope="col">Correction ({{ $result->masterList->unit->symbol }})</th>
                        <th scope="col" colspan="3">Judgment</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td colspan="2">{{ $result->masterList->standard->param_01 }}</td>
                        <td colspan="2">{{ $result->param_01 }}</td>
                        <td>{{ $result->param_01 - $result->masterList->standard->param_01 }}</td>
                        <td colspan="3" rowspan="10">{{ $result->judgement }}</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td colspan="2">{{ $result->masterList->standard->param_02 }}</td>
                        <td colspan="2">{{ $result->param_02 }}</td>
                        <td>{{ $result->param_02 - $result->masterList->standard->param_02 }}</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">{{ $result->masterList->standard->param_03 }}</td>
                        <td colspan="2">{{ $result->param_03 }}</td>
                        <td>{{ $result->param_03 - $result->masterList->standard->param_03 }}</td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td colspan="2">{{ $result->masterList->standard->param_04 }}</td>
                        <td colspan="2">{{ $result->param_04 }}</td>
                        <td>{{ $result->param_04 - $result->masterList->standard->param_04 }}</td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td colspan="2">{{ $result->masterList->standard->param_05 }}</td>
                        <td colspan="2">{{ $result->param_05 }}</td>
                        <td>{{ $result->param_05 - $result->masterList->standard->param_05 }}</td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td colspan="2">{{ $result->masterList->standard->param_06 }}</td>
                        <td colspan="2">{{ $result->param_06 }}</td>
                        <td>{{ $result->param_06 - $result->masterList->standard->param_06 }}</td>
                    </tr>
                    <tr>
                        <th scope="row">7</th>
                        <td colspan="2">{{ $result->masterList->standard->param_07 }}</td>
                        <td colspan="2">{{ $result->param_07 }}</td>
                        <td>{{ $result->param_07 - $result->masterList->standard->param_07 }}</td>
                    </tr>
                    <tr>
                        <th scope="row">8</th>
                        <td colspan="2">{{ $result->masterList->standard->param_08 }}</td>
                        <td colspan="2">{{ $result->param_08 }}</td>
                        <td>{{ $result->param_08 - $result->masterList->standard->param_08 }}</td>
                    </tr>
                    <tr>
                        <th scope="row">9</th>
                        <td colspan="2">{{ $result->masterList->standard->param_09 }}</td>
                        <td colspan="2">{{ $result->param_09 }}</td>
                        <td>{{ $result->param_09 - $result->masterList->standard->param_09 }}</td>
                    </tr>
                    <tr>
                        <th scope="row">10</th>
                        <td colspan="2">{{ $result->masterList->standard->param_10 }}</td>
                        <td colspan="2">{{ $result->param_10 }}</td>
                        <td>{{ $result->param_10 - $result->masterList->standard->param_10 }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row justify-content-end" style="display: flex; justify-content: end;">
            <div class="col-4" style="width: 40%;">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 33%;">Disetujui</th>
                            <th scope="col" style="width: 33%;">Diperiksa</th>
                            <th scope="col" style="width: 33%;">Dibuat</th>
                        </tr>
                        <tr>
                            <th scope="col" style="height: 50px">&nbsp;</th>
                            <th scope="col" style="height: 50px">&nbsp;</th>
                            <th scope="col" style="height: 50px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $approved->name }}</td>
                            <td>{{ $checked->name }}</td>
                            <td>{{ $result->creator->name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const printButton = document.createElement('button');
            printButton.textContent = 'Print';
            printButton.style.position = 'fixed';
            printButton.style.bottom = '20px';
            printButton.style.left = '50%';
            printButton.style.transform = 'translateX(-50%)';
            printButton.style.cursor = 'pointer';
            printButton.classList.add('print-button');
            printButton.style.padding = '10px 20px';
            printButton.style.backgroundColor = '#181d3d';
            printButton.style.color = '#fff';
            printButton.style.border = 'none';
            printButton.style.borderRadius = '5px';

            printButton.addEventListener('click', function() {
                window.print();
                setTimeout(() => {
                    window.location.href = "{{ route('report.menu') }}";
                }, 1000);
            });

            document.body.appendChild(printButton);
        });
    </script>
</body>

</html>
