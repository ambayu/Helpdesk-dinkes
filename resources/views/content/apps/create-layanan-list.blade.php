@extends('layouts/layoutMaster')

@section('title', 'Permission - Apps')

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


    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>

    <script src="{{ asset('assets/js/app-access-permission.js') }}"></script>
    <script src="{{ asset('assets/js/modal-add-permission.js') }}"></script>
    <script src="{{ asset('assets/js/modal-edit-permission.js') }}"></script>

@endsection

@section('content')
    <h4 class="py-3 mb-2">Isi Data Layanan {{ $inputs->nama_layanan }}</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <p class="mb-4">Silahkan Isi Data dibawah ini sesuai yang anda butuhkan</p>

    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Isi Data</h5> <small class="text-body float-end"></small>

            </div>
            @if (session('success'))
                <div class="alert alert-success m-2" role="alert">
                    <h4 class="alert-heading text-dark">Selamat!</h4>
                    <p class="text-dark">{{ session('success') }}, silahkan catat nomor tiket anda, nomor tiket dapat
                        dilihat dimenu
                        cek permintaan</p>
                    <hr>
                    <p class="mb-0 text-dark">Nomor Tiket anda adalah: {{ session('tiket') }}</p>
                </div>
            @endif
            <div class="card-body">
                <form id="form-layanan" class="mb-3" action="{{ route('create-layanan.list-store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Judul permintaan -->
                    <div class="form-floating form-floating-outline mb-3">
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                            name="judul" placeholder="Masukkan Judul" autofocus value="{{ old('judul') }}">
                        <label for="judul">Judul permintaan</label>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Loop untuk input formulir -->
                    @foreach ($inputs->formulir as $formulir)
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="hidden" name="type[{{ $loop->index }}][id_formulir]"
                                value="{{ $formulir->id }}">
                            <input type="{{ $formulir->inputan->nama_type }}"
                                class="form-control @error('type.' . $loop->index . '.respon') is-invalid @enderror"
                                id="{{ $formulir->formulir }}" name="type[{{ $loop->index }}][respon]"
                                placeholder="Masukkan {{ $formulir->formulir }}" autofocus
                                value="{{ old('type.' . $loop->index . '.respon') }}">
                            <label for="{{ $formulir->formulir }}">{{ $formulir->formulir }}</label>
                            @error('type.' . $loop->index . '.respon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach

                    <!-- Deskripsi -->
                    <div class="form-floating form-floating-outline mb-3">
                        <div class="input-group input-group-merge mb-4">
                            <span id="basic-icon-default-message2" class="input-group-text"><i
                                    class="mdi mdi-message-outline"></i></span>
                            <div class="form-floating form-floating-outline">
                                <textarea id="basic-icon-default-message" class="form-control @error('deskripsi') is-invalid @enderror"
                                    placeholder="Hi, Silahkan masukkan deskripsi permintaan anda" aria-label="Deskripsi"
                                    aria-describedby="basic-icon-default-message2" style="height: 160px;" name="deskripsi"
                                    value="{{ old('deskripsi') }}"></textarea>
                                <label for="basic-icon-default-message">Deskripsi</label>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- File (jika ada) -->
                    @if ($inputs->file == '1')
                        <div class="form-floating form-floating-outline mb-3">
                            <p><small class="text-center text-danger">Jika file lebih besar dari 2mb silahkan simpan
                                    di google drive dan linknya disematkan di dalam deskripsi</small></p>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file"
                                name="file">
                            <label for="file">Masukkan file</label>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <!-- Tombol Submit -->
                    <div class="mb-3">
                        <button class="btn btn-primary d-grid w-100" type="submit">Kirim / Masuk SSO</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
