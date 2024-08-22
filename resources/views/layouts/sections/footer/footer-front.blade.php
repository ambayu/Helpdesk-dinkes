<!-- Footer: Start -->
<footer class="landing-footer">
    <div class="footer-top">
        <div class="container">
            <div class="row gx-0 gy-4 g-md-5">
                <div class="col-lg-5">
                    <a href="javascript:;" class="app-brand-link mb-4">
                        <span class="app-brand-logo demo me-2">@include('_partials.macros', ['width' => 25, 'withbg' => 'var(--bs-primary)'])</span>
                        <span
                            class="app-brand-text demo footer-link fw-bold">{{ config('variables.templateName') }}</span>
                    </a>
                    <p class="footer-text footer-logo-description mb-4">
                        Helpdesk Dinas Kominfo Kota Medan adalah layanan yang disediakan oleh Dinas Komunikasi dan
                        Informatika Kota Medan untuk membantu masyarakat dalam mengatasi berbagai masalah terkait dengan
                        teknologi informasi dan komunikasi
                    </p>
                    {{-- <form>
                        <div class="d-flex mt-2 gap-3">
                            <div class="form-floating form-floating-outline w-px-250">
                                <input type="text" class="form-control bg-transparent text-white" id="newsletter-1"
                                    placeholder="Your email" />
                                <label for="newsletter-1">Subscribe to newsletter</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Subscribe</button>
                        </div>
                    </form> --}}
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <h6 class="footer-title mb-4">layanan</h6>
                    <ul class="list-unstyled mb-0">

                        @foreach ($menus as $menu)
                            <li class="mb-3">
                                <a href="{{ url('layanan/' . $menu->slug) }}"
                                    class="footer-link">{{ $menu->nama_layanan }}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <h6 class="footer-title mb-4">Pages</h6>
                    <ul class="list-unstyled mb-0">

                        <li class="mb-3">
                            <a href="/" class="footer-link">Home</a>
                        </li>
                        <li class="mb-3">
                            <a href="/front-pages/help-center" class="footer-link">Cek Status Permintaan</a>
                        </li>
                        <li>
                            <a href="/login" class="footer-link">Login</a>
                        </li>
                    </ul>
                </div>
                {{-- <div class="col-lg-3 col-md-4">
                    <h6 class="footer-title mb-4">Download our app</h6>
                    <a href="javascript:void(0);" class="d-block footer-link mb-3 pb-2"><img
                            src="{{ asset('assets/img/front-pages/landing-page/apple-icon.png') }}"
                            alt="apple icon" /></a>
                    <a href="javascript:void(0);" class="d-block footer-link"><img
                            src="{{ asset('assets/img/front-pages/landing-page/google-play-icon.png') }}"
                            alt="google play icon" /></a>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="footer-bottom py-3">
        <div
            class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
            <div class="mb-2 mb-md-0">
                <span class="footer-text">©
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    , Made with <i class="tf-icons mdi mdi-heart text-danger"></i> by Dinas Komunikasi dan Informatika
                    Pemerintah
                    Kota Medan
                </span>
                {{-- <a href="{{ config('variables.creatorUrl') }}" target="_blank"
                    class="footer-link fw-medium footer-theme-link">{{ config('variables.creatorName') }}</a> --}}


            </div>
            <div>
                <a href="{{ config('variables.githubUrl') }}" class="footer-link me-2" target="_blank"><i
                        class="mdi mdi-github"></i></a>
                <a href="{{ config('variables.facebookUrl') }}" class="footer-link me-2" target="_blank"><i
                        class="mdi mdi-facebook"></i></a>
                <a href="{{ config('variables.twitterUrl') }}" class="footer-link me-2" target="_blank"><i
                        class="mdi mdi-twitter"></i></a>
                <a href="{{ config('variables.instagramUrl') }}" class="footer-link" target="_blank"><i
                        class='mdi mdi-instagram'></i></a>
            </div>
        </div>
    </div>
</footer>
<!-- Footer: End -->
