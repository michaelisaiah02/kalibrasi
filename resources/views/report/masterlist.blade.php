@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">Report: Masterlist</h3>
        {{-- @dd($results) --}}
        @if ($results->isEmpty())
            <div class="alert alert-info">Tidak ada data Masterlist.</div>
        @else
            <div class="table-responsive mb-3">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>ID Num / SN</th>
                            <th>Equipment Name</th>
                            <th>Capacity</th>
                            <th>Accuracy</th>
                            <th>Unit</th>
                            <th>Brand</th>
                            <th>Calib. Type</th>
                            <th>First Used</th>
                            <th>Rank</th>
                            <th>Freq (bln)</th>
                            <th>Acceptance Criteria</th>
                            <th>PIC</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $i => $item)
                            <tr class="text-center">
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $item->id_num }} / {{ $item->sn_num }}</td>
                                <td>{{ optional($item->equipment)->name ?? '-' }}</td>
                                <td>{{ $item->capacity }}</td>
                                <td>± {{ $item->accuracy }}</td>
                                <td>{{ optional($item->unit)->symbol ?? '-' }}</td>
                                <td>{{ $item->brand }}</td>
                                <td>{{ $item->calibration_type }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->first_used)->format('d-m-Y') }}</td>
                                <td>{{ $item->rank }}</td>
                                <td>{{ $item->calibration_freq }}</td>
                                <td>{{ $item->acceptance_criteria }}</td>
                                <td>{{ $item->pic }}</td>
                                <td>{{ $item->location }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Back</a>
            {{-- Jika mau pagination --}}
            {{-- {{ $results->links() }} --}}
        </div>
    </div>
@endsection
