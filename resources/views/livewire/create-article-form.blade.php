<div class="border p-4 rounded shadow bg-white">
    <h2 class="fw-bold text-dark mb-4">{{ __('ui.createTitle') }}</h2>

    @if (session()->has('message'))
        <div class="alert alert-success text-center">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="store">
        
        
        <div class="mb-3">
            <label for="title" class="form-label">{{ __('ui.formTitle') }}</label>
            <input type="text" id="title" wire:model="title" class="form-control @error('title') is-invalid @enderror">
            @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        
        <div class="mb-3">
            <label for="category_id" class="form-label">{{ __('ui.formCategory') }}</label>
            <select id="category_id" wire:model="category_id" class="form-select @error('category_id') is-invalid @enderror">
                <option value="">{{ __('ui.formCategory') }}...</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ __('ui.' . $category->name) }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        
        <div class="mb-3">
            <label for="price" class="form-label">{{ __('ui.formPrice') }} (€)</label>
            <input type="text" id="price" wire:model="price" class="form-control @error('price') is-invalid @enderror" placeholder="0.00">
            @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

       
        <div class="mb-3">
            <label for="description" class="form-label">{{ __('ui.formDescription') }}</label>
            <textarea id="description" wire:model="description" rows="4" class="form-control @error('description') is-invalid @enderror"></textarea>
            @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        
        <div class="mb-3">
            <label for="temporary_images" class="form-label fw-semibold">Immagini dell'annuncio</label>
            
            <input type="file" id="temporary_images" wire:model="temporary_images" class="form-control @error('images.*') is-invalid @enderror" multiple>
            @error('images.*') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        
        @if (!empty($images))
            <div class="mb-4">
                <p class="fw-semibold text-secondary small mb-2">Anteprima immagini caricate:</p>
                <div class="row g-2">
                    @foreach ($images as $key => $image)
                        <div class="col-4 col-sm-3 position-relative">
                            
                            <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded-3 shadow-sm object-fit-cover border" style="height: 80px; width: 100%;">
                            
                           
                            <button type="button" wire:click="removeImage({{ $key }})" class="btn btn-danger btn-sm rounded-circle position-absolute top-0 end-0 m-1 d-flex align-items-center justify-content-center" style="width: 22px; height: 22px; padding: 0;" title="Rimuovi immagine">
                                <i class="bi bi-x" style="font-size: 14px;"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <button type="submit" class="btn btn-success w-100">{{ __('ui.formSubmit') }}</button>
    </form>
</div>
