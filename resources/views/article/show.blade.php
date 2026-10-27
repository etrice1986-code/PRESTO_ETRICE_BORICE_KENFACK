<x-layout>
    <div class="container my-5">

        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('article.index') }}" class="btn btn-light rounded-pill fw-semibold text-muted shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> {{ __('ui.backToAll') }}
                </a>
            </div>
        </div>

        <div class="row g-5">

            
            <div class="col-12 col-md-6">

                <div id="articleCarousel" class="carousel slide shadow rounded-4 overflow-hidden" data-bs-ride="carousel">

                    @if($article->images->count() > 1)
                        <div class="carousel-indicators">
                            @foreach($article->images as $key => $image)
                                <button type="button"
                                        data-bs-target="#articleCarousel"
                                        data-bs-slide-to="{{ $key }}"
                                        class="{{ $key == 0 ? 'active' : '' }}"
                                        aria-label="Slide {{ $key + 1 }}">
                                </button>
                            @endforeach
                        </div>
                    @endif

                     <div class="carousel-inner" style="height: 400px;">

                        @if($article->images->count() > 0)
                            @foreach($article->images as $key => $image)
                                
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }} h-100 w-100">
                                                                    
                                <img src="{{ $image->getUrl(600, 400) }}"
                                    class="d-block w-100 h-100 object-fit-cover"
                                    alt="Foto {{ $article->title }}">

                                </div>
                            @endforeach

                        @else
                            
                            <div class="carousel-item active h-100 w-100">
                                <img src="https://picsum.photos/seed/{{ $article->id }}/600/450"
                                     class="d-block w-100 h-100 object-fit-cover"
                                     alt="Immagine segnaposto">
                            </div>
                        @endif

                    </div>


                    
                    @if($article->images->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#articleCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#articleCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    @endif

                </div>

            </div>

         
            <div class="col-12 col-md-6 d-flex flex-column justify-content-between">

                <div>
                  
                    <span class="badge bg-primary-subtle text-primary rounded-pill align-self-start mb-2 px-3 py-1" style="font-size: 12px; font-weight: 600;">
                        <a href="{{ route('category.show', $article->category) }}" class="text-decoration-none text-primary">
                            {{ __("ui." . $article->category->name) }}
                        </a>
                    </span>

                    
                    <h1 class="fw-bold text-dark display-5 mb-2">{{ $article->title }}</h1>

                    
                    <h2 class="fw-bold text-success display-6 mb-4">
                        {{ number_format($article->price, 2, ',', '.') }} €
                    </h2>

                    <hr class="text-muted mb-4">

                   
                    <h5 class="fw-bold text-secondary mb-2">{{ __('ui.descriptionTitle') }}</h5>
                    <p class="text-muted fs-5 lh-base" style="white-space: pre-line;">
                        {{ $article->description }}
                    </p>
                </div>

                
                <div class="p-3 bg-light rounded-4 border mt-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold text-uppercase"
                             style="width: 45px; height: 45px; font-size: 16px;">
                            {{ substr($article->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="mb-0 fw-bold text-dark">{{ __('ui.publishedBy') }} {{ $article->user->name }}</p>
                            <p class="mb-0 text-muted small">{{ __('ui.publishedOn') }} {{ $article->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-layout>
