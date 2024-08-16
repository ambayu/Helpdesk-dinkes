@extends('layouts/layoutMaster')

@section('title', 'Penilaian - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.8/b-3.0.2/date-1.5.2/r-3.0.2/datatables.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>

    <script src="{{ asset('assets/js/app-penilaian.js') }}"></script>

@endsection

@section('content')
    <h4 class="py-3 mb-2">Kelola Permintaan Ubah Bidang</h4>
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
        oleh pemohon, tugas anda menyetujui apakah anda setuju untuk memindahkannya</p>


    <!-- Permission Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-permissions table">
                <thead class="table-light">
                    <tr>
                        <th width="1">No</th>
                        <th></th>
                        <th>Pemohon</th>
                        <th> Judul</th>
                        <th> Deskripsi</th>
                        <th> Rating</th>
                        <th> Status</th>
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
    <!-- /Modal -->
@endsection
