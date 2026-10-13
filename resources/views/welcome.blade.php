<x-layout>
    <div class="container-fluid heightCustom d-flex flex-column justify-content-center align-items-center" style="min-height: 70vh;">
    
        <div class="text-center mb-4">
            <h1 class="display-3 fw-bold text-dark">Presto.it</h1>
            <p class="lead text-muted fs-4">Il portale degli annunci per liberarti di ciò che non ti piace più</p>
        </div>

        <div class="row w-100 justify-content-center">
            <div class="col-md-6">
                <x-flash-messages/>
            </div>
        </div>


        <div class="text-center mt-3">
            <a href="{{ route('article.create') }}" class="btn btn-success btn-lg shadow px-5 py-3 fw-bold rounded-pill" style="font-size: 1.25rem;">
                <i class="bi bi-plus-circle-fill me-2"></i> Inserisci annuncio
            </a>
        </div>
    </div>
</x-layout>
