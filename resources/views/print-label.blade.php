<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Label Kalibrasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
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

        @media print {
            @page {
                size: 3.5cm 1cm;
                margin: 0;
            }

            body {
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
            }

            .print-wrapper {
                width: 100%;
                max-width: 3.5cm;
                /* Lebar A4 */
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid py-0 px-1 print-wrapper">
        <div class="row justify-content-center">
            <div class="col-auto">
                <strong>Valid :
                    @if ($equipment->results->count() > 0)
                        {{ $equipment->results->last()->calibration_date->format('d-m-Y') }}
                    @else
                        {{ $equipment->first_used->format('d-m-Y') }}
                    @endif
                </strong>
            </div>
            <div class="col-auto">
                <strong>Until :
                    @if ($equipment->results->count() > 0)
                        {{ $equipment->results->last()->calibration_date->addMonth($equipment->calibration_freq)->format('d-m-Y') }}
                    @else
                        {{ $equipment->first_used->addMonth($equipment->calibration_freq)->format('d-m-Y') }}
                    @endif
                </strong>
            </div>
        </div>
        <div class="barcode row justify-content-center">
            {!! DNS1D::getBarcodeHTML($equipment->id_num, 'C128', 1.1, 20) !!}
        </div>
        <p class="text-center">{{ $equipment->id_num }}</p>
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
