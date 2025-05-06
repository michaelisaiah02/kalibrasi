@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-md-between justify-content-center align-items-center mb-3">
            <div class="col-auto">
                <h3 class="mb-0">Master Lists Management</h3>
            </div>
            <div class="col-auto ms-md-auto my-2 my-md-0 d-flex align-items-center">
                <div id="loading-spinner" style="display: none;" class="text-center me-3">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <input type="search" class="form-control" placeholder="Search..." id="search-master-list"
                    autocomplete="off">
            </div>
        </div>

        <div class="table-responsive text-nowrap mb-3">
            <table class="table table-striped m-0" id="master-list-table">
                <thead class="table-primary">
                    <tr class="text-center">
                        <th>ID Num</th>
                        <th>SN Num</th>
                        <th>Capacity</th>
                        <th>Accuracy</th>
                        <th>Brand</th>
                        <th>Calibration Type</th>
                        <th>1st Used</th>
                        <th>Rank</th>
                        <th>Calibration Freq</th>
                        <th>Acc Criteria</th>
                        <th>PIC</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody id="master-list-table-body">
                    {{-- Data will generate by AJAX --}}
                </tbody>
            </table>
        </div>
        <div class="text-center row justify-content-between align-items-start">
            <div id="pagination-links" class="col-md col align-items-center"
                data-url="{{ route('admin.master-lists.search') }}">
                {{-- Generate by AJAX --}}
            </div>
            <div class="col-auto">
                <a href="{{ route('dashboard', ['key' => 'master-data']) }}" class="btn btn-primary">Close</a>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit MasterList -->
    <div class="modal fade" id="master-listModal" tabindex="-1" aria-labelledby="master-listModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content needs-validation" method="POST" id="master-listForm" novalidate>
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="master-listModalLabel">Add Master List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="master-list_id" id="master-list-id">
                    <div class="mb-3">
                        <label for="symbol" class="form-label">Symbol</label>
                        <input type="text" class="form-control" id="symbol" name="symbol" required>
                        <div class="invalid-feedback">Symbol is required.</div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="invalid-feedback">Name is required.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete MasterList -->
    <div class="modal fade" id="deleteMasterListModal" tabindex="-1" aria-labelledby="deleteMasterListModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="deleteMasterListForm" class="modal-content">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMasterListModalLabel">Delete MasterList</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the master-list named <strong id="deleteMasterListName"></strong>?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
    <x-toast />
@endsection

@section('scripts')
    <script type="module">
        function fetchMasterLists(keyword = '', page = 1) {
            $('#loading').show();
            $.ajax({
                url: `{{ route('admin.master-lists.search') }}`,
                type: 'GET',
                data: {
                    keyword: keyword,
                    page: page
                },
                success: function(response) {
                    $('#master-list-table-body').html(response.html);
                    $('#pagination-links').html(response.pagination);
                    $('html, body').animate({
                        scrollTop: $('#master-list-table').offset().top - 100
                    }, 300);
                    $('.pagination nav').addClass('w-100');
                },
                complete: function() {
                    $('#loading').hide();
                },
                error: function() {
                    alert('Gagal memuat data.');
                }
            });
        }

        $(document).ready(function() {
            // Delegasi tombol Edit
            $(document).on('click', '.btn-edit-master-list', function() {
                const id = $(this).data('id');
                $('#master-list-id').val(id);
                $('#id-num').val($(this).data('id-num'));
                $('#sn-num').val($(this).data('sn-num'));
                $('#capacity').val($(this).data('capacity'));
                $('#accuracy').val($(this).data('accuracy'));
                $('#brand').val($(this).data('brand'));
                $('#calibration-type').val($(this).data('calibration-type'));
                $('#first-used').val($(this).data('first-used'));
                $('#rank').val($(this).data('rank'));
                $('#calibration-freq').val($(this).data('calibration-freq'));
                $('#acceptance-criteria').val($(this).data('acceptance-criteria'));
                $('#pic').val($(this).data('pic'));
                $('#location').val($(this).data('location'));
                $('#master-listForm').attr('action',
                    `{{ url('admin/master-lists/update-master-list') }}/${id}`);
                new bootstrap.Modal(document.getElementById('master-listModal')).show();
            });

            // Delegasi tombol Delete
            $(document).on('click', '.btn-delete-master-list', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                $('#deleteMasterListForm').attr('action',
                    `{{ url('admin/master-lists/delete-master-list') }}/${id}`);
                $('#deleteMasterListName').text(name);
            });

            // Form Validation
            $('.needs-validation').on('submit', function(e) {
                if (!this.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                $(this).addClass('was-validated');
            });

            let debounceTimer;
            $('#search-master-list').on('keyup', function() {
                clearTimeout(debounceTimer);
                const keyword = $(this).val();
                debounceTimer = setTimeout(() => {
                    fetchMasterLists(keyword);
                }, 400);
            });

            // AJAX pagination
            $(document).on('click', '#pagination-links .pagination a', function(e) {
                e.preventDefault();
                const page = $(this).attr('href').split('page=')[1];
                const keyword = $('#search-master-list').val();
                fetchMasterLists(keyword, page);
            });

            // Initial fetch
            fetchMasterLists();
        });
    </script>
@endsection
