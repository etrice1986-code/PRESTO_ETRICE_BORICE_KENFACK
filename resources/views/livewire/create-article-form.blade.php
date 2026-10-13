<div class="border p-4 rounded shadow bg-white">
    <h3 class="mb-4">Inserisci il tuo Annuncio</h3>

    
    @if (session()->has('message'))
        <div class="alert alert-success text-center">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="store">
        
        <div class="mb-3">
            <label for="title" class="form-label">Titolo Annuncio</label>
            <input type="text" id="title" wire:model="title" class="form-control @error('title') is-invalid @enderror">
            @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        
        <div class="mb-3">
            <label for="category_id" class="form-label">Categoria</label>
            <select id="category_id" wire:model="category_id" class="form-select @error('category_id') is-invalid @enderror">
                <option value="">Seleziona una categoria</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        
        <div class="mb-3">
            <label for="price" class="form-label">Prezzo (€)</label>
            <input type="text" id="price" wire:model="price" class="form-control @error('price') is-invalid @enderror" placeholder="0.00">
            @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

       
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione dell'oggetto</label>
            <textarea id="description" wire:model="description" rows="4" class="form-control @error('description') is-invalid @enderror"></textarea>
            @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-success w-100">Inserisci Annuncio</button>
    </form>
</div>
