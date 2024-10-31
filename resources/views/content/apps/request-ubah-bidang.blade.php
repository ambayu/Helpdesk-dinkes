@extends('layouts/layoutMaster')

@section('title', 'Permintaan Ubah Bidang - Apps')

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
    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>

    <script src="{{ asset('assets/js/app-permintaan-ubah-bidang.js') }}"></script>

@endsection

@section('content')
    <h4 class="py-3 mb-2">Kelola Permintaan Ubah Layanan</h4>
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
    <p class="mb-4">Admin layanan melakukan permintaan untuk mengganti bidang yang tidak sesuai dengan bidang yang dipilih
        oleh user, tugas anda menyetujui apakah anda setuju untuk memindahkannya</p>


    <!-- Permission Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-permissions table">
                <thead class="table-light">
                    <tr>
                        <th width="5">No</th>

                        <th></th>
                        <th>Nama Admin Pemohon</th>
                        <th>Usulan Layanan</th>
                        <th> Alasan</th>
                        <th> Layanan Lama</th>
                        <th> Layanan Baru</th>
                        <th> Tanggal</th>
                        <th> Divalidasi</th>

                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Permission Table -->




    <!-- Modal -->
    @include('_partials/_modals/modal-ubah-pemindahan-bidang')
    @include('_partials/_modals/modal-lihat-answer')
    <!-- /Modal -->
@endsection
