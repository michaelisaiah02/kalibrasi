@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">Report: Repair History</h3>

        @if ($results->isEmpty())
            <div class="alert alert-info">Tidak ada data Repair.</div>
        @else
            <div class="table-responsive mb-3">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Repair Date</th>
                            <th>ID Num / SN</th>
                            <th>Equipment Name</th>
                            <th>Problem</th>
                            <th>Countermeasure</th>
                            <th>Judgement</th>
                            <th>PIC</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $i => $rep)
                            <tr class="text-center">
                                <td>{{ $i + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($rep->repair_date)->format('d-m-Y') }}</td>
                                <td>{{ $rep->id_num }} / {{ optional($rep->masterList)->sn_num ?? '-' }}</td>
                                <td>{{ optional($rep->masterList->equipment)->name ?? '-' }}</td>
                                <td>{{ $rep->problem }}</td>
                                <td>{{ $rep->countermeasure }}</td>
                                <td>{{ $rep->judgement }}</td>
                                <td>{{ $rep->pic }}</td>
                                <td>{{ $rep->created_at->format('d-m-Y H:i') }}</td>
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
