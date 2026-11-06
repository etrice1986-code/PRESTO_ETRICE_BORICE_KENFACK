<x-layout>
    <div class="container my-5" style="max-w: 700px;">
        <div class="card shadow-sm border-light-subtle">
            <div class="card-body p-4 p-sm-5">
                
                <h1 class="card-title h3 fw-bold text-dark mb-4">
                    Modifica Annuncio: <span class="text-primary">{{ $article->title }}</span>
                </h1>

                <!-- Form di Modifica -->
                <form action="{{ route('article.update', $article) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Titolo -->
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold text-secondary">Titolo dell'annuncio</label>
                        <input type="text" name="title" id="title" 
                               value="{{ old('title', $article->title) }}" 
                               class="form-control @error('title') is-invalid @enderror">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Prezzo e Categoria (Disposti su due colonne) -->
                    <div class="row g-3 mb-3">
                        <!-- Prezzo -->
                        <div class="col-12 col-sm-6">
                            <label for="price" class="form-label fw-semibold text-secondary">Prezzo (€)</label>
                            <input type="number" step="0.01" name="price" id="price" 
                                   value="{{ old('price', $article->price) }}" 
                                   class="form-control @error('price') is-invalid @enderror">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Categoria -->
                        <div class="col-12 col-sm-6">
                            <label for="category_id" class="form-label fw-semibold text-secondary">Categoria</label>
                            <select name="category_id" id="category_id" 
                                    class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">Seleziona una categoria</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Descrizione -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold text-secondary">Descrizione</label>
                        <textarea name="description" id="description" rows="5" 
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $article->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pulsanti di Azione -->
                    <div class="d-flex justify-content-end gap-2 border-top pt-3">
                        <a href="{{ route('article.show', $article) }}" class="btn btn-outline-secondary">
                            Annulla
                        </a>
                        <button type="submit" class="btn btn-primary shadow-sm">
                            Aggiorna Annuncio
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-layout>
