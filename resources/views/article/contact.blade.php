<x-layout>
    <div class="container my-5 py-4">
        
        
        <div class="row justify-content-center text-center mb-5">
            <div class="col-md-8">
                <span class="badge bg-primary-subtle text-primary border mb-2 px-3 py-2 fs-6 rounded-pill">Supporto</span>
                <h1 class="display-5 fw-bold text-dark mb-3">Contattaci</h1>
                <p class="lead text-muted">Hai domande, segnalazioni o bisogno di aiuto? Il nostro team è a tua disposizione.</p>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            
           
            <div class="col-12 col-md-4">
                <div class="card p-4 h-100 border-0 shadow-sm" style="background-color: var(--surface);">
                    <h4 class="fw-bold mb-4 text-dark">I nostri canali</h4>
                    
                    <!-- Canale Supporto  -->
                    <a href="mailto:supporto@presto.it?subject=Richiesta%20di%20Supporto" class="text-decoration-none d-flex align-items-start mb-4 contact-link">
                        <div class="badge bg-primary-subtle text-primary p-3 rounded-3 me-3 icon-badge">
                            <i class="bi bi-envelope-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark">Email Supporto</h6>
                            <p class="text-muted small mb-0 text-break">supporto@presto.it</p>
                            <span class="text-primary custom-small-text">Invia mail diretta &rarr;</span>
                        </div>
                    </a>

                    <!-- Canale Abusi  -->
                    <a href="mailto:abuse@presto.it?subject=Segnalazione%20Abuso%20/%20Truffa" class="text-decoration-none d-flex align-items-start mb-4 contact-link">
                        <div class="badge bg-success-subtle text-success p-3 rounded-3 me-3 icon-badge">
                            <i class="bi bi-shield-fill-check fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark">Segnalazione Abusi</h6>
                            <p class="text-muted small mb-0 text-break">abuse@presto.it</p>
                            <span class="text-success custom-small-text">Segnala ora &rarr;</span>
                        </div>
                    </a>

                    <div class="d-flex align-items-start">
                        <div class="badge bg-warning-subtle text-warning-emphasis p-3 rounded-3 me-3">
                            <i class="bi bi-clock-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark">Orari Risposta</h6>
                            <p class="text-muted small mb-0">Lun - Ven, 9:00 - 18:00</p>
                        </div>
                    </div>
                </div>
            </div>

            
            <style>
                .contact-link {
                    transition: transform 0.2s ease;
                }
                .contact-link:hover {
                    transform: translateX(4px);
                }
                .custom-small-text {
                    font-size: 11px;
                    font-weight: 600;
                    opacity: 0.8;
                }
                .contact-link:hover .custom-small-text {
                    opacity: 1;
                    text-decoration: underline;
                }
            </style>


            <!-- Modulo Form di Contatto -->
            <div class="col-12 col-md-7">
                <div class="card p-4 p-sm-5 border-0 shadow-sm" style="background-color: var(--surface);">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Prima era: action="#" -->
                   <form action="{{ route('contact.submit') }}" method="POST">

                        @csrf
                        
                                                <div class="row g-3 mb-3">
                            <!-- Nome Completo -->
                            <div class="col-12 col-sm-6">
                                <label for="name" class="form-label fw-semibold text-secondary">Nome Completo</label>
                                <input type="text" name="name" id="name" 
                                    value="{{ old('name', Auth::user()->name ?? '') }}" 
                                    class="form-control py-2" 
                                    style="border-radius: 12px;" required placeholder="Mario Rossi">
                            </div>
                            
                            <!-- Indirizzo Email -->
                            <div class="col-12 col-sm-6">
                                <label for="email" class="form-label fw-semibold text-secondary">Indirizzo Email</label>
                                <input type="email" name="email" id="email" 
                                    value="{{ old('email', Auth::user()->email ?? '') }}" 
                                    class="form-control py-2" 
                                    style="border-radius: 12px;" required placeholder="mario@esempio.com">
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="subject" class="form-label fw-semibold text-secondary">Oggetto della richiesta</label>
                            <select name="subject" id="subject" class="form-select py-2" style="border-radius: 12px;" required>
                                <option value="">Seleziona un motivo...</option>
                                <option value="support">Problema tecnico con un annuncio</option>
                                <option value="report">Segnalazione utente / truffa</option>
                                <option value="info">Informazioni commerciali</option>
                                <option value="other">Altro</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label fw-semibold text-secondary">Messaggio</label>
                            <textarea name="message" id="message" rows="5" class="form-control" style="border-radius: 12px;" required placeholder="Scrivi qui i dettagli della tua richiesta..."></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm text-white" style="border-radius: 12px;">
                                <i class="bi bi-send-fill me-2"></i>Invia Messaggio
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</x-layout>
