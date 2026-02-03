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
            'name' => 'Rayhan',
            'username' => 'chilhan',
            'email' => 'chilhan@gmail.com',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'email_verified_at' => now(), 
        ]);

         User::create([
            'name' => 'Calista',
            'username' => 'ca',
            'email' => 'calista@gmail.com',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'email_verified_at' => now(), 
        ]);

        User::create([
            'name' => 'Furqan',
            'username' => 'fur',
            'email' => 'furqan@gmail.com',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'email_verified_at' => now(), 
        ]);

        User::create([
            'name' => 'Rivaldy',
            'username' => 'riv',
            'email' => 'rivaldy@gmail.com',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'email_verified_at' => now(), 
        ]);

        User::create([
            'name' => 'Mutia',
            'username' => 'mut',
            'email' => 'mutia@gmail.com',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'email_verified_at' => now(), 
        ]);

        User::create([
            'name' => 'Rizka',
            'username' => 'riz',
            'email' => 'rizka@gmail.com',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'email_verified_at' => now(), 
        ]);

        User::create([
            'name' => 'Zahwa',
            'username' => 'zah',
            'email' => 'zahwa@gmail.com',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'email_verified_at' => now(), 
        ]);

        User::create([
            'name' => 'Najed',
            'username' => 'naj',
            'email' => 'najed@gmail.com',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'email_verified_at' => now(), 
        ]);

    }
}
