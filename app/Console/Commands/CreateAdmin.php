<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    protected $signature = 'create:admin {name} {email} {password}';
    protected $description = 'Create a new admin user';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        // Перевірте, чи користувач вже існує
        if (User::where('email', $email)->exists()) {
            $this->error('User with this email already exists.');
            return 1;
        }

        // Створіть нового адміністратора
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin', // Встановіть роль адміністратора
        ]);

        $this->info('Admin user created successfully.');
        return 0;
    }
}
