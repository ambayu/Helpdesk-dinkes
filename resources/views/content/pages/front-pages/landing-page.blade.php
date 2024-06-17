@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Landing - Front Pages')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/nouislider/nouislider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-landing.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/nouislider/nouislider.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/front-page-landing.js') }}"></script>
@endsection

@section('content')
    <div data-bs-spy="scroll" class="scrollspy-example">
        <!-- Hero: Start -->
        <section id="landingHero" class="section-py landing-hero">
            <div class="container">
                <div class="hero-text-box text-center" style="max-width: 1000px">
                    <h1 class="text-primary hero-title">LAYANAN HELP DESK</h1>
                    <h2 class="h6 mb-4 pb-1 lh-lg">
                        Dinas Komunikasi dan Informatika (Diskominfo) Pemerintah Kota Medan menyediakan layanan Help Desk
                        untuk memberikan dukungan dan solusi terkait masalah teknologi informasi dan komunikasi (TIK) kepada
                        masyarakat dan instansi pemerintahan di Kota Medan. Layanan ini bertujuan untuk memastikan bahwa
                        semua permasalahan teknis yang berhubungan dengan TIK dapat diatasi dengan cepat dan efisien.
                    </h2>
                    <a href="{{ url('/auth/login-basic') }}" class="btn btn-primary">MASUK</a>
                </div>
                <div class="position-relative hero-animation-img">
                    <a href="{{ url('/app/ecommerce/dashboard') }}" target="_blank">
                        <div class="hero-dashboard-img text-center">
                            <img src="{{ asset('assets/img/front-pages/landing-page/hero-dashboard-' . $configData['style'] . '.png') }}"
                                alt="hero dashboard" class="animation-img" data-speed="2"
                                data-app-light-img="front-pages/landing-page/hero-dashboard-light.png"
                                data-app-dark-img="front-pages/landing-page/hero-dashboard-dark.png" />
                        </div>
                        <div class="position-absolute hero-elements-img">
                            <img src="{{ asset('assets/img/front-pages/landing-page/hero-elements-' . $configData['style'] . '.png') }}"
                                alt="hero elements" class="animation-img" data-speed="4"
                                data-app-light-img="front-pages/landing-page/hero-elements-light.png"
                                data-app-dark-img="front-pages/landing-page/hero-elements-dark.png" />
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <!-- Hero: End -->

        <!-- Useful features: Start -->

        <!-- Useful features: End -->
        <br><br> <br><br>
        <!-- Real customers reviews: Start -->
        <section id="landingReviews" class="section-py bg-body landing-reviews pb-0">
            <div class="container">
                <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-4">
                    <img src="{{ asset('assets/img/front-pages/icons/section-tilte-icon.png') }}" alt="section title icon"
                        class="me-2" />
                    <span class="text-uppercase">Ulasan Asli Masyarakat</span>
                </h6>
                <h3 class="text-center mb-2"><span class="fw-bold">Ulasan</span> dari masyarakat dan pegawai</h3>
                <p class="text-center fw-medium mb-3 mb-md-5">Lihat beberapa ulasan yang diberikan daei masyarakat dan
                    pegawai atas pelayanan kami </p>
            </div>
            <div class="swiper-reviews-carousel overflow-hidden mb-5 pt-4">
                <div class="swiper" id="swiper-reviews">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('assets/img/front-pages/branding/logo-4.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        “I've never used a theme as versatile and flexible as Materialize. It's my go to for
                                        building dashboard
                                        sites on almost any project.”
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Eugenia Moore</h6>
                                        <p class="mb-0">Founder of Hubspot</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('assets/img/front-pages/branding/logo-1.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>Materio is awesome, and I particularly enjoy knowing that if I get stuck on
                                        something.</p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Tommy haffman</h6>
                                        <p class="mb-0">Founder of Levis</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('assets/img/front-pages/branding/logo-3.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        This template is superior in so many ways. The code, the design, the regular
                                        updates, the
                                        support.. It’s the whole package. Excellent Work.
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Eugenia Moore</h6>
                                        <p class="mb-0">CTO of Airbnb</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('assets/img/front-pages/branding/logo-2.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        All the requirements for developers have been taken into consideration, so I’m able
                                        to build any
                                        interface I want.
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Sara Smith</h6>
                                        <p class="mb-0">Founder of Continental</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('assets/img/front-pages/branding/logo-5.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        “I've never used a theme as versatile and flexible as Materialize. It's my go to for
                                        building dashboard
                                        sites on almost any project.”
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Eugenia Moore</h6>
                                        <p class="mb-0">Founder of Hubspot</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center h-100">
                                    <div class="mb-3">
                                        <img src="{{ asset('assets/img/front-pages/branding/logo-4.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        “I've never used a theme as versatile and flexible as Materialize. It's my go to for
                                        building dashboard
                                        sites on almost any project.”
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star-outline mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Eugenia Moore</h6>
                                        <p class="mb-0">Founder of Hubspot</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center h-100">
                                    <div class="mb-3">
                                        <img src="{{ asset('assets/img/front-pages/branding/logo-1.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>Materio is awesome, and I particularly enjoy knowing that if I get stuck on
                                        something.</p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Tommy haffman</h6>
                                        <p class="mb-0">Founder of Levis</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center h-100">
                                    <div class="mb-3">
                                        <img src="{{ asset('assets/img/front-pages/branding/logo-3.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        This template is superior in so many ways. The code, the design, the regular
                                        updates, the
                                        support.. It’s the whole package. Excellent Work.
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Eugenia Moore</h6>
                                        <p class="mb-0">CTO of Airbnb</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center h-100">
                                    <div class="mb-3">
                                        <img src="{{ asset('assets/img/front-pages/branding/logo-2.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        All the requirements for developers have been taken into consideration, so I’m able
                                        to build any
                                        interface I want.
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star-outline mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Sara Smith</h6>
                                        <p class="mb-0">Founder of Continental</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center h-100">
                                    <div class="mb-3">
                                        <img src="{{ asset('assets/img/front-pages/branding/logo-5.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        “I've never used a theme as versatile and flexible as Materialize. It's my go to for
                                        building dashboard
                                        sites on almost any project.”
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Eugenia Moore</h6>
                                        <p class="mb-0">Founder of Hubspot</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('assets/img/front-pages/branding/logo-4.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        “I've never used a theme as versatile and flexible as Materialize. It's my go to for
                                        building dashboard
                                        sites on almost any project.”
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Eugenia Moore</h6>
                                        <p class="mb-0">Founder of Hubspot</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('assets/img/front-pages/branding/logo-1.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>Materio is awesome, and I particularly enjoy knowing that if I get stuck on
                                        something.</p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Tommy haffman</h6>
                                        <p class="mb-0">Founder of Levis</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('assets/img/front-pages/branding/logo-3.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        This template is superior in so many ways. The code, the design, the regular
                                        updates, the
                                        support.. It’s the whole package. Excellent Work.
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Eugenia Moore</h6>
                                        <p class="mb-0">CTO of Airbnb</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('assets/img/front-pages/branding/logo-2.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        All the requirements for developers have been taken into consideration, so I’m able
                                        to build any
                                        interface I want.
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Sara Smith</h6>
                                        <p class="mb-0">Founder of Continental</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('assets/img/front-pages/branding/logo-5.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        “I've never used a theme as versatile and flexible as Materialize. It's my go to for
                                        building dashboard
                                        sites on almost any project.”
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Eugenia Moore</h6>
                                        <p class="mb-0">Founder of Hubspot</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <hr class="m-0" />

        </section>
        <!-- Real customers reviews: End -->

        <!-- Our great team: Start -->

        <!-- Our great team: End -->

        <!-- Pricing plans: Start -->

        <!-- Pricing plans: End -->

        <!-- Fun facts: Start -->
        <section id="landingFunFacts" class="section-py landing-fun-facts">
            <div class="container">
                <div class="row gx-0 gy-5 gx-sm-5">
                    <div class="col-md-3 col-sm-6 text-center">
                        <span class="badge badge-center rounded-pill bg-label-hover-primary fun-facts-icon mb-4"><i
                                class="tf-icons mdi mdi-land-plots mdi-36px"></i></span>
                        <h2 class="fw-bold mb-1">137</h2>
                        <p class="fw-medium mb-0">Total Permintaan</p>
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <span class="badge badge-center rounded-pill bg-label-hover-success fun-facts-icon mb-4"><i
                                class="tf-icons mdi mdi-clock-outline mdi-36px"></i></span>
                        <h2 class="fw-bold mb-1">10</h2>
                        <p class="fw-medium mb-0">Sukses</p>
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <span class="badge badge-center rounded-pill bg-label-hover-warning fun-facts-icon mb-4"><i
                                class="tf-icons mdi mdi-emoticon-happy-outline mdi-36px"></i></span>
                        <h2 class="fw-bold mb-1">120</h2>
                        <p class="fw-medium mb-0">Sedang diproses</p>
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <span class="badge badge-center rounded-pill bg-label-hover-info fun-facts-icon mb-4"><i
                                class="tf-icons mdi mdi-medal-outline mdi-36px"></i></span>
                        <h2 class="fw-bold mb-1">12</h2>
                        <p class="fw-medium mb-0">Belum diproses</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Fun facts: End -->

        <!-- FAQ: Start -->
        <section id="landingFAQ" class="section-py bg-body landing-faq">
            <div class="container bg-icon-right">
                <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-4">
                    <img src="{{ asset('assets/img/front-pages/icons/section-tilte-icon.png') }}"
                        alt="section title icon" class="me-2" />
                    <span class="text-uppercase">Bantuan</span>
                </h6>
                <h3 class="text-center mb-2">Pertanyaan<span class="fw-bold"> yang sering diajukan</span></h3>
                <p class="text-center fw-medium mb-3 mb-md-5 pb-3">
                    Browse through these FAQs to find answers to commonly asked questions.
                </p>
                <div class="row gy-5">
                    <div class="col-lg-5">
                        <div class="text-center">
                            <img src="{{ asset('assets/img/front-pages/landing-page/sitting-girl-with-laptop.png') }}"
                                alt="sitting girl with laptop" class="faq-image" />
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="accordion" id="accordionFront">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="head-One">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                                        Do you charge for each upgrade?
                                    </button>
                                </h2>

                                <div id="accordionOne" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFront" aria-labelledby="accordionOne">
                                    <div class="accordion-body">
                                        Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping. Sesame
                                        snaps icing
                                        marzipan gummi bears macaroon dragée danish caramels powder. Bear claw dragée pastry
                                        topping
                                        soufflé. Wafer gummi bears marshmallow pastry pie.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="head-Two">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#accordionTwo" aria-expanded="false"
                                        aria-controls="accordionTwo">
                                        Do I need to purchase a license for each website?
                                    </button>
                                </h2>
                                <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="accordionTwo"
                                    data-bs-parent="#accordionFront">
                                    <div class="accordion-body">
                                        Dessert ice cream donut oat cake jelly-o pie sugar plum cheesecake. Bear claw dragée
                                        oat cake
                                        dragée ice cream halvah tootsie roll. Danish cake oat cake pie macaroon tart donut
                                        gummies. Jelly
                                        beans candy canes carrot cake. Fruitcake chocolate chupa chups.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item active">
                                <h2 class="accordion-header" id="head-Three">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#accordionThree" aria-expanded="true"
                                        aria-controls="accordionThree">
                                        What is regular license?
                                    </button>
                                </h2>
                                <div id="accordionThree" class="accordion-collapse collapse show"
                                    aria-labelledby="accordionThree" data-bs-parent="#accordionFront">
                                    <div class="accordion-body">
                                        Regular license can be used for end products that do not charge users for access or
                                        service(access
                                        is free and there will be no monthly subscription fee). Single regular license can
                                        be used for
                                        single end product and end product can be used by you or your client. If you want to
                                        sell end
                                        product to multiple clients then you will need to purchase separate license for each
                                        client. The
                                        same rule applies if you want to use the same end product on multiple domains(unique
                                        setup). For
                                        more info on regular license you can check official description.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="head-Four">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#accordionFour" aria-expanded="false"
                                        aria-controls="accordionFour">
                                        What is extended license?
                                    </button>
                                </h2>
                                <div id="accordionFour" class="accordion-collapse collapse"
                                    aria-labelledby="accordionFour" data-bs-parent="#accordionFront">
                                    <div class="accordion-body">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis et aliquid quaerat
                                        possimus maxime!
                                        Mollitia reprehenderit neque repellat deleniti delectus architecto dolorum maxime,
                                        blanditiis
                                        earum ea, incidunt quam possimus cumque.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="head-Five">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#accordionFive" aria-expanded="false"
                                        aria-controls="accordionFive">
                                        Which license is applicable for SASS application?
                                    </button>
                                </h2>
                                <div id="accordionFive" class="accordion-collapse collapse"
                                    aria-labelledby="accordionFive" data-bs-parent="#accordionFront">
                                    <div class="accordion-body">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sequi molestias
                                        exercitationem ab cum
                                        nemo facere voluptates veritatis quia, eveniet veniam at et repudiandae mollitia
                                        ipsam quasi
                                        labore enim architecto non!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- FAQ: End -->




    </div>
@endsection
