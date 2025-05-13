@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        @if ($results->isEmpty())
            <div class="alert alert-info">No Masterlist data available.</div>
        @else
            <div class="table-responsive mb-3">
                <table class="table table-striped table-bordered align-middle text-nowrap">
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
                            <th>1<sup>st</sup> Used</th>
                            <th>Rank</th>
                            <th>Freq (bln)</th>
                            <th>Acceptance Criteria</th>
                            <th>PIC</th>
                            <th>Location</th>
                            <th>Last Certificate</th>
                            <th>Last Result</th>
                        </tr>
                    </thead>
                    {{-- @dd($results) --}}
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
                                <td>
                                    @if ($item->results->last()->certificate)
                                        <button type="button" class="btn btn-sm btn-primary btn-view-certificate"
                                            data-bs-toggle="modal" data-bs-target="#certificateModal"
                                            data-path="{{ asset('storage/' . $item->results->last()->certificate) }}"
                                            data-ext="{{ pathinfo($item->results->last()->certificate, PATHINFO_EXTENSION) }}">
                                            Show
                                        </button>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('print.report.masterlist', $item->id_num) }}">
                                        {{ $item->results->first()->judgement }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="modal fade" id="certificateModal" tabindex="-1" aria-labelledby="certificateModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Calibration Certificate</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body text-center vh-100" id="certificateContent">
                        <div class="text-muted">Loading...</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="pagination">
                {{ $results->links() }}
            </div>
            <a href="{{ route('report.menu') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="module">
        $(document).ready(function() {
            $('.pagination nav').addClass('w-100');
            $('.pagination nav ul').addClass('my-0 me-3');
        })
        $(document).on('click', '.btn-view-certificate', function() {
            const path = $(this).data('path');
            const ext = $(this).data('ext').toLowerCase();
            const container = $('#certificateContent');

            container.html('<div class="text-muted">Loading...</div>'); // reset dulu

            if (['jpg', 'jpeg', 'png'].includes(ext)) {
                container.html(`<img src="${path}" class="img-fluid" alt="Certificate">`);
            } else if (ext === 'pdf') {
                container.html(`<iframe src="${path}" style="border: none;"></iframe>`);
            } else {
                container.html(`<div class="text-danger">Format file tidak dikenali: .${ext}</div>`);
            }
        });
    </script>
@endsection
