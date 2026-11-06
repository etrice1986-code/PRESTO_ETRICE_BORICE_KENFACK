<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'email', 'password',  'is_revisor'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }



    /**
     * I messaggi inviati dall'utente.
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * I messaggi ricevuti dall'utente.
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }


    /**
     * Verifica se l'utente è un Amministratore (Super-Revisore)
     */
    public function isAdmin()
    {

        return $this->is_revisor && $this->email === 'admin@presto.it';
    }

    /**
     * Verifica se l'utente è il Super-Amministratore del sito
     */
    public function isSuperAdmin()
    {

        return $this->is_revisor && $this->email === 'etrice@gmail.com';
    }
}
