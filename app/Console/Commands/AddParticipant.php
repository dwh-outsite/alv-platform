<?php

namespace App\Console\Commands;

use App\Participant;
use Illuminate\Console\Command;

class AddParticipant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'participants:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new participant.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $nameAndEmail = $this->ask('What is the name and email address? (seperated by ` - `)?');
        $this->info('Thank you.');
        [$name, $email] = explode(' - ', $nameAndEmail);
        $this->info('Name: ' . $name);
        $this->info('Email: ' . $email);

        $this->info('Generating code...');
        $code = Participant::generateCode();
        $this->info('Code: ' . $code);

        if ($this->confirm('Are you sure you want to create a participant using the details listed above?')) {
            $participant = Participant::create(compact('name', 'email', 'code'));
            $this->info("Participant created with id {$participant->id}.");
        }
    }
}
