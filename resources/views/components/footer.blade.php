<footer class="bg-dark text-white mt-5">
    <div class="container py-4">

        <div class="row">

            <div class="col-md-4 mb-4 mb-md-0">
                <h5 class="fw-bold">Presto.it</h5>
                <p class="small text-white-50 mb-0">
                    La piattaforma per comprare e vendere in modo semplice e sicuro.
                </p>
            </div>

            <div class="col-md-4 mb-4 mb-md-0">
                <h6 class="fw-semibold">Link Utili</h6>
                <ul class="list-unstyled">
                    <li>
                        <a href="{{ route('home') }}" class="text-white-50 text-decoration-none">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('article.index') }}" class="text-white-50 text-decoration-none">
                            Annunci
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('careers') }}" class="text-white-50 text-decoration-none">
                            Lavora con noi
                        </a>
                    </li>

                    <li>
                    <a href="{{ route('contact.us') }}" class="text-white-50 text-decoration-none hover-link">
                        Contattaci
                    </a>
                </li>


                    <!-- Chi Siamo -->
                    <li>
                        <a href="{{ route('about.us') }}" class="text-white-50 text-decoration-none hover-link">
                            {{ __('ui.aboutUs') !== 'ui.aboutUs' ? __('ui.aboutUs') : 'Chi siamo' }}
                        </a>
                    </li>

                </ul>
            </div>

            <div class="col-md-4">
                <h6 class="fw-semibold">Seguici</h6>

                <div class="d-flex gap-3 fs-4">
                    <a href="#" class="text-white">
                        <i class="bi bi-facebook"></i>
                    </a>

                    <a href="#" class="text-white">
                        <i class="bi bi-instagram"></i>
                    </a>

                    <a href="#" class="text-white">
                        <i class="bi bi-linkedin"></i>
                    </a>

                    <a href="https://github.com/etrice1986-code/PRESTO_ETRICE_BORICE_KENFACK" class="text-white">
                        <i class="bi bi-github"></i>
                    </a>
                </div>
            </div>

        </div>

        <hr class="border-secondary my-4">

        <div class="text-center small text-white-50">
            © {{ date('Y') }} Presto.it - Realizzato da Etrice Kenfack
        </div>

    </div>
</footer>
