<x-layout>
    <div class="container my-4">
        @if(session('message'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 mb-3">
                {{ session('message') }}
            </div>
        @endif

        @if($messages->isEmpty())
            <div class="card card-body border-dashed text-center p-5 bg-body-tertiary">
                <p class="text-muted mb-0">Non hai ancora ricevuto o inviato nessun messaggio.</p>
            </div>
        @else
            @php
                $chats = $messages->groupBy(function($msg) {
                    $partnerId = $msg->sender_id === Auth::id() ? $msg->recipient_id : $msg->sender_id;
                    return $msg->article_id . '_' . $partnerId;
                });

                $activeChatUrl = request()->get('chat');
            @endphp

            <!-- Contenitore  stile WhatsApp -->
            <div class="row g-0 border border-secondary rounded-4 overflow-hidden shadow" style="height: calc(100vh - 240px); min-height: 450px;">
                
                <!--  LISTA CHAT -->
                <div class="col-12 col-md-4 bg-body-secondary border-end border-secondary d-flex flex-column h-100">
                    <div class="p-3 border-bottom border-secondary bg-body-tertiary">
                        <h4 class="fw-bold text-body m-0"><i class="bi bi-chat-left-text-fill text-primary me-2"></i>Chat</h4>
                    </div>
                    
                    <div class="flex-grow-1 overflow-y-auto list-group list-group-flush">
                        @foreach($chats as $key => $chatMessages)
                            @php
                                $sorted = $chatMessages->sortBy('created_at');
                                $lastMsg = $sorted->last();
                                $partner = $lastMsg->sender_id === Auth::id() ? $lastMsg->recipient : $lastMsg->sender;
                                
                                $unreadInChat = $chatMessages->where('recipient_id', Auth::id())
                                                             ->where('is_read', false)
                                                             ->count();
                                
                                $isBtnActive = ($activeChatUrl === "chat-" . $key);
                            @endphp
                            
                            <button type="button" 
                                    class="list-group-item list-group-item-action p-3 border-bottom border-secondary bg-transparent chat-toggle-btn d-flex align-items-center gap-3 {{ $isBtnActive ? 'active bg-primary-subtle' : '' }}"
                                    data-chat-target="chat-{{ $key }}">
                                
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold text-uppercase flex-shrink-0" style="width: 45px; height: 45px; font-size: 16px;">
                                    {{ substr($partner->name, 0, 1) }}
                                </div>
                                
                                <div class="flex-grow-1 min-w-0">
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <h6 class="fw-bold text-body text-truncate mb-0" style="font-size: 0.95rem;">{{ $partner->name }}</h6>
                                        <small class="text-muted flex-shrink-0 ms-2" style="font-size: 0.75rem;">{{ $lastMsg->created_at->format('H:i') }}</small>
                                    </div>
                                    <div class="text-primary fw-semibold text-truncate small mb-1">{{ $lastMsg->article->title }}</div>
                                    
                                    <div class="d-flex justify-content-between align-items-center gap-2">
                                        <p class="text-muted small text-truncate mb-0 flex-grow-1 m-0">
                                            {{ $lastMsg->sender_id === Auth::id() ? 'Tu: ' : '' }}{{ $lastMsg->content }}
                                        </p>
                                        
                                        @if($unreadInChat > 0)
                                            <span class="badge rounded-pill bg-success text-white flex-shrink-0 d-flex align-items-center justify-content-center shadow-sm chat-unread-badge" 
                                                  data-unread-count="{{ $unreadInChat }}"
                                                  style="min-width: 20px; height: 20px; font-size: 0.75rem; padding: 2px 6px; font-weight: bold;">
                                                {{ $unreadInChat }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- FINESTRA DI CONVERSAZIONE -->
                <div class="col-12 col-md-8 bg-body d-flex flex-column h-100 position-relative">
                    
                    <div id="chat-welcome-screen" class="{{ $activeChatUrl ? 'd-none' : 'd-flex' }} flex-column align-items-center justify-content-center h-100 text-center p-5 bg-body-tertiary">
                        <div class="rounded-circle bg-primary-subtle p-4 mb-3 text-primary">
                            <i class="bi bi-chat-square-quote fs-1"></i>
                        </div>
                        <h5 class="fw-bold text-body">Seleziona una conversazione</h5>
                        <p class="text-muted small">Clicca su una chat a sinistra per leggere i messaggi e rispondere in tempo reale.</p>
                    </div>

                    @foreach($chats as $key => $chatMessages)
                        @php
                            $sorted = $chatMessages->sortBy('created_at');
                            $lastMsg = $sorted->last();
                            $partner = $lastMsg->sender_id === Auth::id() ? $lastMsg->recipient : $lastMsg->sender;
                            $isPaneActive = ($activeChatUrl === "chat-" . $key);
                        @endphp

                        <div id="chat-{{ $key }}" class="chat-content-pane {{ $isPaneActive ? 'd-flex' : 'd-none' }} flex-column h-100">
                            
                            <div class="p-3 border-bottom border-secondary bg-body-tertiary d-flex align-items-center gap-3">
                                <button type="button" class="btn btn-sm btn-outline-secondary d-md-none rounded-pill back-to-list-btn">
                                    <i class="bi bi-arrow-left"></i>
                                </button>
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold text-uppercase" style="width: 38px; height: 38px; font-size: 14px;">
                                    {{ substr($partner->name, 0, 1) }}
                                </div>
                                <div>
                                    <h6 class="fw-bold text-body mb-0">{{ $partner->name }}</h6>
                                    <small class="text-muted small">Oggetto: <span class="text-primary fw-semibold">{{ $lastMsg->article->title }}</span></small>
                                </div>
                            </div>

                            <div class="flex-grow-1 overflow-y-auto p-3 d-flex flex-column gap-2 bg-body-secondary" style="background-image: radial-gradient(rgba(0,0,0,0.03) 1px, transparent 0); background-size: 24px 24px;">
                                                                    @foreach($sorted as $msg)
                                    @php $isMe = $msg->sender_id === Auth::id(); @endphp
                                    <div class="d-flex {{ $isMe ? 'justify-content-end' : 'justify-content-start' }} mb-2">
                                        <div class="p-3 rounded-4 shadow-sm" style="max-width: 75%; {{ $isMe ? 'background-color: var(--primary); color: #ffffff; border-bottom-right-radius: 4px;' : 'background-color: var(--surface); color: var(--text); border-bottom-left-radius: 4px; border: var(--border-card);' }}">
                                            
                                            <!-- Nome del Mittente  -->
                                            <span class="d-block fw-bold mb-1" style="font-size: 0.80rem; color: {{ $isMe ? '#b9fffc' : 'var(--primary)' }};">
                                                {{ $isMe ? 'Tu' : $msg->sender->name }}
                                            </span>

                                            <!--  Messaggio -->
                                            <p class="mb-1" style="word-break: break-word; font-size: 0.95rem;">{{ $msg->content }}</p>
                                            
                                            <!-- Data e Ora dell'invio -->
                                            <small class="d-block text-end" style="font-size: 0.70rem; opacity: 0.75; color: {{ $isMe ? '#ffffff' : 'var(--text-muted)' }};">
                                                {{ $msg->created_at->format('H:i') }}
                                                <span class="ms-1" style="font-size: 0.65rem;">({{ $msg->created_at->format('d/m') }})</span>
                                            </small>

                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            
                            <div class="p-3 border-top border-secondary bg-body-tertiary">
                                <form action="{{ route('messages.reply', $lastMsg->id) }}" method="POST" class="d-flex gap-2">
                                    @csrf
                                    <input type="hidden" name="article_id" value="{{ $lastMsg->article_id }}">
                                    <input type="hidden" name="recipient_id" value="{{ $partner->id }}">
                                    <input type="text" name="content" class="form-control rounded-pill border-secondary px-3" placeholder="Scrivi un messaggio..." required>
                                    <button type="submit" class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                                        <i class="bi bi-send-fill" style="font-size: 0.95rem;"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        @endif
    </div>
</x-layout>
