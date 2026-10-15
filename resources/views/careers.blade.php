<x-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-7">
                
                <div class="card shadow border-0 rounded-4 p-4 bg-white">
                    <div class="text-center mb-4">
                        <h1 class="fw-bold text-dark">Lavora con noi</h1>
                        <p class="text-muted">Invia la tua candidatura per entrare nel team dei revisori di Presto.it</p>
                    </div>

                    <form action="{{ route('careers.submit') }}" method="POST">
                        @csrf

                       
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Il tuo Nome</label>
                            <input type="text" class="form-control bg-light" value="{{ Auth::user()->name }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">La tua Email</label>
                            <input type="email" class="form-control bg-light" value="{{ Auth::user()->email }}" readonly>
                        </div>

                       
                        <div class="mb-4">
                            <label for="message" class="form-label fw-semibold">Perché vuoi diventare un revisore? (Lettera di presentazione)</label>
                            <textarea id="message" name="message" rows="5" class="form-control rounded-3 @error('message') is-invalid @enderror" placeholder="Raccontaci brevemente le tue motivazioni...">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback fw-medium">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill fw-bold shadow-sm">
                            <i class="bi bi-send-fill me-2"></i> Invia la Candidatura
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-layout>
