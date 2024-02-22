<?php

namespace Database\Seeders;

use App\Models\ContactOptions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public static function run(): void
    {
        ContactOptions::create([
            'description'=> 'Sugestão'
        ]);

        ContactOptions::create([
            'description'=> 'Dúvida'
        ]);

        ContactOptions::create([
            'description'=> 'Elogio'
        ]);

        ContactOptions::create([
            'description'=> 'Crítica'
        ]);

        ContactOptions::create([
            'description'=> 'Outros'
        ]);
    }
}
