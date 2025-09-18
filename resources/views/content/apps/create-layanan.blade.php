@extends('layouts/layoutMaster')

@section('title', 'Permission - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-invoice.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-invoice-add.js') }}"></script>
    <script src="{{ asset('assets/js/forms-tagify.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Toggle input tambahan sesuai tipe
            $(document).on('change', '.input-type', function() {
                let wrapper = $(this).closest('.col-md-5');

                wrapper.find('.choice-options').hide();
                wrapper.find('.kelompok-options').hide();

                if ($(this).val() == '3') { // Pilihan
                    wrapper.find('.choice-options').show();
                }
                if ($(this).val() == '5') { // Kelompok
                    wrapper.find('.kelompok-options').show();
                }
            });

            // Repeater untuk opsi Pilihan
            $('.choice-options').repeater({
                initEmpty: true,
                defaultValues: {
                    'nama_pilihan': ''
                },
                show: function() {
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            // Repeater untuk Field Kelompok
            $('.kelompok-options').repeater({
                initEmpty: true,
                defaultValues: {
                    'field_label': '',
                    'field_type': 'text'
                },
                show: function() {
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
        });
    </script>
@endsection

@section('content')
    <h4 class="py-3 mb-2">Tambah Layanan </h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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

    <p class="mb-4">Tambahkan layanan yang ingin ditambahkan serta inputan yang diisi</p>

    <div class="row invoice-add">
        <div class="col-lg-12">
            <div class="card invoice-preview-card">
                <div class="card-body">
                    <form class="source-item pt-1" action="{{ route('create-layanan.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="nama_layanan" name="nama_layanan" class="form-control"
                                    placeholder="Layanan Aplikasi">
                                <label for="nama_layanan" class="@error('nama_layanan') is-invalid @enderror">Nama
                                    Layanan</label>
                                @error('nama_layanan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <h4 class="mt-4">Tambahkan Input Yang diinginkan</h4>

                        <div data-repeater-list="inputan">
                            <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item>
                                <div class="d-flex border rounded position-relative pe-0">
                                    <div class="row w-100 p-3">
                                        <div class="col-md-7 col-12 mb-md-0 mb-2 mt-1 ">
                                            <h6 class="mb-2 repeater-title fw-medium">Nama Inputan</h6>
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" name="name_label" class="form-control"
                                                    placeholder="contoh: Nama Lengkap">
                                                <label>Nama Inputan</label>
                                            </div>
                                        </div>

                                        <div class="col-md-5 col-12 mb-md-0 mb-3 ">
                                            <h6 class="mb-2 repeater-title fw-medium">Input Type</h6>

                                            <div class="form-check form-check-inline">
                                                <input name="input_type" class="form-check-input input-type" type="radio"
                                                    value="1">
                                                <label class="form-check-label">Text</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="input_type" class="form-check-input input-type" type="radio"
                                                    value="2">
                                                <label class="form-check-label">Textarea</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="input_type" class="form-check-input input-type" type="radio"
                                                    value="3">
                                                <label class="form-check-label">Pilihan</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="input_type" class="form-check-input input-type" type="radio"
                                                    value="4">
                                                <label class="form-check-label">File</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="input_type" class="form-check-input input-type" type="radio"
                                                    value="5">
                                                <label class="form-check-label">Kelompok</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="input_type" class="form-check-input input-type" type="radio"
                                                    value="6">
                                                <label class="form-check-label">Tanggal</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="input_type" class="form-check-input input-type" type="radio"
                                                    value="7">
                                                <label class="form-check-label">Tanggal Maju</label>
                                            </div>

                                            <!-- Pilihan -->
                                            <div class="choice-options mt-3" style="display:none;">
                                                <h6>Tambahkan Pilihan</h6>
                                                <div data-repeater-list="pilihan">
                                                    <div data-repeater-item class="d-flex mb-2">
                                                        <input type="text" name="nama_pilihan" class="form-control me-2"
                                                            placeholder="Isi pilihan" />
                                                        <button type="button" data-repeater-delete
                                                            class="btn btn-sm btn-danger">X</button>
                                                    </div>
                                                </div>
                                                <button type="button" data-repeater-create
                                                    class="btn btn-sm btn-success mt-2">+ Tambah Pilihan</button>
                                            </div>

                                            <!-- Kelompok -->
                                            <div class="kelompok-options mt-3" style="display:none;">
                                                <h6>Field dalam Kelompok</h6>
                                                <div data-repeater-list="fields">
                                                    <div data-repeater-item class="row mb-2">
                                                        <div class="col-md-6">
                                                            <input type="text" name="field_label" class="form-control"
                                                                placeholder="Nama kolom (contoh: NIP)">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select name="field_type" class="form-select">
                                                                <option value="text">Text</option>
                                                                <option value="textarea">Textarea</option>
                                                                <option value="file">File</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" data-repeater-delete
                                                                class="btn btn-sm btn-danger">X</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" data-repeater-create
                                                    class="btn btn-sm btn-success mt-2">+ Tambah Field</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                                        <i class="mdi mdi-close cursor-pointer" data-repeater-delete></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="button" class="btn btn-sm btn-primary" data-repeater-create>
                                    <i class="mdi mdi-plus me-1"></i> Add Inputan
                                </button>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('_partials/_offcanvas/offcanvas-send-invoice')
@endsection
