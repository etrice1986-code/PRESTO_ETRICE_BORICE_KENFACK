<div class="container my-5">
    <div class="row justify-content-center ">
        <div class="col-11 ">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <div>
                    <h1 class="fw-bold text-dark mb-0">{{ __('ui.revisorDashboard') }}</h1>
                    <p class="text-muted mb-0">{{ __('ui.revisorSubtitle') }}</p>
                </div>
                @if($lastEditedArticle)
                    <button wire:click="undoLastAction" class="btn btn-warning rounded-pill fw-semibold px-4 shadow-sm">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> {{ __('ui.undoAction') }}
                    </button>
                @endif
            </div>

            @if (session()->has('message'))
                <div class="alert alert-info alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                    <i class="bi bi-info-circle-fill me-2"></i> {{ session('message') }}
                </div>
            @endif

            @if($articleToReview)
                <div class="card shadow border-0 rounded-4 overflow-hidden bg-white">
                    <div class="row g-0">
                       <div class="col-md-5">

                        <div id="revisorCarousel" class="carousel slide shadow rounded-4 overflow-hidden" data-bs-ride="carousel">

                            <div class="carousel-inner" style="height: 400px;">
                                @if($articleToReview->images->count() > 0)
                                    @foreach($articleToReview->images as $key => $image)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }} h-100 w-100">
                                        <img src="{{ $image->getUrl(400, 300) }}"
                                        class="d-block w-100 h-100 object-fit-cover"
                                        alt="Foto {{ $articleToReview->title }}">

                                        </div>
                                    @endforeach
                                @else
                                    <div class="carousel-item active h-100 w-100">
                                        <img src="https://picsum.photos/seed/{{ $articleToReview->id }}/600/450"
                                            class="d-block w-100 h-100 object-fit-cover"
                                            alt="Immagine segnaposto">
                                    </div>
                                @endif
                            </div>

                            @if($articleToReview->images->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#revisorCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>

                                <button class="carousel-control-next" type="button" data-bs-target="#revisorCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            @endif

                        </div>

                    </div>

                        
                        <div class="col-md-6 p-4 d-flex flex-column justify-content-between">
                            <div>
                                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 fw-semibold mb-3">
                                    <i class="bi bi-tag-fill me-1"></i> {{ __('ui.' . $articleToReview->category->name) }}
                                </span>
                                <h2 class="fw-bold text-dark mb-1">{{ $articleToReview->title }}</h2>
                                <h3 class="fw-bold text-success mb-3">{{ number_format($articleToReview->price, 2, ',', '.') }} €</h3>
                                <hr class="text-muted">
                                <p class="text-secondary fw-semibold mb-1" style="font-size: 14px;">{{ __('ui.descriptionTitle') }}:</p>
                                <p class="text-muted lh-base mb-3" style="white-space: pre-line;">{{ $articleToReview->description }}</p>

                        <div class="p-3 bg-light border rounded-3 mb-3">
                        <h6 class="fw-bold text-dark mb-2 small text-uppercase">
                            <i class="bi bi-cpu-fill text-warning me-1"></i> Revisione IA Immagini
                        </h6>

                        @php
                        $likeliHoodName = [
                            'UNKNOWN'       => ['bg' => 'secondary', 'icon' => 'bi-circle-fill'],
                            'VERY_UNLIKELY' => ['bg' => 'success',   'icon' => 'bi-check-circle-fill'],
                            'UNLIKELY'      => ['bg' => 'success',   'icon' => 'bi-check-circle-fill'],
                            'POSSIBLE'      => ['bg' => 'warning',   'icon' => 'bi-exclamation-circle-fill'],
                            'LIKELY'        => ['bg' => 'warning',   'icon' => 'bi-exclamation-circle-fill'],
                            'VERY_LIKELY'   => ['bg' => 'danger',    'icon' => 'bi-dash-circle-fill'],
                        ];
                       @endphp

                    @if($articleToReview->images && $articleToReview->images->count() > 0)
                        @foreach($articleToReview->images as $index => $img)
                            <div class="mb-2 {{ !$loop->last ? 'border-bottom pb-2' : '' }}">  
                             <p class="text-secondary fw-bold mb-1 small">Img #{{ $index + 1 }}</p>

                     <div class="d-flex flex-wrap gap-2 mb-2">
                    <span class="badge px-3 py-1 bg-{{ $likeliHoodName[$img->adult]['bg'] }} text-white rounded-pill d-flex align-items-center gap-2" style="font-size: 0.85rem;">
                        <i class="bi {{ $likeliHoodName[$img->adult]['icon'] }}" style="font-size: 1.3rem;"></i>
                        Adulti
                    </span>

                    <span class="badge px-3 py-1 bg-{{ $likeliHoodName[$img->spoof]['bg'] }} text-white rounded-pill d-flex align-items-center gap-2" style="font-size: 0.85rem;">
                        <i class="bi {{ $likeliHoodName[$img->spoof]['icon'] }}" style="font-size: 1.3rem;"></i>
                        Satira
                    </span>

                    <span class="badge px-3 py-1 bg-{{ $likeliHoodName[$img->medical]['bg'] }} text-white rounded-pill d-flex align-items-center gap-2" style="font-size: 0.85rem;">
                        <i class="bi {{ $likeliHoodName[$img->medical]['icon'] }}" style="font-size: 1.3rem;"></i>
                        Medicina
                    </span>

                    <span class="badge px-3 py-1 bg-{{ $likeliHoodName[$img->violence]['bg'] }} text-white rounded-pill d-flex align-items-center gap-2" style="font-size: 0.85rem;">
                        <i class="bi {{ $likeliHoodName[$img->violence]['icon'] }}" style="font-size: 1.3rem;"></i>
                        Violenza
                    </span>

                    <span class="badge px-3 py-1 bg-{{ $likeliHoodName[$img->racy]['bg'] }} text-white rounded-pill d-flex align-items-center gap-2" style="font-size: 0.85rem;">
                        <i class="bi {{ $likeliHoodName[$img->racy]['icon'] }}" style="font-size: 1.3rem;"></i>
                        Racy
                    </span>
                </div>

                @if($img->labels)
                    <div class="d-flex flex-wrap gap-1">
                        @foreach($img->labels as $label)
                            <span class="badge bg-secondary text-white rounded-pill px-1.5 py-0.5" style="font-size: 0.6rem;">
                                {{ $label }}
                            </span>
                        @endforeach
                    </div>
                @endif

             </div>
              @endforeach
                @else
                    <p class="text-muted small fst-italic mb-0">
                        Nessuna immagine associata a questo annuncio. Controllo IA non necessario.
                    </p>
             @endif
            </div>

                            </div>

                            <div class="p-3 bg-light rounded-3 border mb-4 mt-2">
                                <p class="mb-0 small text-muted"><i class="bi bi-person-fill me-1"></i> {{ __('ui.publishedBy') }} <strong>{{ $articleToReview->user->name }}</strong></p>
                                <p class="mb-0 small text-muted"><i class="bi bi-calendar-event me-1"></i> {{ __('ui.publishedOn') }}: {{ $articleToReview->created_at->format('d/m/Y H:i') }}</p>
                            </div>

                            <div class="row g-3">
                                <div class="col-6">
                                    <button wire:click="rejectArticle({{ $articleToReview->id }})" class="btn btn-danger btn-lg w-100 rounded-pill fw-bold shadow-sm"><i class="bi bi-x-circle me-2"></i> {{ __('ui.reject') }}</button>
                                </div>
                                <div class="col-6">
                                    <button wire:click="acceptArticle({{ $articleToReview->id }})" class="btn btn-success btn-lg w-100 rounded-pill fw-bold shadow-sm"><i class="bi bi-check-circle me-2"></i> {{ __('ui.accept') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="p-5 border rounded-4 bg-light shadow-sm max-width-md mx-auto" style="max-width: 550px;">
                        <i class="bi bi-check-all text-success display-1 mb-3"></i>
                        <h3 class="fw-bold text-secondary">{{ __('ui.revisorDashboard') }}</h3>
                        <p class="text-muted mb-0">{{ __('ui.noArticlesToReview') }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
