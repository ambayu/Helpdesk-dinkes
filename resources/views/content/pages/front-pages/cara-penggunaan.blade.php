@php
    $configData = Helper::appClasses();
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Cara Penggunaan')

@section('vendor-style')
    <!-- Vendor -->
    <style>
        .timeline {
            position: relative;
            padding: 20px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            width: 2px;
            background: #dee2e6;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -1px;
        }

        .timeline-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            position: relative;
        }

        .timeline-content {
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            width: calc(50% - 15px);
        }

        .timeline-left {
            margin-right: 15px;
        }

        .timeline-right {
            margin-left: 15px;
        }

        .tutorial-image {
            width: 100%;
            max-width: 500px;
            /* Tambahan untuk max width */
            height: auto;
            max-height: 300px;
            margin: 15px 0;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            object-fit: contain;
            display: block;
            /* Tambahan untuk memastikan margin auto bekerja */
            margin-left: auto;
            /* Tambahan untuk center image */
            margin-right: auto;
            /* Tambahan untuk center image */
        }

        .step-number {
            position: absolute;
            top: -15px;
            left: -15px;
            width: 30px;
            height: 30px;
            background: #696cff;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            z-index: 1;
        }

        @media (max-width: 768px) {
            .timeline-item {
                flex-direction: column;
            }

            .timeline-content {
                width: 100%;
                margin: 10px 0;
            }

            .timeline::before {
                display: none;
            }
        }
    </style>
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
            <div style="max-width:90%;" class="authentication-inner py-4 mt-5">

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
                        <h4 class="mb-2">Tata Cara Penggunaan👋 </h4>
                        <p class="mb-4">Berikut Merupakan tata cara penggunaan aplikasi help desk DISKOMINFO MEDAN</p>

                        <div class="py-5">
                            <div class="timeline">
                                <!-- Row 1 -->
                                <div class="timeline-item">
                                    <div class="timeline-content timeline-left">
                                        <div class="step-number">1</div>
                                        <h3>Tentang Aplikasi</h3>
                                        <p>Help Desk DISKOMINFO adalah aplikasi berbasis website yang disediakan oleh
                                            DISKOMINFO Pemerintah Kota Medan untuk memudahkan masyarakat dalam menyampaikan
                                            aspirasi, keluhan, dan permohonan terkait pelayanan publik.</p>
                                        <img src="{{ asset('assets/img/tutorial/1.png') }}" alt="Login SSO"
                                            class="tutorial-image" />
                                        <p>Untuk menggunakan aplikasi:</p>
                                        <ul>
                                            <li>Silahkan klik tombol MASUK yang terdapat disudut atas ataupun ditengah dari
                                                halaman</li>
                                        </ul>
                                    </div>
                                    <div class="timeline-content timeline-right">
                                        <div class="step-number">2</div>
                                        <h3>Halaman Login</h3>
                                        <img src="{{ asset('assets/img/tutorial/2.png') }}" alt="Halaman Login"
                                            class="tutorial-image" />
                                        <p>Untuk mengakses sistem:</p>
                                        <ul>
                                            <li>Buka halaman login</li>
                                            <li>Masuk menggunakan akun yang sudah ada</li>
                                            <li>Atau login menggunakan SSO</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Row 2 -->
                                <div class="timeline-item">
                                    <div class="timeline-content timeline-left">
                                        <div class="step-number">3</div>
                                        <h3>Login dengan SSO</h3>
                                        <img src="{{ asset('assets/img/tutorial/3.png') }}" alt="Login SSO"
                                            class="tutorial-image" />
                                        <p>Dengan SSO, pengguna dapat:</p>
                                        <ul>
                                            <li>Membuat akun baru</li>
                                            <li>Menggunakan satu akun untuk semua aplikasi Pemkot Medan</li>
                                            <li>Melengkapi data profil</li>
                                        </ul>
                                    </div>
                                    <div class="timeline-content timeline-right">
                                        <div class="step-number">4</div>
                                        <h3>Dashboard</h3>
                                        <img src="{{ asset('assets/img/tutorial/4.png') }}" alt="Dashboard"
                                            class="tutorial-image" />
                                        <p>Setelah login berhasil, pengguna akan melihat dashboard yang menampilkan
                                            informasi utama dan menu navigasi.</p>
                                    </div>
                                </div>

                                <!-- Row 3 -->
                                <div class="timeline-item">
                                    <div class="timeline-content timeline-left">
                                        <div class="step-number">5</div>
                                        <h3>Pilih Permintaan</h3>
                                        <img src="{{ asset('assets/img/tutorial/5.png') }}" alt="Pilih Permintaan"
                                            class="tutorial-image" />
                                        <p>Langkah pertama mengirim permintaan:</p>
                                        <ul>
                                            <li>Pilih kategori permintaan yang sesuai</li>
                                            <li>Sistem akan menampilkan form yang sesuai</li>
                                        </ul>
                                    </div>
                                    <div class="timeline-content timeline-right">
                                        <div class="step-number">6</div>
                                        <h3>Form Pengisian Permintaan</h3>
                                        <img src="{{ asset('assets/img/tutorial/6.png') }}" alt="Form Permintaan"
                                            class="tutorial-image" />
                                        <p>Panduan pengisian form:</p>
                                        <ul>
                                            <li>Isi semua field yang wajib diisi</li>
                                            <li>Untuk field yang tidak diperlukan, isi dengan (-)</li>
                                            <li>Pastikan semua informasi terisi dengan benar</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Row 4 -->
                                <div class="timeline-item">
                                    <div class="timeline-content timeline-left">
                                        <div class="step-number">7</div>
                                        <h3>Cek Status Permintaan</h3>
                                        <img src="{{ asset('assets/img/tutorial/7.png') }}" alt="Cek Status"
                                            class="tutorial-image" />
                                        <p>Status permintaan dapat dicek melalui:</p>
                                        <ul>
                                            <li>Menu Cek Permintaan di dashboard</li>
                                            <li>Halaman Cek Status dengan memasukkan nomor tiket</li>
                                            <li>Status yang mungkin muncul:</li>
                                            <ul>
                                                <li>"Menunggu diproses" - masih bisa diedit/hapus</li>
                                                <li>"Menunggu balasan admin" - sedang diproses</li>
                                                <li>"Menunggu balasan User" - perlu tanggapan</li>
                                            </ul>
                                        </ul>
                                    </div>
                                    <div class="timeline-content timeline-right">
                                        <div class="step-number">8</div>
                                        <h3>Menanggapi Respon Admin</h3>
                                        <img src="{{ asset('assets/img/tutorial/8.png') }}" alt="Kirim Respon"
                                            class="tutorial-image" />
                                        <p>Cara menanggapi:</p>
                                        <ul>
                                            <li>Klik tombol balas pada permintaan</li>
                                            <li>Isi form tanggapan</li>
                                            <li>Lampirkan file jika diperlukan</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Row 5 -->
                                <div class="timeline-item">
                                    <div class="timeline-content timeline-left">
                                        <div class="step-number">9</div>
                                        <h3>Status Akhir Permintaan</h3>
                                        <img src="{{ asset('assets/img/tutorial/9.png') }}" alt="Status Selesai"
                                            class="tutorial-image" />
                                        <p>Setelah permintaan diproses:</p>
                                        <ul>
                                            <li>Status akan berubah menjadi "Selesai"</li>
                                            <li>Permintaan telah selesai diproses</li>
                                        </ul>
                                    </div>
                                    <div class="timeline-content timeline-right">
                                        <div class="step-number">10</div>
                                        <h3>Memberikan Feedback</h3>
                                        <img src="{{ asset('assets/img/tutorial/10.png') }}" alt="Feedback"
                                            class="tutorial-image" />
                                        <p>Akhir proses:</p>
                                        <ul>
                                            <li>Berikan feedback tentang layanan</li>
                                            <li>Nilai kinerja admin</li>
                                            <li>Proses selesai</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Row 5 -->
                                <div class="timeline-item">
                                    <div class="timeline-content timeline-left">
                                        <div class="step-number">11</div>
                                        <h3>Cek Status Permintaan</h3>
                                        <img src="{{ asset('assets/img/tutorial/11.png') }}" alt="Status Selesai"
                                            class="tutorial-image" />
                                        <p>Status permintaan juga dapat dilihat di menu dashboard Cek Status Permintaan</p>

                                    </div>
                                    <div class="timeline-content timeline-right">
                                        <div class="step-number">12</div>
                                        <h3>Keseluruhan permintaan juga dapat dilihat di menu dashboard Cek Status
                                            Permintaan</h3>
                                        <img src="{{ asset('assets/img/tutorial/12.png') }}" alt="Feedback"
                                            class="tutorial-image" />
                                        <p>Akhir proses:</p>
                                        <ul>
                                            <li>Berikan feedback tentang layanan</li>
                                            <li>Nilai kinerja admin</li>
                                            <li>Proses selesai</li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    @if (!auth()->user())
                        <p class="text-center">
                            <span>Belum punya akun SSO?</span>
                            <a href="https://sso.pemkomedan.go.id/login-users">
                                <span>Daftar akun SSO sekarang</span>
                            </a>
                        </p>
                    @endif
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
@endsection
