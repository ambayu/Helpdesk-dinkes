@php
    $configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')

@section('title', 'Dashboard - Analytics')
@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
@endsection

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-statistics.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-analytics.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-ecommerce-dashboard.js') }}"></script>

    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i
                                    class="mdi mdi-bus-school mdi-20px"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0 display-6">{{ $ticketCounts['total'] }} </h4>
                    </div>
                    <p class="mb-0 text-heading">Total {{ $ticketCounts['total'] }} permintaan </p>
                    <p class="mb-0">
                        {{-- <span class="me-1">+18.2%</span> --}}
                        <small class="text-muted">Seluruhnya</small>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-border-shadow-success h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-success">
                                <i class='mdi mdi-check-circle-outline mdi-20px'></i></span>
                        </div>
                        <h4 class="ms-1 mb-0 display-6">{{ $ticketCounts['finish'] }}</h4>
                    </div>
                    <p class="mb-0 text-heading">Total {{ $ticketCounts['finish'] }} permintaan selesai</p>
                    <p class="mb-0">
                        {{-- <span class="me-1">-8.7%</span> --}}
                        <small class="text-muted">Seluruhnya</small>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-border-shadow-warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-warning">
                                <i class='mdi mdi-source-fork mdi-20px'></i>
                            </span>
                        </div>
                        <h4 class="ms-1 mb-0 display-6">{{ $ticketCounts['proses'] }}</h4>
                    </div>
                    <p class="mb-0 text-heading">Total {{ $ticketCounts['proses'] }} permintaan diproses</p>
                    <p class="mb-0">
                        {{-- <span class="me-1">+4.3%</span> --}}
                        <small class="text-muted">dari minggu lalu</small>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-border-shadow-info h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-info"><i
                                    class='mdi mdi-timer-outline mdi-20px'></i></span>
                        </div>
                        <h4 class="ms-1 mb-0 display-6">{{ $ticketCounts['pending'] }}</h4>
                    </div>
                    <p class="mb-0 text-heading">Total {{ $ticketCounts['pending'] }} permintaan ditinjau</p>
                    <p class="mb-0">
                        {{-- <span class="me-1">-2.5%</span> --}}
                        <small class="text-muted">dari minggu lalu</small>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row gy-4">
        <!-- Gamification Card -->
        <div class="col-md-12 col-lg-8">
            <div class="card h-100">
                <div class="d-flex align-items-end row">
                    <div class="col-md-8 order-2 order-md-1">
                        <div class="card-body">
                            <h4 class="card-title pb-xl-2">Selamat kepada {{ auth()->user()->name }}!🎉</h4>

                            <p class="mb-0">
                                Help Desk Dinas Kominfo Pemerintah Kota Medan menyediakan layanan dukungan teknis dan
                                informasi bagi warga kota medan serta ASN.
                            </p>
                            </p>
                            <p>
                                Untuk informasi lebih lanjut atau bantuan, silakan kunjungi profil Anda atau hubungi kami
                                melalui saluran yang tersedia.
                            </p>
                            <a href="{{ url('/pages/profile-user') }}" class="btn btn-primary">Lihat Profile</a>
                        </div>
                    </div>
                    <div class="col-md-4 text-center text-md-end order-1 order-md-2">
                        <div class="card-body pb-0 px-0 px-md-4 ps-0">
                            <img src="{{ asset('assets/img/illustrations/illustration-john-' . $configData['style'] . '.png') }}"
                                height="180" alt="View Profile"
                                data-app-light-img="illustrations/illustration-john-light.png"
                                data-app-dark-img="illustrations/illustration-john-dark.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Gamification Card -->

        <!-- Statistics Total Order -->
        <div class="col-lg-2 col-sm-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                        <div class="avatar">
                            <div class="avatar-initial bg-label-primary rounded">
                                <i class="mdi mdi-check-circle mdi-24px"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <p class="mb-0 text-success me-1">+{{ $ticketCounts['total_persen_bulan_ini'] }}</p>
                            <i class="mdi mdi-chevron-up text-success"></i>
                        </div>
                    </div>
                    <div class="card-info mt-4 pt-1 mt-lg-1 mt-xl-4">
                        <h5 class="mb-4">{{ $ticketCounts['total_bulan_ini'] }}</h5>
                        <p class="mb-lg-2 mb-xl-3">Total Permintaan bulan ini</p>
                        <div class="badge bg-label-secondary rounded-pill">Hingga saat ini</div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Statistics Total Order -->

        <!-- Sessions line chart -->
        <div class="col-lg-2 col-sm-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-end mb-1 flex-wrap gap-2">
                        <h4 class="mb-0 me-2">{{ $ticketCounts['today'] }}</h4>
                        <p class="mb-0 text-success">+{{ $ticketCounts['todaypersen'] }}</p>
                    </div>
                    <span class="d-block mb-2 text-body">Permintaan hari ini</span>
                </div>
                <div class="card-body pt-0">
                    <div id="sessions"></div>
                </div>
            </div>
        </div>
        <!--/ Sessions line chart -->

        <!-- Dinas Kominfo Kota Medan with bg-->
        {{-- <div class="col-lg-6">
            <div class="swiper-container swiper-container-horizontal swiper text-bg-primary"
                id="swiper-weekly-sales-with-bg">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-white mb-2">Dinas Kominfo Kota Medan</h5>
                                <div class="d-flex align-items-center gap-2">
                                    <small>Total Permintaan</small>
                                    <div class="d-flex text-success">
                                        <small class="fw-medium">+62%</small>
                                        <i class="mdi mdi-chevron-up"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                                    <h6 class="text-white mt-0 mt-md-3 mb-3 py-1">Permintaan Website</h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-flex mb-3 align-items-center">
                                                    <p class="mb-0 me-2 weekly-sales-text-bg-primary">1</p>
                                                    <p class="mb-0">KTP</p>
                                                </li>
                                                <li class="d-flex align-items-center">
                                                    <p class="mb-0 me-2 weekly-sales-text-bg-primary">2</p>
                                                    <p class="mb-0">SKCK</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-flex mb-3 align-items-center">
                                                    <p class="mb-0 me-2 weekly-sales-text-bg-primary">3</p>
                                                    <p class="mb-0">Surat Izin</p>
                                                </li>
                                                <li class="d-flex align-items-center">
                                                    <p class="mb-0 me-2 weekly-sales-text-bg-primary">4</p>
                                                    <p class="mb-0">Deskripsi Masalah</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-2 my-md-0 text-center">
                                    <img src="{{ asset('assets/img/products/card-weekly-sales-phone.png') }}"
                                        alt="Dinas Kominfo Kota Medan" width="230" class="weekly-sales-img">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-white mb-2">Dinas Kominfo Kota Medan</h5>
                                <div class="d-flex align-items-center gap-2">
                                    <small>Total Permintaan</small>
                                    <div class="d-flex text-success">
                                        <small class="fw-medium">+62%</small>
                                        <i class="mdi mdi-chevron-up"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                                <h6 class="text-white mt-0 mt-md-3 mb-3 py-1">Permintaan Api</h6>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-3 align-items-center">
                                                <p class="mb-0 me-2 weekly-sales-text-bg-primary">5</p>
                                                <p class="mb-0">Surat Izin</p>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <p class="mb-0 me-2 weekly-sales-text-bg-primary">6</p>
                                                <p class="mb-0">Alamat </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-3 align-items-center">
                                                <p class="mb-0 me-2 weekly-sales-text-bg-primary">7</p>
                                                <p class="mb-0">NIP Pegawai Penerima</p>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <p class="mb-0 me-2 weekly-sales-text-bg-primary">8</p>
                                                <p class="mb-0">Deskripsi Permintaan</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-2 my-md-0 text-center">
                                <img src="{{ asset('assets/img/products/card-weekly-sales-controller.png') }}"
                                    alt="Dinas Kominfo Kota Medan" width="230" class="weekly-sales-img">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-white mb-2">Dinas Kominfo Kota Medan</h5>
                                <div class="d-flex align-items-center gap-2">
                                    <small>Total Permintaan</small>
                                    <div class="d-flex text-success">
                                        <small class="fw-medium">+62%</small>
                                        <i class="mdi mdi-chevron-up"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                                <h6 class="text-white mt-0 mt-md-3 mb-3 py-1">Layanan Pembukaan Port Server</h6>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-3 align-items-center">
                                                <p class="mb-0 me-2 weekly-sales-text-bg-primary">9</p>
                                                <p class="mb-0">Surat Izin</p>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <p class="mb-0 me-2 weekly-sales-text-bg-primary">10</p>
                                                <p class="mb-0">Port</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-3 align-items-center">
                                                <p class="mb-0 me-2 weekly-sales-text-bg-primary">11</p>
                                                <p class="mb-0">Server</p>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <p class="mb-0 me-2 weekly-sales-text-bg-primary">12</p>
                                                <p class="mb-0">Deskripsi Perminaan</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-2 my-md-0 text-center">
                                <img src="{{ asset('assets/img/products/card-weekly-sales-watch.png') }}"
                                    alt="Dinas Kominfo Kota Medan" width="230" class="weekly-sales-img">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div> --}}
        <div class="col-xl-12">
            <div class="card h-100">
                <div class="card-body text-nowrap">
                    <h4 class="card-title mb-1 d-flex gap-2 flex-wrap">Selamat Akun Berhasil Dibuat! 🎉</h4>
                    <p class="pb-0">Akun anda berhasil dibuat</p>
                    <h4 class="text-primary mb-1">Kirim Permintaan</h4>
                    <p class="mb-2 pb-1">lihat permintaan yang telah diproses 🚀</p>
                    <a href="{{ url('/app/cek-permintaan') }}" class="btn btn-sm btn-primary">Cek Permintaan</a>
                </div>
                <img src="{{ asset('assets/img/illustrations/trophy.png') }}"
                    class="position-absolute bottom-0 end-0 me-3" height="140" alt="view sales">
            </div>
        </div>
        {{-- end weekly --}}

        <div class="col-12 col-xl-12 col-md-6">

            <div class="card h-100">
                <div class="card-body">
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
                    <div class="bg-label-info text-center mb-3 pt-2 rounded-3">
                        <img class="img-fluid"
                            src="  {{ $news->foto ? Storage::url($news->foto) : asset('assets/img/illustrations/card-ratings-illustration.png') }}"
                            alt="Boy card image" width="130" />
                    </div>
                    <h5 class="mb-2 pb-1">{{ $news->judul }}</h5>
                    <p>{{ $news->deskripsi }}</p>
                    <div class="row mb-3 g-3">
                        <div class="col-6">
                            <div class="d-flex">
                                <div class="avatar flex-shrink-0 me-2">
                                    <span class="avatar-initial rounded bg-label-primary"><i
                                            class="mdi mdi-calendar-blank mdi-24px"></i></span>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-nowrap">{{ $news->tanggal }}</h6>
                                    <small>Tanggal</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex">
                                <div class="avatar flex-shrink-0 me-2">
                                    <span class="avatar-initial rounded bg-label-primary"><i
                                            class="mdi mdi-timer-outline mdi-24px"></i></span>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-nowrap">{{ $news->durasi }}</h6>
                                    <small>Durasi</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ $news->link }}" class="btn btn-primary w-100">Gabung Webminar</a>
                    @if (auth()->user()->roles[0]->name != 'User')
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editNews"
                            class="btn btn-danger w-100 mt-2 ">Edit</a>
                    @endif
                </div>
            </div>
        </div>
        {{-- end  --}}


    </div>

    @include('_partials/_modals/modal-edit-news')

@endsection
