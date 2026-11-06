<x-layout>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                    <div>
                        <h1 class="fw-bold text-dark mb-0">Gestione Team Revisori</h1>
                        <p class="text-muted mb-0">Elenco completo degli utenti abilitati alla moderazione degli annunci</p>
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-pill btn-sm px-3">
                        <i class="bi bi-arrow-left me-1"></i> Torna alla Home
                    </a>
                </div>

                @if (session()->has('message'))
                    <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('message') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    </div>
                @endif

                <div class="card shadow-sm border rounded-4 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 bg-white">
                            <thead class="table-light text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                <tr>
                                    <th class="ps-4 py-3">Utente</th>
                                    <th class="py-3">Email</th>
                                    <th class="py-3">Data Abilitazione</th>
                                    <th class="pe-4 py-3 text-end">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($revisors as $revisor)
                                    <tr>
                                        <td class="ps-4 py-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold text-uppercase shadow-sm" style="width: 38px; height: 38px; font-size: 14px;">
                                                    {{ substr($revisor->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <span class="fw-bold text-dark d-block">{{ $revisor->name }}</span>
                                                    @if($revisor->isSuperAdmin())
                                                        <span class="badge bg-danger-subtle text-danger rounded-pill" style="font-size: 0.65rem;">Super Admin</span>
                                                    @else
                                                        <span class="badge bg-primary-subtle text-primary rounded-pill" style="font-size: 0.65rem;">Moderatore</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 text-secondary" style="font-size: 0.9rem;">
                                            {{ $revisor->email }}
                                        </td>
                                        <td class="py-3 text-muted small">
                                            {{ $revisor->updated_at ? $revisor->updated_at->format('d/m/Y') : 'N/D' }}
                                        </td>
                                        <td class="pe-4 py-3 text-end">
                                            @if(!$revisor->isSuperAdmin())
                                                <form action="{{ route('revisor.remove', $revisor) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler rimuovere la carica di revisore a questo utente?');" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold" style="font-size: 0.8rem;">
                                                        <i class="bi bi-person-x-fill me-1"></i> Revoca Carica
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted small fst-italic">Non revocabile</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout>
