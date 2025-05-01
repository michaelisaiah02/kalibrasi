<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Stiker Kalibrasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        @page {
            size: 5cm 2cm;
            margin: 0;
        }

        body {
            width: 5cm;
            height: 2cm;
            font-family: Arial, Helvetica, sans-serif;
            border: 1px solid black;
            box-sizing: border-box;
            font-size: 8px;
        }

        .note {
            font-size: 6px;
        }
    </style>
</head>

<body>
    <div class="container-fluid py-0 px-1">
        <div class="row">
            <div class="col">
                <strong>Nomor ID</strong>
            </div>
            <div class="col-auto ms-auto p-0">
                <span>:</span>
            </div>
            <div class="col-4">
                <span>{{ $equipment->id_num }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <strong>Dikalibrasi Tanggal</strong>
            </div>
            <div class="col-auto ms-auto p-0">
                <span>:</span>
            </div>
            <div class="col-4">
                <span>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</span>
            </div>
        </div>
        <div class="note">
            Catatan: Mohon untuk segera menyerahkan alat ukur ini ke Dept kalibrasi, sesuai tanggal kalibrasi.
        </div>
        <div class="barcode row justify-content-center">
            {!! DNS1D::getBarcodeHTML($equipment->id_num, 'C128', 1.5, 30) !!}
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
            setTimeout(() => {
                window.location.href = "{{ route('dashboard', ['key' => 'menu-input']) }}";
            }, 1000); // Delay biar gak ke-redirect sebelum sempat print
        }
    </script>
</body>

</html>
