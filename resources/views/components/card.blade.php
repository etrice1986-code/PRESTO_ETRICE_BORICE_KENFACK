@props(['article'])

<div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden transition-card">

    
        @if($article->images && $article->images->count() > 0)
        @php
            $firstImage = $article->images->first();
        @endphp
        <img src="{{ $firstImage->getUrl(300, 300) }}"
             class="card-img-top object-fit-cover"
             style="height: 300px; width: 300px;" 
             alt="Immagine articolo">
    @else
        <img src="https://picsum.photos/seed/{{ $article->id }}/300/300"
             class="card-img-top object-fit-cover"
             style="height: 300px; width: 300px;"
             alt="Immagine segnaposto">
    @endif


    <div class="card-body d-flex flex-column p-3">

        <span class="badge bg-primary-subtle text-primary rounded-pill align-self-start mb-2 px-3 py-1"
              style="font-size: 12px; font-weight: 600;">
            <a href="{{ route('category.show', $article->category) }}"
               class="text-decoration-none text-primary">
                {{ __("ui." . $article->category->name) }}
            </a>
        </span>

        <h5 class="card-title fw-bold text-dark text-truncate mb-1" title="{{ $article->title }}">
            {{ $article->title }}
        </h5>

        <p class="card-text fw-bold text-success fs-5 mb-2">
            {{ number_format($article->price, 2, ',', '.') }} €
        </p>

        <p class="card-text text-muted small flex-grow-1">
            {{ Str::limit($article->description, 80) }}
        </p>

        <a href="{{ route('article.show', $article) }}"
           class="btn btn-outline-primary btn-sm w-100 rounded-pill mt-3 fw-semibold">
            {{ __('ui.viewDetail') }}
        </a>

    </div>
</div>
