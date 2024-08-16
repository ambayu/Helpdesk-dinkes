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
                        <h4 class="mb-2">Selamat Datang {{ config('variables.templateName') }}! 👋</h4>
                        @error('status')
                            <div class="mb-2 font-medium text-sm text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <p class="mb-4">Silahkan login menggunakan SSO</p>
                        @if (session('error'))
                            <div class="alert alert-danger text-center">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="text-center">
                            <a href="https://sso.pemkomedan.go.id/app-client/196460166873175833251781722932643/redirect">
                                <img class="" style="width:75%; " src="{{ asset('assets/img/branding/login.gif') }}"
                                    alt="">
                            </a>
                        </div>





                        <div class="divider my-4">
                            <div class="divider-text">Atau</div>
                        </div>

                        <p class="text-center">
                            <span>Pengguna Lainnya ?</span>
                            <a href="{{ url('/login-admin') }}">
                                <span>Masuk Sebagai Admin</span>
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
