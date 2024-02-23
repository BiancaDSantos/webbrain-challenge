<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\ContactOptions;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public static function run(): void
    {
        $sugestao = ContactOptions::where('description','Sugestão')->first();
        $duvida = ContactOptions::where('description', 'Dúvida')->first();
        $critica = ContactOptions::where('description', 'Crítica')->first();
        $elogio = ContactOptions::where('description', 'Elogio')->first();
        $outros = ContactOptions::where('description', 'Outros')->first();

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste elogio'
        ])->options()->attach($elogio->id);

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste sugestão'
        ])->options()->attach($sugestao->id);

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste dúvida'
        ])->options()->attach($duvida->id);

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste crítica'
        ])->options()->attach($critica->id);

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste outros'
        ])->options()->attach($outros->id);
        // ==========================================
        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste outros e critica.'
        ])->options()->attach((new Collection([$outros, $critica]))->pluck('id'));

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste outros, crítica e elogio.'
        ])->options()->attach((new Collection([$outros, $critica, $elogio]))->pluck('id'));

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste outros, crítica e dúvida.'
        ])->options()->attach((new Collection([$outros, $critica, $duvida]))->pluck('id'));

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste outros, crítica e sugestão.'
        ])->options()->attach((new Collection([$outros, $critica, $sugestao]))->pluck('id'));

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste outros, elogio e crítica.'
        ])->options()->attach((new Collection([$elogio, $critica]))->pluck('id'));

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste crítica e dúvida.'
        ])->options()->attach((new Collection([$duvida, $critica]))->pluck('id'));

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste outros e crítica.'
        ])->options()->attach((new Collection([$outros, $critica]))->pluck('id'));

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste outros e elogio.'
        ])->options()->attach((new Collection([$outros, $elogio]))->pluck('id'));

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste outros, crítica, elogio, sugestão e dúvida.'
        ])->options()->attach((new Collection([$outros, $critica, $elogio, $sugestao, $duvida]))->pluck('id'));

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste dúvida e elogio.'
        ])->options()->attach((new Collection([$sugestao, $elogio]))->pluck('id'));

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste dúvida, crítica e outros.'
        ])->options()->attach((new Collection([$duvida, $critica, $outros]))->pluck('id'));

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste outros.'
        ])->options()->attach($outros->id);

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste elogio.'
        ])->options()->attach($elogio->id);

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste elogio e crítica.'
        ])->options()->attach((new Collection([$elogio, $critica]))->pluck('id'));

        Contact::create([
            'name' => 'teste',
            'birth_date' => '1966-05-15',
            'email' => 'teste@teste.com',
            'whatsApp' => '(48) 99999-9999',
            'phone' => '(48) 9999-9999',
            'message' => 'Teste dúvida e sugestão.'
        ])->options()->attach((new Collection([$duvida, $sugestao]))->pluck('id'));
    }
}
