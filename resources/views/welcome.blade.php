<x-layout>
   
    <div class="container-fluid bg-light py-5 mb-5 shadow-sm border-bottom">
        <div class="container py-3 text-center">
            <h1 class="display-3 fw-bold text-dark mb-2">{{ __('ui.welcomeTitle') }}</h1>
           
            <p class="lead text-muted fs-4 mb-4">{{ __('ui.welcomeSubtitle') }}</p>

            
            
            <div class="row justify-content-center mb-3">
                <div class="col-md-6">
                    
                    
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3 py-3 mb-3 text-start" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-2 fs-5 text-success"></i>
                                <div>
                                    {{ session('message') }}
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    
                    @if (session()->has('access_denied'))
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-3 py-3 mb-3 text-start" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle-fill me-2 fs-5 text-danger"></i>
                                <div>
                                    {{ session('access_denied') }}
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <x-flash-messages/>
                </div>
            </div>

            
            <div class="mt-2">
                <a href="{{ route('article.create') }}" class="btn btn-success btn-lg shadow px-5 py-3 fw-bold rounded-pill" style="font-size: 1.25rem;">
                    <i class="bi bi-plus-circle-fill me-2"></i> {{ __('ui.insertAnnouncement') }}
                </a>
            </div>
        </div>
    </div>

   
    <div class="container my-5">
        <div class="row mb-4 align-items-center">
            <div class="col-12 text-center text-md-start">
                <h2 class="fw-bold text-dark mb-1">{{ __('ui.latestAnnouncements') }}</h2>
                <p class="text-muted mb-0">{{ __('ui.latestAnnouncementsSubtitle') }}</p>

            </div>
        </div>

        
        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                    
                    <x-card :article="$article" />
                </div>
            @empty
                
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">Nessun annuncio disponibile al momento.</p>
                </div>
            @endforelse
        </div>

        
        @if($articles->count() > 0)
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ route('article.index') }}" class="btn btn-outline-primary btn-lg rounded-pill px-5 fw-semibold">
                       {{ __('ui.allAnnouncements') }} <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-layout>
