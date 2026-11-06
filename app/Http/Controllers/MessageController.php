<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewMessageNotification;

class MessageController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // 1. Salva il messaggio nel Database (Opzione 1)
        $message = Message::create([
            'article_id' => $article->id,
            'sender_id' => Auth::id(),
            'recipient_id' => $article->user_id, // Il proprietario dell'articolo
            'content' => $request->content,
        ]);

        // 2. Invia l'email di notifica al venditore (Opzione 2)
        $venditore = $article->user;
        $venditore->notify(new NewMessageNotification($message));

        return redirect()->back()->with('message', 'Messaggio inviato con successo! Il venditore è stato notificato via email.');
    }




    // 1. Mostra la pagina con tutti i messaggi ricevuti e inviati
    public function index(Request $request)
    {
        // 1. Recupera il parametro dall'URL (es: chat-4_2)
        $activeChat = $request->query('chat');

        if ($activeChat) {
            // Rimuove la stringa "chat-" per estrarre articolo e partner
            $cleanKey = str_replace('chat-', '', $activeChat);
            $parts = explode('_', $cleanKey);

            if (count($parts) === 2) {
                $articleId = $parts[0];
                $partnerId = $parts[1];

                // SEGNA COME LETTI TUTTI I MESSAGGI RICEVUTI DA ME IN QUESTA SPECIFICA CHAT
                \App\Models\Message::where('article_id', $articleId)
                    ->where('recipient_id', \Illuminate\Support\Facades\Auth::id())
                    ->where(function ($query) use ($partnerId) {
                        $query->where('sender_id', $partnerId)
                            ->orWhere('recipient_id', $partnerId);
                    })
                    ->where('is_read', false)
                    ->update(['is_read' => true]);
            }
        }

        // 2. Recupera tutti i messaggi aggiornati dal database
        $messages = \App\Models\Message::where('recipient_id', \Illuminate\Support\Facades\Auth::id())
            ->orWhere('sender_id', \Illuminate\Support\Facades\Auth::id())
            ->with(['article', 'sender', 'recipient'])
            ->latest()
            ->get();

        return view('messages.index', compact('messages'));
    }


    // 2. Gestisce l'invio di una risposta direttamente dalla chat
    public function reply(Request $request, Message $message)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Determina chi riceve la risposta (se risponde il venditore, riceve il compratore originario e viceversa)
        $recipient_id = (Auth::id() === $message->recipient_id) ? $message->sender_id : $message->recipient_id;

        // Crea il nuovo messaggio nella conversazione
        $reply = Message::create([
            'article_id' => $message->article_id,
            'sender_id' => Auth::id(),
            'recipient_id' => $recipient_id,
            'content' => $request->content,
        ]);

        // Invia la notifica email a chi riceve la risposta
        $recipient = $reply->recipient;
        $recipient->notify(new NewMessageNotification($reply));

        // Recupera la chiave univoca della chat per raggrupparla nell'URL
        // Recupera la chiave univoca della chat aggiungendo il prefisso richiesto dal front-end
        $chatKey = 'chat-' . $message->article_id . '_' . $recipient_id;

        return redirect()->route('messages.index', ['chat' => $chatKey])
            ->with('message', 'Risposta inviata con successo!');
    }





    public function markAsRead(Request $request)
    {
        $activeChat = $request->input('chat');

        if ($activeChat) {
            $cleanKey = str_replace('chat-', '', $activeChat);
            $parts = explode('_', $cleanKey);

            if (count($parts) === 2) {
                $articleId = $parts[0];
                $partnerId = $parts[1];

                // Aggiorna il database portando i messaggi ricevuti in questa chat a "letti"
                \App\Models\Message::where('article_id', $articleId)
                    ->where('recipient_id', Auth::id())
                    ->where('sender_id', $partnerId)
                    ->where('is_read', false)
                    ->update(['is_read' => true]);
            }
        }

        return response()->json(['success' => true]);
    }
}
