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
                <div id="carouselExampleIndicators" class="carousel slide shadow rounded-4 overflow-hidden" data-bs-ride="carousel">
                    
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    
                    
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://picsum.photos/seed/{{ $article->id + 10 }}/600/450"
                            class="d-block w-100 object-fit-cover"
                            style="height: 400px;"
                            alt="Foto segnaposto 1">

                        </div>
                        <div class="carousel-item">
                            <img src="https://picsum.photos/seed/{{ $article->id + 20 }}/600/450"
                        class="d-block w-100 object-fit-cover"
                        style="height: 400px;"
                        alt="Foto segnaposto 2">
                        </div>
                        <div class="carousel-item">
                            <img src="https://picsum.photos/seed/{{ $article->id + 30 }}/600/450"
                            class="d-block w-100 object-fit-cover"
                            style="height: 400px;"
                            alt="Foto segnaposto 3">
                        </div>
                    </div>
                    
                   
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Precedente</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Successivo</span>
                    </button>
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
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold text-uppercase" style="width: 45px; height: 45px; font-size: 16px;">
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
