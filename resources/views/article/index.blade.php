<x-layout>
    
    <div class="container my-5">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h1 class="fw-bold text-dark mb-1">Tutti gli Annunci</h1>
                <p class="text-muted mb-0">Sfoglia le occasioni caricate dagli utenti del portale</p>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                @auth
                    <a href="{{ route('article.create') }}" class="btn btn-success rounded-pill fw-semibold px-4 py-2">
                        <i class="bi bi-plus-circle-fill me-1"></i> Nuovo Annuncio
                    </a>
                @endauth
            </div>
        </div>

        
        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    
                    <x-card :article="$article" />
                </div>
            @empty
               
                <div class="col-12 text-center py-5">
                    <div class="p-5 border rounded-4 bg-light shadow-sm max-width-md mx-auto">
                        <i class="bi bi-emoji-frown text-muted display-1 mb-3"></i>
                        <h3 class="fw-bold text-secondary">Nessun annuncio trovato</h3>
                        <p class="text-muted mb-4">Non sono ancora presenti annunci sulla piattaforma.</p>
                        @auth
                            <a href="{{ route('article.create') }}" class="btn btn-primary rounded-pill px-4">
                                Carica il primo annuncio!
                            </a>
                        @endauth
                    </div>
                </div>
            @endforelse
        </div>

       
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</x-layout>
