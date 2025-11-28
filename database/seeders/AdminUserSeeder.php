<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PortfolioConfig;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar usuário admin
        User::firstOrCreate(
            ['email' => 'admin@portfolio.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'),
            ]
        );

        // Criar configuração inicial do portfólio
        PortfolioConfig::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'Marcelo Augusto Alves Farias',
                'title' => 'Desenvolvedor Full Stack',
                'bio' => 'Com mais de 8 anos de experiência profissional, sou um Programador de Sistemas dedicado a criar soluções tecnológicas inovadoras e eficientes. Ao longo da minha trajetória, tenho atuado no desenvolvimento de softwares que não apenas atendem às necessidades dos clientes, mas também contribuem para a evolução do mercado. Valorizo a colaboração, a inovação e a excelência técnica. Busco sempre alinhar meus valores e motivações à missão e visão à cultura da organização, agregando perspectivas e experiências diversificadas para fortalecer a equipe.',
                'skills' => [
                    'backend' => [
                        ['name' => 'Laravel', 'icon' => 'fab fa-laravel', 'color' => '#FF2D20', 'url' => 'https://laravel.com'],
                        ['name' => 'Golang', 'icon' => 'fab fa-golang', 'color' => '#00ADD8', 'url' => 'https://golang.org'],
                    ],
                    'frontend' => [
                        ['name' => 'JavaScript', 'icon' => 'fab fa-js-square', 'color' => '#F7DF1E', 'url' => 'https://developer.mozilla.org/pt-BR/docs/Web/JavaScript'],
                        ['name' => 'React', 'icon' => 'fab fa-react', 'color' => '#61DAFB', 'url' => 'https://react.dev'],
                    ],
                    'mobile' => [
                        ['name' => 'Flutter', 'icon' => 'fas fa-mobile-alt', 'color' => '#02569B', 'url' => 'https://flutter.dev'],
                        ['name' => 'React Native', 'icon' => 'fab fa-react', 'color' => '#61DAFB', 'url' => 'https://reactnative.dev'],
                    ],
                    'database' => [
                        ['name' => 'PostgreSQL', 'icon' => 'fas fa-database', 'color' => '#336791', 'url' => 'https://www.postgresql.org'],
                        ['name' => 'MongoDB', 'icon' => 'fas fa-leaf', 'color' => '#47A248', 'url' => 'https://www.mongodb.com'],
                    ],
                ],
            ]
        );

        $this->command->info('✅ Usuário admin criado com sucesso!');
        $this->command->info('📧 Email: admin@portfolio.com');
        $this->command->info('🔑 Senha: admin123');
    }
}
