@extends('layouts.master')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Customers</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Customers</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        @include('layouts.alert')
        <section class="section">
            <div class="card">
                <div class="card-body p-2">
                    <ul class="nav nav-tabs align-items-end w-100" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url()->current() }}">
                                Customers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.create') }}">
                                Create
                            </a>
                        </li>
                    </ul>

                    <div class="d-flex justify-content-end m-4">
                        <button type="button" class="btn btn-outline-primary btn-sm" data-export-type-customers="xlsx">
                            <i
                                class="bi bi-file-earmark-excel-fill"></i> Export
                        </button>
                    </div>
                    <hr>

                    <div class="p-2 table-responsive">
                        <table class="table table-bordered data-table w-100">
                            <thead>
                            <tr class="table-primary text-center">
                                <th>Name</th>
                                <th>Unique ID</th>
                                <th>Designation</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('get_customers') }}",
                columns: [
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'unique_id',
                        name: 'unique_id'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        $(document).ready(function () {
            $('.btn[data-export-type-customers]').click(function () {
                let exportType = $(this).data('export-type-customers');

                $.ajax({
                    url: '{{ route('export_customers') }}',
                    type: 'GET',
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function (response) {
                        let blob = new Blob([response]);
                        let link = document.createElement('a');
                        let timestamp = new Date().toISOString().replace(/[-:.T]/g, "");

                        link.href = window.URL.createObjectURL(blob);
                        link.download = 'Customers_' + timestamp + '.xlsx';
                        link.style.display = 'none';
                        document.body.appendChild(link);

                        link.click();

                        document.body.removeChild(link);
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
