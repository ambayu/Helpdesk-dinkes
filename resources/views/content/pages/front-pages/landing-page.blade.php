@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Landing Page - Front Pages')

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
                    <a href="{{ url('/login') }}" class="btn btn-primary">MASUK</a>
                </div>
                <div class="position-relative hero-animation-img">
                    <a href="{{ url('/login') }}" target="_blank">
                        <div class="hero-dashboard-img text-center">
                            <img src="{{ asset('assets/img/front-pages/landing-page/hero-dashboard-' . $configData['style'] . '.png') }}"
                                alt="hero dashboard" class="animation-img" style="height: 700px; width:auto;" data-speed="2"
                                data-app-light-img="front-pages/landing-page/hero-dashboard-light.png"
                                data-app-dark-img="front-pages/landing-page/hero-dashboard-light.png" />
                        </div>
                        <div class="position-absolute hero-elements-img">
                            <img src="{{ asset('assets/img/front-pages/landing-page/hero-elements-' . $configData['style'] . '.png') }}"
                                alt="hero elements" class="animation-img" data-speed="4"
                                data-app-light-img="front-pages/landing-page/hero-elements-ligh2t.png"
                                data-app-dark-img="front-pages/landing-page/hero-elements-ligh2t.png" />
                        </div>

                        {{-- <div class="hero-dashboard-img text-center">
                          <img src="{{ asset('assets/img/front-pages/landing-page/hero-dashboard-' . $configData['style'] . '.png') }}"
                              alt="hero dashboard" class="animation-img" style="height: 700px; width:auto;" data-speed="2"
                              data-app-light-img="front-pages/landing-page/hero-dashboard-light.png"
                              data-app-dark-img="front-pages/landing-page/hero-dashboard-dark.png" />
                      </div>
                      <div class="position-absolute hero-elements-img">
                          <img src="{{ asset('assets/img/front-pages/landing-page/hero-elements-' . $configData['style'] . '.png') }}"
                              alt="hero elements" class="animation-img" data-speed="4"
                              data-app-light-img="front-pages/landing-page/hero-elements-ligh2t.png"
                              data-app-dark-img="front-pages/landing-page/hero-elements-dark.png" />
                      </div> --}}
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
                <p class="text-center fw-medium mb-3 mb-md-5">Lihat beberapa ulasan yang diberikan dari masyarakat dan
                    pegawai atas pelayanan kami </p>
                <div class="mb-4">
                    <div class="card h-100">
                        <div class="card-body row widget-separator">
                            <div class="col-sm-5 border-shift border-end">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="text-primary display-5 fw-normal">{{ $ticketCounts['average'] }}</span>
                                    <span class='mdi mdi-star mdi-24px ms-1 text-primary'></span>
                                </div>
                                <h6>Total {{ $totalRatings }} ulasan</h6>
                                <p>Ulasan ini adalah 100% nyata dan berasal dari pelanggan yang benar-benar telah merasakan
                                    pengalaman dengan pelayanan kami</p>
                                <span class="badge bg-label-primary rounded-pill p-2 mb-3 mb-sm-0"></span>
                                <hr class="d-sm-none">
                            </div>

                            <div class="col-sm-7 g-2 text-nowrap d-flex flex-column justify-content-between px-4 gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    <small>5 Star </small>
                                    <div class="progress w-100 rounded" style="height:10px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ $starCounts['5_star']['percentage'] }}%;"
                                            aria-valuenow="61.50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="w-px-20 text-end">{{ $starCounts['5_star']['count'] }}</small>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <small>4 Star</small>
                                    <div class="progress w-100 rounded" style="height:10px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ $starCounts['4_star']['percentage'] }}%;" aria-valuenow="24"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="w-px-20 text-end">{{ $starCounts['4_star']['count'] }}</small>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <small>3 Star</small>
                                    <div class="progress w-100 rounded" style="height:10px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ $starCounts['3_star']['percentage'] }}%;" aria-valuenow="12"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="w-px-20 text-end">{{ $starCounts['3_star']['count'] }}</small>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <small>2 Star</small>
                                    <div class="progress w-100 rounded" style="height:10px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ $starCounts['2_star']['percentage'] }}%;" aria-valuenow="7"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="w-px-20 text-end">{{ $starCounts['2_star']['count'] }}</small>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <small>1 Star</small>
                                    <div class="progress w-100 rounded" style="height:10px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ $starCounts['1_star']['percentage'] }}%;" aria-valuenow="2"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="w-px-20 text-end">{{ $starCounts['1_star']['count'] }}
                                    </small>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-reviews-carousel overflow-hidden mb-5 pt-4">
                <div class="swiper" id="swiper-reviews">

                    <div class="swiper-wrapper">

                        @foreach ($ratings as $rating)
                            <divs class="swiper-slide">
                                <div class="card h-100">
                                    <div
                                        class="card-body text-body d-flex flex-column justify-content-between text-center">
                                        <div class="mb-3">
                                            {{-- <img src="{{ asset('assets/img/branding/logo diskominfo helpdesk.png') }}"
                                                alt="client logo" class="client-logo img-fluid" /> --}}
                                            <span class="client-logo img-fluid"><i
                                                    class="mdi mdi-comment mdi-24px"></i></span>
                                        </div>
                                        <p>
                                            {{ $rating->deskripsi }}
                                        </p>
                                        <div class="text-warning mb-3">
                                            @for ($i = $rating->star; $i > 0; $i--)
                                                <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                            @endfor

                                        </div>
                                        <div>
                                            <h6 class="mb-1">
                                                {{ strlen($rating->user->name) > 3
                                                    ? substr($rating->user->name, 0, 3) . str_repeat('#', strlen($rating->user->name) - 3)
                                                    : $rating->user->name }}
                                            </h6>

                                            <p class="mb-0">Masyarakat</p>
                                        </div>
                                    </div>
                                </div>
                            </divs>
                        @endforeach

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
                                class="tf-icons mdi mdi-chart-bar mdi-36px"></i></span>
                        <h2 class="fw-bold mb-1">{{ $ticketCounts['total'] }}</h2>
                        <p class="fw-medium mb-0">Total Permintaan</p>
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <span class="badge badge-center rounded-pill bg-label-hover-success fun-facts-icon mb-4"><i
                                class="tf-icons mdi mdi-check-circle-outline mdi-36px"></i></span>
                        <h2 class="fw-bold mb-1">{{ $ticketCounts['finish'] }}</h2>
                        <p class="fw-medium mb-0">Sukses</p>
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <span class="badge badge-center rounded-pill bg-label-hover-warning fun-facts-icon mb-4"><i
                                class="tf-icons mdi mdi-progress-clock mdi-36px"></i></span>
                        <h2 class="fw-bold mb-1">{{ $ticketCounts['proses'] }}</h2>
                        <p class="fw-medium mb-0">Sedang diproses</p>
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <span class="badge badge-center rounded-pill bg-label-hover-info fun-facts-icon mb-4"><i
                                class="tf-icons mdi mdi-clock-outline mdi-36px"></i></span>
                        <h2 class="fw-bold mb-1">{{ $ticketCounts['pending'] }}</h2>
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
