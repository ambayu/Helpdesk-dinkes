@extends('layouts/layoutMaster')

@section('title', 'Kelola Layanan - Apps')




@section('vendor-style')

    <style>
        div.dt-container div.dt-length select {
            width: auto;
            display: inline-block;
            margin: 10px;
        }

        div.dt-container div.dt-search input {
            margin-left: .5em;
            display: inline-block;
            margin: 10px;
            width: auto;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-invoice-add.js') }}"></script>

    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>

    <script src="{{ asset('assets/js/app-manage-layanan.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-2">Kelola Layanan</h4>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <p class="mb-4">Atur layanan sesuai dengan ketetapan di prusahaan anda</p>


    <!-- Permission Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-permissions table">
                <thead class="table-light">
                    <tr>

                        <th></th>
                        <th width="10">No</th>

                        <th>Nama Layanan</th>
                        <th>Inputan </th>
                        <th>File </th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Permission Table -->

    <!-- Modal -->

    @include('_partials/_modals/modal-edit-layanan')

    <!-- /Modal -->
@endsection
