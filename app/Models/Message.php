<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    // Campi che possono essere riempiti massivamente tramite Message::create()
    protected $fillable = [
        'article_id',
        'sender_id',
        'recipient_id',
        'content',
        'is_read'
    ];

    /**
     * Relazione con l'articolo a cui fa riferimento il messaggio.
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Relazione con l'utente che ha inviato il messaggio (il compratore).
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Relazione con l'utente che riceve il messaggio (il venditore).
     */
    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
