<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;


class NewMessageNotification extends Notification implements ShouldQueue

{
    use Queueable;

    public $messageRecord;

    public function __construct(Message $messageRecord)
    {
        $this->messageRecord = $messageRecord;
    }

    // Specifichiamo che vogliamo inviare sia via Email che via Database
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    // Struttura dell'email che riceverà il venditore
    public function toMail(object $notifiable): MailMessage
    {
        $senderName = $this->messageRecord->sender->name;
        $articleTitle = $this->messageRecord->article->title;

        return (new MailMessage)
            ->subject('Hai un nuovo messaggio per il tuo annuncio!')
            ->greeting("Ciao {$notifiable->name},")
            ->line("Hai ricevuto un nuovo messaggio da parte di **{$senderName}** per il tuo annuncio **\"{$articleTitle}\"**.")
            ->line('"' . $this->messageRecord->content . '"')
            ->action('Rispondi alla chat', url('/messaggi')) // Cambia con la rotta della tua chat
            ->line('Grazie per usare la nostra piattaforma!');
    }
}
