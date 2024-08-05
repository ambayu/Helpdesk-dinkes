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
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-invoice-add.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-2">Tambah Layanan </h4>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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
    <p class="mb-4">Tambahkan layanan yang ingin ditambahkan serta inputan yang diisi</p>

    <div class="row invoice-add">
        <!-- Invoice Add-->
        <div class="col-lg-12 col-12 mb-lg-0 mb-4">
            <div class="card invoice-preview-card">
                <div class="card-body">
                    <div class="row mx-0">
                        <div class="col-md-7 mb-md-0 mb-4 ps-0">
                            <div class="d-flex svg-illustration align-items-center gap-2 mb-4">

                                <span class="h4 mb-0 app-brand-text fw-bold"> Layanan</span>
                            </div>
                            {{-- <p class="mb-1">Office 149, 450 South Brand Brooklyn</p>
                            <p class="mb-1">San Diego County, CA 91905, USA</p>
                            <p class="mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p> --}}
                        </div>

                    </div>
                </div>


                <hr class="my-0" />

                <div class="card-body">
                    <form class="source-item pt-1" action="{{ route('create-layanan.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3" data-repeater-list="inputan">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="name_layanan" name="nama_layanan" class="form-control"
                                    placeholder="Layanan Aplikasi">
                                <label for="name_layanan" class="@error('name_layanan') is-invalid @enderror">Nama
                                    Layanan</label>
                                @error('name_label')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <h4 class="mt-4">
                                Tambahkan Input Yang diinginkan
                            </h4>
                            <div class="repeater-wrapper pt-0 pt-md-1" data-repeater-item>
                                <hr class="my-0 mt-2 mb-2 ">

                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="collapsible-label_name" name="name_label" class="form-control"
                                        placeholder="Deskripsi">
                                    <label for="collapsible-label_name">Nama Inputan</label>
                                </div>




                                <div class="col mt-4">
                                    <div>
                                        <label class="form-check-label m-2">Input Type</label>

                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input name="input_type" class="form-check-input" type="radio" value="1"
                                            id="textarea" checked="">
                                        <label class="form-check-label" for="textarea">Text</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="input_type" class="form-check-input" type="radio" value="2"
                                            id="textarea">
                                        <label class="form-check-label" for="textarea">Textarea</label>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" class="btn btn-sm btn-primary" data-repeater-create><i
                                        class="mdi mdi-plus me-1"></i> Add Item</button>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="switch">
                                <input type="checkbox" name="file" class="switch-input">
                                <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                </span>
                                <span class="switch-label">Izinkan kirim file</span>
                            </label>

                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">SIMPAN</button>

                        </div>
                    </form>
                </div>


            </div>
        </div>
        <!-- /Invoice Add-->

        <!-- Invoice Actions -->

        <!-- /Invoice Actions -->
    </div>

    @include('_partials/_offcanvas/offcanvas-send-invoice')
@endsection
