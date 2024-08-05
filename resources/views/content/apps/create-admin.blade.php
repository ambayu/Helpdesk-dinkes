@extends('layouts/layoutMaster')

@section('title', 'Permission - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />

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

    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/js/app-create-admin.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-2">Tambah Akun Admin</h4>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <p class="mb-4">Silahkan isi data dibawah ini untuk menambah admin</p>

    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Akun</h5> <small class="text-body float-end"></small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('create-admin.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="basic-default-fullname" name="name" placeholder="John Doe" required />
                        <label for="basic-default-fullname">Full Name</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="basic-default-email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="admin@gmail.com"
                                    aria-label="admin@gmail.com" aria-describedby="basic-default-email2" required />
                                <label for="basic-default-email">Email</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <span class="input-group-text" id="basic-default-email2">@example.com</span>
                        </div>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" id="basic-default-phone" name="no_hp"
                            class="form-control phone-mask @error('no_hp') is-invalid @enderror" placeholder="081337034650"
                            required />
                        <label for="basic-default-phone">Nomor Hp</label>
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <select id="modalAddressCountry" name="role"
                            class="select2 form-select @error('role') is-invalid @enderror" data-allow-clear="true"
                            required>
                            <option value="" selected>Pilih Peran</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <label for="modalAddressCountry">Pilih Peran</label>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="bidangSelectContainer" style="display: none;" class="form-floating form-floating-outline mb-4">
                        <select id="bidangSelect" name="bidang"
                            class="select2 form-select @error('bidang') is-invalid @enderror" data-allow-clear="true">
                            <option value="" selected>Pilih Bidang</option>
                            <!-- Tambahkan opsi bidang di sini -->
                            @foreach ($bidangs as $bidang)
                                <option value="{{ $bidang->id }}">{{ $bidang->nama_bidang }}</option>
                            @endforeach
                        </select>
                        <label for="bidangSelect">Pilih Bidang</label>
                        @error('bidang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                            id="basic-default-username" name="username" placeholder="admin1" required />
                        <label for="basic-default-username">Username </label>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="password" id="basic-default-phone" name="password"
                            class="form-control phone-mask @error('password') is-invalid @enderror" placeholder="a@#sdf23"
                            required />
                        <label for="basic-default-phone">Password</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="file" id="basic-default-photo" name="photo"
                            class="form-control @error('photo') is-invalid @enderror" accept="image/*" />
                        <label for="basic-default-photo">Photo</label>
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Send</button>
                </form>

            </div>
        </div>
    </div>


@endsection
