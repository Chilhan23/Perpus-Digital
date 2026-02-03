<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    
    public function run(): void
    {
        Category::create([
            'name' => 'Pemograman',
            'slug' => 'pemograman',
            'color' => 'bg-red-100'
        ]);

        Category::create([
            'name' => 'Pelajaran',
            'slug' => 'pelajaran',
            'color' => 'bg-green-100'
        ]);

        Category::create([
            'name' => 'Dongeng',
            'slug' => 'dongeng',
            'color' => 'bg-blue-100'
        ]);

        Category::create([
            'name' => 'Cerita',
            'slug' => 'cerita',
            'color' => 'bg-purple-100'
        ]);

         Category::create([
            'name' => 'Sejarah',
            'slug' => 'sejarah',
            'color' => 'bg-yellow-100'
        ]);
    }
}