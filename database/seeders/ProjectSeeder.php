<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'name' => 'Regviagens',
                'domain' => 'regviagens.marceloaugusto.dev.br',
                'link' => 'https://regviagens.marceloaugusto.dev.br',
                'description' => 'Registro de viagens feitas pelo Brasil afora.',
                'order' => 1,
            ],
            [
                'name' => 'Pokelist',
                'domain' => 'pokelist.marceloaugusto.dev.br',
                'link' => 'https://pokelist.marceloaugusto.dev.br',
                'description' => 'Listagem de Pokémon, uma espécie de Pokédex.',
                'order' => 2,
            ],
            [
                'name' => 'Flightpath',
                'domain' => 'flightpath.marceloaugusto.dev.br',
                'link' => 'https://flightpath.marceloaugusto.dev.br',
                'description' => 'Mapa mundi com aviões em movimento em tempo real.',
                'order' => 3,
            ],
            [
                'name' => 'Bolsofy',
                'domain' => 'bolsofy.marceloaugusto.dev.br',
                'link' => 'https://bolsofy.marceloaugusto.dev.br',
                'description' => 'Controle financeiro para gerenciar despesas e ganhos.',
                'order' => 4,
            ],
        ];

        foreach ($projects as $project) {
            Project::firstOrCreate(
                ['domain' => $project['domain']],
                $project + ['screenshots' => []]
            );
        }
    }
}
