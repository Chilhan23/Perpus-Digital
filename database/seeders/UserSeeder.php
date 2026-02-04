<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        
        // User Admin
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@perpusdigi.com',
            'password' => Hash::make('password123'),
            'is_admin' => true,
            'email_verified_at' => now(), 
        ]);

        // User Normal 
        User::create([
            'name' => 'user',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'email_verified_at' => now(), 
        ]);


    }
}
