<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class MakeUserRevisor extends Command
{
    protected $signature = 'presto:make-user-revisor {email}';

    protected $description = 'Rende un utente registrato un revisore della piattaforma tramite la sua email';


    public function handle()
    {

        $email = $this->argument('email');


        $user = User::where('email', $email)->first();


        if (!$user) {
            $this->error("Errore: Impossibile trovare un utente registrato con l'email: {$email}");
            return Command::FAILURE;
        }


        $user->is_revisor = true;
        $user->save();


        $this->info("Successo! L'utente {$user->name} ({$email}) è ora un Revisore di Presto.it.");
        return Command::SUCCESS;
    }
}
