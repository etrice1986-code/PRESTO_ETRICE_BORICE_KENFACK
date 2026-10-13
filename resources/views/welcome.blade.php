<x-layout>
   
    <div class="container-fluid bg-light py-5 mb-5 shadow-sm border-bottom">
        <div class="container py-3 text-center">
            <h1 class="display-3 fw-bold text-dark mb-2">Presto.it</h1>
            <p class="lead text-muted fs-4 mb-4">Il portale degli annunci per liberarti di ciò che non ti piace più</p>
            
            
            <div class="row justify-content-center mb-3">
                <div class="col-md-6">
                    <x-flash-messages/>
                </div>
            </div>

            
            <div class="mt-2">
                <a href="{{ route('article.create') }}" class="btn btn-success btn-lg shadow px-5 py-3 fw-bold rounded-pill" style="font-size: 1.25rem;">
                    <i class="bi bi-plus-circle-fill me-2"></i> Inserisci annuncio
                </a>
            </div>
        </div>
    </div>

   
    <div class="container my-5">
        <div class="row mb-4 align-items-center">
            <div class="col-12 text-center text-md-start">
                <h2 class="fw-bold text-dark mb-1">Gli ultimi arrivi</h2>
                <p class="text-muted mb-0">Dai un'occhiata agli annunci più recenti pubblicati sulla piattaforma</p>
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
                        Vedi tutti gli annunci <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-layout>
