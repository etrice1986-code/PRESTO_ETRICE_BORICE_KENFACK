<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12">
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
                
                <div class="row g-5">
                    
                    
                    <div class="col-12 col-md-6">
                        <div id="revisorCarousel" class="carousel slide shadow rounded-4 overflow-hidden" data-bs-ride="carousel">
                            
                            @if($articleToReview->images->count() > 1)
                                <div class="carousel-indicators">
                                    @foreach($articleToReview->images as $key => $image)
                                        <button type="button"
                                                data-bs-target="#revisorCarousel"
                                                data-bs-slide-to="{{ $key }}"
                                                class="{{ $key == 0 ? 'active' : '' }}"
                                                aria-label="Slide {{ $key + 1 }}">
                                        </button>
                                    @endforeach
                                </div>
                            @endif

                            <div class="carousel-inner" style="height: 400px;">
                                @if($articleToReview->images->count() > 0)
                                    @foreach($articleToReview->images as $key => $image)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }} h-100 w-100">
                                            <img src="{{ $image->getUrl(600, 400) }}"
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

                   
                    <div class="col-12 col-md-6 d-flex flex-column justify-content-between">
                        <div>
                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 fw-semibold mb-3">
                                <i class="bi bi-tag-fill me-1"></i> {{ __('ui.' . $articleToReview->category->name) }}
                            </span>
                            <h2 class="fw-bold text-dark mb-1">{{ $articleToReview->title }}</h2>
                            <h3 class="fw-bold text-success mb-3">{{ number_format($articleToReview->price, 2, ',', '.') }} €</h3>
                            
                            <hr class="text-muted mb-4">
                            
                            <p class="text-secondary fw-semibold mb-1" style="font-size: 14px;">{{ __('ui.descriptionTitle') }}:</p>
                            <p class="text-muted lh-base mb-4" style="white-space: pre-line;">{{ $articleToReview->description }}</p>

                           
                            <div class="p-3 bg-light border rounded-3 mb-3">
                                <h6 class="fw-bold text-dark mb-2 small text-uppercase">
                                    <i class="bi bi-cpu-fill text-warning me-1"></i> Revisione IA Immagini
                                </h6>

                                @if($articleToReview->images && $articleToReview->images->count() > 0)
                                    @foreach($articleToReview->images as $index => $img)
                                        <div class="mb-2 {{ !$loop->last ? 'border-bottom pb-2' : '' }}">  
                                            <p class="text-secondary fw-bold mb-1 small">Img #{{ $index + 1 }}</p>

                                            <x-image-review-badges :img="$img" />

                                            @if($img->labels)
                                                <div class="d-flex flex-wrap gap-1 mt-2">
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
                                        Nessuna immagine disponibile per la revisione IA.
                                    </p>
                                @endif
                            </div>
                        </div>

                        
                        <div class="p-3 bg-light rounded-4 border mb-4 mt-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold text-uppercase"
                                     style="width: 45px; height: 45px; font-size: 16px;">
                                    {{ substr($articleToReview->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold text-dark">{{ __('ui.publishedBy') }} {{ $articleToReview->user->name }}</p>
                                    <p class="mb-0 text-muted small">{{ __('ui.publishedOn') }} {{ $articleToReview->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        
                        <div class="row g-3">
                            <div class="col-6">
                                <button wire:click="rejectArticle({{ $articleToReview->id }})" class="btn btn-danger btn-lg w-100 rounded-pill fw-bold shadow-sm">
                                    <i class="bi bi-x-circle me-2"></i> {{ __('ui.reject') }}
                                </button>
                            </div>
                            <div class="col-6">
                                <button wire:click="acceptArticle({{ $articleToReview->id }})" class="btn btn-success btn-lg w-100 rounded-pill fw-bold shadow-sm">
                                    <i class="bi bi-check-circle me-2"></i> {{ __('ui.accept') }}
                                </button>
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
