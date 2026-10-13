<x-layout>
    <div class="container my-5">
       
        <div class="row mb-5 align-items-center border-bottom pb-4">
            <div class="col-md-8">
                <span class="text-uppercase text-primary fw-bold small tracking-wider">Esplora la categoria</span>
                <h1 class="fw-bold text-dark display-4 mt-1">
                    <i class="bi bi-tag-fill text-primary me-2"></i>{{ $category->name }}
                </h1>
                <p class="text-muted mb-0">
                    Sono presenti <strong>{{ $articles->count() }}</strong> {{ $articles->count() == 1 ? 'annuncio' : 'annunci' }} per questa categoria.
                </p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('article.index') }}" class="btn btn-outline-secondary rounded-pill fw-semibold px-4">
                    <i class="bi bi-grid-fill me-1"></i> Tutti gli annunci
                </a>
            </div>
        </div>

        
        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    
                    <x-card :article="$article" />
                </div>
            @empty
               
                <div class="col-12 text-center py-5">
                    <div class="p-5 border rounded-4 bg-light shadow-sm max-width-md mx-auto" style="max-width: 500px;">
                        <i class="bi bi-folder-x text-muted display-1 mb-3"></i>
                        <h3 class="fw-bold text-secondary">Categoria vuota</h3>
                        <p class="text-muted mb-4">Non sono ancora stati pubblicati annunci in questa categoria.</p>
                        @auth
                            <a href="{{ route('article.create') }}" class="btn btn-success rounded-pill px-4 fw-semibold">
                                Sii il primo, pubblica un annuncio!
                            </a>
                        @endauth
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
