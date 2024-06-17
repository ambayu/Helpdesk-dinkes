@php
    $configData = Helper::appClasses();
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Login Basic - Pages')

@section('vendor-style')
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/pages-auth.js') }}"></script>
@endsection

@section('content')
    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                <!-- Login -->
                <div class="card p-2">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <a href="{{ url('/') }}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">@include('_partials.macros', ['width' => 25, 'withbg' => 'var(--bs-primary)'])</span>
                            <span
                                class="app-brand-text demo text-heading fw-bold">{{ config('variables.templateName') }}</span>
                        </a>
                    </div>
                    <!-- /Logo -->

                    <div class="card-body mt-2">
                        <h4 class="mb-2">Welcome to {{ config('variables.templateName') }}! 👋</h4>
                        <p class="mb-4">Silahkan isi persyaratan berikut</p>

                        <form id="formAuthentication" class="mb-3" action="{{ url('/') }}" method="GET">
                            <div class="form-floating form-floating-outline mb-3">
                                <input type="text" class="form-control" id="judul" name="email-username"
                                    placeholder="Masukkan Judul" autofocus>
                                <label for="judul">Judul permintaan</label>
                            </div>

                            <div class="form-floating form-floating-outline mb-3">

                                <div class="input-group input-group-merge mb-4">
                                    <span id="basic-icon-default-message2" class="input-group-text"><i
                                            class="mdi mdi-message-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <textarea id="basic-icon-default-message" class="form-control"
                                            placeholder="Hi,Silahkan masukkan deskripsi permintaan anda"
                                            aria-label="Hi,Silahkan masukkan deskripsi permintaan anda" aria-describedby="basic-icon-default-message2"
                                            style="height: 160px;"></textarea>
                                        <label for="basic-icon-default-message">Deskripsi</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating form-floating-outline mb-3">
                                <p><small class="text-center text-danger">Jika file lebih besar dari 2mb silahkan tulis
                                        google drive ke
                                        dalam deskripsi</small></p>

                            </div>


                            <div class="form-floating form-floating-outline mb-3">

                                <input type="file" class="form-control" id="file" name="file" placeholder=""
                                    autofocus>
                                <label for="file">Masukkan file</label>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Kirim / Masuk SSO</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>Belum punya akun SSO?</span>
                            <a href="{{ url('auth/register-basic') }}">
                                <span>Daftar akun SSO sekarang</span>
                            </a>
                        </p>


                    </div>
                </div>
                <!-- /Login -->
                <img alt="mask"
                    src="{{ asset('assets/img/illustrations/auth-basic-login-mask-' . $configData['style'] . '.png') }}"
                    class="authentication-image d-none d-lg-block"
                    data-app-light-img="illustrations/auth-basic-login-mask-light.png"
                    data-app-dark-img="illustrations/auth-basic-login-mask-dark.png" />
            </div>
        </div>
    </div>
@endsection
