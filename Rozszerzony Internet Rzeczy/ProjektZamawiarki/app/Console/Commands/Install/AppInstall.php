<?php

namespace App\Console\Commands\Install;

use Illuminate\Console\Command;
use App\Models\User;

class AppInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('migrate:fresh');
        $email = "admin@zamawiarka.pl";
        $password = "admin123";
        User::create([
            'name' => 'Admin',
            'email' => $email,
            'password' => bcrypt($password),
        ]);
        $this->call('db:seed');
        $this->info('Application installed successfully.');
        $this->info("Admin credentials: Email: $email, Password: $password");
    }
}
