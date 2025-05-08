<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Label Kalibrasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        /* @page {
            size: 3.5cm 1cm;
            margin: 0;
        }

        body {
            width: 3.5cm;
            height: 1cm;
            font-family: Arial, Helvetica, sans-serif;
            border: 1px solid black;
            box-sizing: border-box;
            font-size: 5px;
        } */
    </style>
</head>

<body style="height: 1000px">
    <div class="container-fluid py-0 px-1">
        <div class="row justify-content-center">
            <table class="table table-sm table-bordered align-middle">
                <thead>
                    <tr>
                        <th scope="col" colspan="2" rowspan="3" class="text-center align-middle">
                            <div class="d-grid gap-1 h-100 fs-5 fw-medium">
                                <img src="{{ asset('image/logo-pt.png') }}" alt="Logo" width="30px"
                                    class="mx-auto">
                                PT.CAR
                            </div>
                        </th>
                        <th scope="col" colspan="4" rowspan="3" class="text-center align-middle fs-3">
                            VERIFIKASI HASIL KALIBRASI</th>
                        <th scope="col">NO.FORM</th>
                        <th scope="col">:</th>
                        <th scope="col">hdhd</th>
                    </tr>
                    <tr>
                        <th scope="col">TGL.FORM</th>
                        <th scope="col">:</th>
                        <th scope="col">{{ now()->format('d-m-Y') }}</th>
                    </tr>
                    <tr>
                        <th scope="col">Revisi</th>
                        <th scope="col">:</th>
                        <th scope="col">0</th>
                    </tr>
                    <tr>
                        <th scope="col" colspan="2">Equipment Name</th>
                        <th scope="col" colspan="4">{{ $repair->equipment->name }}</th>
                        <th scope="col">Merk</th>
                        <th scope="col">:</th>
                        <th scope="col">{{ $repair->brand }}</th>
                    </tr>
                    <tr>
                        <th scope="col" colspan="2">No. ID</th>
                        <th scope="col" colspan="4">{{ $repair->id_num }}</th>
                        <th scope="col">Cal Equipment</th>
                        <th scope="col">:</th>
                        <th scope="col">{{ $repair->results->last()->calibrator_equipment ?? 'N/A' }}</th>
                    </tr>
                    <tr>
                        <th scope="col" colspan="2">Calibration Date</th>
                        <th scope="col" colspan="4">{{ now()->format('d F Y') }}</th>
                        <th scope="col">Std Keberterimaan</th>
                        <th scope="col">:</th>
                        <th scope="col">{{ $repair->acceptance_criteria }}</th>
                    </tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" colspan="2">Standard Indication ({{ $repair->unit->symbol }})</th>
                        <th scope="col" colspan="2">Actual Indication ({{ $repair->unit->symbol }})</th>
                        <th scope="col">Correction ({{ $repair->unit->symbol }})</th>
                        <th scope="col" colspan="3">Judgment</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td colspan="2">{{ $repair->standard->param_01 }}</td>
                        <td colspan="2">{{ $repair->results->last()->param_01 }}</td>
                        <td>{{ $repair->results->last()->param_01 - $repair->standard->param_01 }}</td>
                        <td colspan="3" rowspan="10">{{ $repair->results->last()->judgement }}</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td colspan="2">{{ $repair->standard->param_02 }}</td>
                        <td colspan="2">{{ $repair->results->last()->param_02 }}</td>
                        <td>{{ $repair->results->last()->param_02 - $repair->standard->param_02 }}</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">{{ $repair->standard->param_03 }}</td>
                        <td colspan="2">{{ $repair->results->last()->param_03 }}</td>
                        <td>{{ $repair->results->last()->param_03 - $repair->standard->param_03 }}</td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td colspan="2">{{ $repair->standard->param_04 }}</td>
                        <td colspan="2">{{ $repair->results->last()->param_04 }}</td>
                        <td>{{ $repair->results->last()->param_04 - $repair->standard->param_04 }}</td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td colspan="2">{{ $repair->standard->param_05 }}</td>
                        <td colspan="2">{{ $repair->results->last()->param_05 }}</td>
                        <td>{{ $repair->results->last()->param_05 - $repair->standard->param_05 }}</td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td colspan="2">{{ $repair->standard->param_06 }}</td>
                        <td colspan="2">{{ $repair->results->last()->param_06 }}</td>
                        <td>{{ $repair->results->last()->param_06 - $repair->standard->param_06 }}</td>
                    </tr>
                    <tr>
                        <th scope="row">7</th>
                        <td colspan="2">{{ $repair->standard->param_07 }}</td>
                        <td colspan="2">{{ $repair->results->last()->param_07 }}</td>
                        <td>{{ $repair->results->last()->param_07 - $repair->standard->param_07 }}</td>
                    </tr>
                    <tr>
                        <th scope="row">8</th>
                        <td colspan="2">{{ $repair->standard->param_08 }}</td>
                        <td colspan="2">{{ $repair->results->last()->param_08 }}</td>
                        <td>{{ $repair->results->last()->param_08 - $repair->standard->param_08 }}</td>
                    </tr>
                    <tr>
                        <th scope="row">9</th>
                        <td colspan="2">{{ $repair->standard->param_09 }}</td>
                        <td colspan="2">{{ $repair->results->last()->param_09 }}</td>
                        <td>{{ $repair->results->last()->param_09 - $repair->standard->param_09 }}</td>
                    </tr>
                    <tr>
                        <th scope="row">10</th>
                        <td colspan="2">{{ $repair->standard->param_10 }}</td>
                        <td colspan="2">{{ $repair->results->last()->param_10 }}</td>
                        <td>{{ $repair->results->last()->param_10 - $repair->standard->param_10 }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row justify-content-end">
            <div class="col-4">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">Disetujui</th>
                            <th scope="col">Diperiksa</th>
                            <th scope="col">Dibuat</th>
                        </tr>
                        <tr>
                            <th scope="col" style="height: 50px">&nbsp;</th>
                            <th scope="col" style="height: 50px">&nbsp;</th>
                            <th scope="col" style="height: 50px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Feisal</td>
                            <td>Dwitta</td>
                            <td>Oki</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        // window.onload = function() {
        //     window.print();
        //     setTimeout(() => {
        //         window.location.href = "{{ route('dashboard', ['key' => 'menu-input']) }}";
        //     }, 1000); // Delay biar gak ke-redirect sebelum sempat print
        // }
    </script>
</body>

</html>
