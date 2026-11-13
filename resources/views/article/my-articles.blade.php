<x-layout>
    <div class="container my-5">
        
        
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center border-b pb-3 mb-4 gap-3">
            <div>
                <h1 class="fw-bold text-dark m-0">I miei annunci</h1>
                <p class="text-muted small m-0 mt-1">Gestisci tutti gli articoli che hai pubblicato sulla piattaforma.</p>
            </div>
            <a href="{{ route('article.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-lg"></i> Crea nuovo annuncio
            </a>
        </div>

        <!--  Successo -->
        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        
            
        @if($articles->count() > 0)
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach($articles as $article)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            
                            
                            <div class="bg-body-secondary d-flex align-items-center justify-content-center border-bottom text-secondary overflow-hidden w-100" style="height: 180px;">
                               @if($article->images && $article->images->count() > 0)
                                @php
                                    $firstImage = $article->images->first();
                                @endphp
                               
                                <img src="{{ $firstImage->getUrl(300, 300) }}"
                                    class="card-img-top object-fit-cover w-100"
                                    style="height: 220px;" 
                                    alt="Immagine articolo">
                                @else   
                                    <div class="text-center">
                                        <i class="bi bi-image" style="font-size: 2.5rem;"></i>
                                        <p class="small text-muted m-0">Nessuna foto</p>
                                    </div>
                                @endif
                            

                    


                            <!-- Contenuto Card -->
                            <div class="card-body d-flex flex-column p-3">
                                <!-- Categoria e Stato -->
                                <div class="d-flex justify-content-between align-items-center mb-2 gap-2">
                                    <span class="badge bg-light text-secondary border">
                                        {{ $article->category->name ?? 'Nessuna categoria' }}
                                    </span>
                                    
                                    @if($article->is_accepted)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle">
                                            Pubblicato
                                        </span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">
                                            In revisione
                                        </span>
                                    @endif
                                </div>

                                <!-- Titolo e Prezzo -->
                                <h5 class="card-title fw-bold text-truncate mb-1">
                                    <a href="{{ route('article.show', $article) }}" class="text-decoration-none text-dark">
                                        {{ $article->title }}
                                    </a>
                                </h5>
                                <p class="card-text fs-4 fw-semibold text-dark mb-2">
                                    € {{ number_format($article->price, 2, ',', '.') }}
                                </p>

                                <!-- Descrizione Breve -->
                                <p class="card-text text-muted small flex-grow-1 text-clamp-2">
                                    {{ $article->description }}
                                </p>

                                <!-- Data di Creazione -->
                                <p class="card-text text-body-secondary small mb-3" style="font-size: 0.75rem;">
                                    Creato il: {{ $article->created_at->format('d/m/Y') }}
                                </p>

                              
                                <div class="d-flex gap-2 border-top pt-2 mt-auto">
                                    <!-- Modifica -->
                                    <a href="{{ route('article.edit', $article) }}" class="btn btn-outline-warning btn-sm flex-grow-1">
                                        Modifica
                                    </a>

                                    <!-- Elimina -->
                                    <form action="{{ route('article.destroy', $article) }}" method="POST" class="flex-grow-1 "
                                          onsubmit="return confirm('Sei sicuro di voler eliminare definitivamente questo annuncio?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                            Elimina
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
           
            <div class="text-center py-5 border rounded bg-white shadow-sm">
                <i class="bi bi-card-list text-secondary" style="font-size: 3rem;"></i>
                <h3 class="mt-3 fw-bold text-dark">Nessun annuncio presente</h3>
                <p class="text-muted">Non hai ancora inserito nessun articolo in vendita.</p>
                <a href="{{ route('article.create') }}" class="btn btn-primary mt-2">
                    Inserisci il tuo primo articolo
                </a>
            </div>
        @endif

    </div>

    
    <style>
        .text-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;  
            overflow: hidden;
        }
    </style>
</x-layout>
