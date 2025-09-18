@extends('layouts/layoutMaster')

@section('title', 'Help Center Landing - Front Pages')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-help-center.css') }}" />
@endsection
@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />
@endsection

@section('page-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#basic-addon1').on('click', function() {
                var ticketNumber = $('#ticketNumber').val();

                // Tampilkan loading bar
                $('#ticketDetailsCard').hide();

                $('#loadingBar').show();

                // Lakukan fetch data dari route menggunakan AJAX
                $.ajax({
                    url: '/cari-tiket/' + ticketNumber, // Ganti dengan URL rute yang sesuai
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Sembunyikan loading bar setelah selesai fetching
                        setTimeout(function() {
                            $('#loadingBar').hide();

                            var ticketDetails = $('.ticket-details');
                            ticketDetails.empty(); // Kosongkan data sebelumnya
                            $('#ticketDetailsCard').show();

                            if (data) {
                                ticketDetails.append('<h6>Nomor Tiket: ' +
                                    data.nomor_tiket +
                                    '</h6>');

                                ticketDetails.append('<h6>Status: ' + data.status +
                                    '</h6>');
                                ticketDetails.append('<h6>Deskripsi: ' + data
                                    .answer_status +
                                    '</h6>');
                                // Tambahkan data lain yang ingin ditampilkan
                            } else {

                                ticketDetails.append(
                                    '<h4>Data tiket tidak ditemukan </h4>' +
                                    ' <p class="text-warning">Nomor tiket yang anda masukkan salah atau belum lengkap, silahkan coba lagi </p> '
                                );
                            }
                        }, 1000);
                        // Tampilkan data hasil fetch di sini
                        // Contoh: Tampilkan data ke konsol
                        // Lengkapi dengan logika untuk menampilkan data ke halaman
                    },
                    error: function(xhr, status, error) {
                        // Handle error jika terjadi
                        console.error(xhr.responseText);
                        // Sembunyikan loading bar jika ada error
                        $('#loadingBar').hide();
                    }
                });
            });
        });
    </script>
@endsection

@section('content')

    <!-- Help Center Header: Start -->
    <section class="section-py first-section-pt help-center-header">
        <h1 class="text-center text-primary display-6 fw-semibold">Nomor Tiket Pengajuan</h1>
        <div class="input-wrapper my-3 input-group input-group-lg input-group-merge position-relative mx-auto">
            <span class="btn btn-primary  input-group-text" id="basic-addon1"><i class="tf-icons  mdi mdi-magnify"></i></span>
            <input type="text" id="ticketNumber" class="form-control mr-2" style="padding-left:7px !important;"
                placeholder=" Nomor tiket pengajuan" aria-label="Search" aria-describedby="basic-addon1" />
        </div>
        <p class="text-center px-3 mb-0">Silahkan masukan nomor tiket pengajuan anda</p>



        <div id="loadingBar" style="display: none;" class="sk-swing sk-primary   mx-auto">
            <div class="sk-swing-dot"></div>
            <div class="sk-swing-dot"></div>
        </div>


        <div class="col-md-4 mt-2 mx-auto " style="display: none" id="ticketDetailsCard">
            <div class="card border shadow-none">
                <div class="card-body text-center">
                    <svg width='58' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" aria-labelledby="title"
                        aria-describedby="desc" role="img" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path data-name="layer2"
                            d="M55 18.7A6.9 6.9 0 0 1 45.3 9l-7-7L2 38.3l7 7a6.9 6.9 0 0 1 9.7 9.7l7 7L62 25.7z"
                            fill="none" stroke="#202020" stroke-miterlimit="10" stroke-width="2" stroke-linejoin="round"
                            stroke-linecap="round"></path>
                        <path data-name="layer1"
                            d="M30.6 46a3 3 0 0 1-4.2 0L18 37.6a3 3 0 0 1 0-4.2L33.4 18a3 3 0 0 1 4.2 0l8.4 8.4a3 3 0 0 1 0 4.2z"
                            fill="none" stroke="#202020" stroke-miterlimit="10" stroke-width="2" stroke-linejoin="round"
                            stroke-linecap="round"></path>
                    </svg>

                    <h5 class="my-3">Progres Permintaan</h5>

                    <div class="ticket-details">
                        <!-- Placeholder for ticket details from AJAX -->
                    </div>


                    <p> untuk melihat lebih detail silahkan login</p>
                    <a class="btn btn-outline-primary" href="{{ url('/login') }}">Login</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Help Center Header: End -->

    <!-- Popular Articles: Start -->

    <!-- Popular Articles: End -->

    <!-- Knowledge Base: Start -->
    <section class="section-py bg-body">
        <div class="container">
            <h4 class="display-6 text-center mb-4 pb-md-2">Daftar Layanan dan Bantuan</h4>
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="row">
                        <div class="col-md-6 col-ms-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-label-primary p-2 rounded me-2"><i
                                                class="tf-icons mdi  mdi-room-service-outline mdi-20px"></i></span>
                                        <h5 class="mb-0 ms-1">Layanan</h5>
                                    </div>
                                    <ul class="list-unstyled my-4">
                                        @foreach ($menus_list as $menu)
                                            <li class="mb-2">
                                                <a href="{{ url('/app/layanan/' . $menu->slug) }}"
                                                    class="text-heading d-flex justify-content-between align-items-center">
                                                    <span
                                                        style="text-overflow: clip; word-wrap:normal;
                                                     white-space: normal;
                                                    "
                                                        class="text-truncate me-1 ">
                                                        {{ $menu->nama_layanan }}
                                                    </span>
                                                    <i
                                                        class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                                </a>
                                                <hr>
                                            </li>
                                        @endforeach

                                    </ul>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-ms-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-label-primary p-2 rounded me-2"><i
                                                class="tf-icons mdi mdi-toolbox-outline mdi-20px"></i></span>
                                        <h5 class="mb-0 ms-1">Syarat Layanan</h5>
                                    </div>
                                    <ul class="list-unstyled my-4">
                                        @foreach ($menus_list as $menu)
                                            <li class="mb-2">
                                                <a href="{{ url('/syarat-layanan/' . $menu->slug) }}"
                                                    class="text-heading d-flex justify-content-between align-items-center">
                                                    <span
                                                        style="text-overflow: clip; word-wrap:normal;
                                                    white-space: normal;
                                                   "
                                                        class="text-truncate me-1">
                                                        {{ $menu->nama_layanan }}
                                                    </span>
                                                    <i
                                                        class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                                </a>
                                                <hr>

                                            </li>
                                        @endforeach

                                    </ul>

                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-4 col-ms-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-label-primary p-2 rounded me-2"><i
                                                class="tf-icons mdi mdi-face-agent mdi-20px"></i></span>
                                        <h5 class="mb-0 ms-1">Cara Penggunaan</h5>
                                    </div>
                                    <ul class="list-unstyled my-4">
                                        @foreach ($menus_list as $menu)
                                            <li class="mb-2">
                                                <a href="{{ url('/bantuan-layanan/' . $menu->slug) }}"
                                                    class="text-heading d-flex justify-content-between align-items-center">
                                                    <span
                                                        style="text-overflow: clip; word-wrap:normal;
                                                    white-space: normal;
                                                   "
                                                        class="text-truncate me-1">
                                                        {{ $menu->nama_layanan }}
                                                    </span>
                                                    <i
                                                        class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                                </a>
                                                <hr>

                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-4 col-ms-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-label-primary p-2 rounded me-2"><i
                                                class="tf-icons mdi mdi-format-color-fill mdi-20px"></i></span>
                                        <h5 class="mb-0 ms-1">Template Kits</h5>
                                    </div>
                                    <ul class="list-unstyled my-4">
                                        <li class="mb-2">
                                            <a href="{{ url('front-pages/help-center-article') }}"
                                                class="text-heading d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-1">
                                                    Template Kits
                                                </span>
                                                <i
                                                    class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="{{ url('front-pages/help-center-article') }}"
                                                class="text-heading d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-1">
                                                    Elementor Template Kits: PHP Zip File Missing
                                                </span>
                                                <i
                                                    class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="{{ url('front-pages/help-center-article') }}"
                                                class="text-heading d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-1">
                                                    Template Kits - Imported template is blank or broken
                                                </span>
                                                <i
                                                    class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="{{ url('front-pages/help-center-article') }}"
                                                class="text-heading d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-1">
                                                    Troubleshooting Import Problems
                                                </span>
                                                <i
                                                    class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="{{ url('front-pages/help-center-article') }}"
                                                class="text-heading d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-1">
                                                    How to use the WordPress Plugin
                                                </span>
                                                <i
                                                    class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('front-pages/help-center-article') }}"
                                                class="text-heading d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-1">
                                                    How to use the Template Kit Importer Plugin
                                                </span>
                                                <i
                                                    class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <p class="mb-0 fw-medium mt-4">
                                        <a href="{{ url('front-pages/help-center-article') }}"
                                            class="d-flex align-items-center">
                                            <span class="me-2">See all 5 articles</span>
                                            <i class="tf-icons mdi mdi-arrow-right scaleX-n1-rtl"></i>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-4 col-ms-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-label-primary p-2 rounded me-2"><i
                                                class="tf-icons mdi mdi-lock-open-outline mdi-20px"></i></span>
                                        <h5 class="mb-0 ms-1">Account & Password</h5>
                                    </div>
                                    <ul class="list-unstyled my-4">
                                        <li class="mb-2">
                                            <a href="{{ url('front-pages/help-center-article') }}"
                                                class="text-heading d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-1">
                                                    Signing in with a social account
                                                </span>
                                                <i
                                                    class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="{{ url('front-pages/help-center-article') }}"
                                                class="text-heading d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-1">
                                                    Locked Out of Account
                                                </span>
                                                <i
                                                    class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="{{ url('front-pages/help-center-article') }}"
                                                class="text-heading d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-1">
                                                    I'm not receiving the verification email
                                                </span>
                                                <i
                                                    class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="{{ url('front-pages/help-center-article') }}"
                                                class="text-heading d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-1">
                                                    Forgotten Username Or Password
                                                </span>
                                                <i
                                                    class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="{{ url('front-pages/help-center-article') }}"
                                                class="text-heading d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-1">
                                                    New password not accepted
                                                </span>
                                                <i
                                                    class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('front-pages/help-center-article') }}"
                                                class="text-heading d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-1">
                                                    What is Sign In Verification?
                                                </span>
                                                <i
                                                    class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <p class="mb-0 fw-medium mt-4">
                                        <a href="{{ url('front-pages/help-center-article') }}"
                                            class="d-flex align-items-center">
                                            <span class="me-2">See all 16 articles</span>
                                            <i class="tf-icons mdi mdi-arrow-right scaleX-n1-rtl"></i>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-4 col-ms-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-label-primary p-2 rounded me-2"><i
                                                class="tf-icons mdi mdi-account-outline mdi-20px"></i></span>
                                        <h5 class="mb-0 ms-1">Account Settings</h5>
                                    </div>
                                    <ul class="list-unstyled my-4">
                                        <li class="mb-2">
                                            <a href="{{ url('front-pages/help-center-article') }}"
                                                class="text-heading d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-1">
                                                    How do I change my password?
                                                </span>
                                                <i
                                                    class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="{{ url('front-pages/help-center-article') }}"
                                                class="text-heading d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-1">
                                                    How do I change my username?
                                                </span>
                                                <i
                                                    class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="{{ url('front-pages/help-center-article') }}"
                                                class="text-heading d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-1">
                                                    How do I close my account?
                                                </span>
                                                <i
                                                    class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="{{ url('front-pages/help-center-article') }}"
                                                class="text-heading d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-1">
                                                    How do I change my email address?
                                                </span>
                                                <i
                                                    class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="{{ url('front-pages/help-center-article') }}"
                                                class="text-heading d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-1">
                                                    How can I regain access to my account?
                                                </span>
                                                <i
                                                    class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('front-pages/help-center-article') }}"
                                                class="text-heading d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-1">
                                                    Are RSS feeds available on Market?
                                                </span>
                                                <i
                                                    class="tf-icons mdi mdi-chevron-right mdi-24px scaleX-n1-rtl text-muted"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <p class="mb-0 fw-medium mt-4">
                                        <a href="{{ url('front-pages/help-center-article') }}"
                                            class="d-flex align-items-center">
                                            <span class="me-2">See all 12 articles</span>
                                            <i class="tf-icons mdi mdi-arrow-right scaleX-n1-rtl"></i>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Knowledge Base: End -->


    <!-- Help Area: Start -->
    <section class="section-py bg-body">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 text-center">
                    <h4 class="display-6">Masih butuh bantuan ?</h4>
                    <p>Silahkan hubungi Dinas Kesehatan Kota Medan atau klik tombol dibawah
                        untuk informasi lebih lanjut</p>
                    <div class="d-flex justify-content-center flex-wrap gap-3">

                        <a href="https://helpdesksdkdinkeskotamedan.pemkomedan.go.id/" class="btn btn-primary">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Help Area: End -->
@endsection
