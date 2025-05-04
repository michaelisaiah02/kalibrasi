<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Label Kalibrasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        @page {
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
        }
    </style>
</head>
{{-- @dd($equipment) --}}

<body>
    <div class="container-fluid py-0 px-1">
        <div class="row justify-content-center">
            <div class="col-auto">
                <strong>Valid : {{ $equipment->first_used->format('d-m-Y') }}</strong>
            </div>
            <div class="col-auto">
                <strong>Until :
                    {{ $equipment->first_used->addMonth($equipment->calibration_freq)->format('d-m-Y') }}</strong>
            </div>
        </div>
        <div class="barcode row justify-content-center">
            {!! DNS1D::getBarcodeHTML($equipment->id_num, 'C128', 1.1, 20) !!}
        </div>
        <p class="text-center">{{ $equipment->id_num }}</p>
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
