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
        @font-face {
            font-family: 'Free3of9';
            src: url('/fonts/Free3of9.woff') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

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

        .barcode {
            font-family: 'Free3of9', monospace;
            font-size: 24pt;
            margin: 0;
            padding: 0;
            line-height: 0.7;
            /* display: inline-block; */
            vertical-align: middle;
            text-align: center;
        }


        @media print {
            @page {
                size: 1cm 3.5cm;
                margin: 0;
            }

            .barcode {
                font-family: 'Free3of9', monospace;
                font-size: 24pt;
                margin: 0;
                padding: 0;
                line-height: 0.73;
                /* display: inline-block; */
                vertical-align: middle;
                text-align: center;
            }

            body {
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                transform: translateX(-30px) translateY(50px) rotate(90deg);
            }

            .print-wrapper {
                width: 100%;
                max-width: 3.5cm;
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
        <p class="barcode row justify-content-center">
            {{ '*' . $equipment->id_num . '*' }}
        </p>
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
