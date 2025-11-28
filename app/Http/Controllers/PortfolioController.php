<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortfolioConfig;

class PortfolioController extends Controller
{
    public function index()
    {
        $config = PortfolioConfig::getConfig();

        // Se skills estiver vazio ou for um array simples de strings, usar estrutura padrão
        $skills = $config->skills;

        // Verifica se é um array simples de strings ou se está vazio
        if (empty($skills) || (is_array($skills) && !isset($skills['backend']))) {
            $skills = [
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
            ];
        }

        $data = [
            'name' => $config->name,
            'title' => $config->title,
            'bio' => $config->bio,
            'skills' => $skills,
            'social' => [
                'github' => 'https://github.com/marceloaugst',
                'linkedin' => 'https://www.linkedin.com/in/marcelo-augusto-3120641a3',
                'email' => 'marcelo.augsd@gmail.com',
            ]
        ];

        return view('portfolio.index', $data);
    }
}
