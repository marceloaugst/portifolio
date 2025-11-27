<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $data = [
            'name' => 'Marcelo Augusto Alves Farias',
            'title' => 'Desenvolvedor Full Stack',
            'bio' => 'Sou um desenvolvedor Full Stack apaixonado por criar soluções tecnológicas inovadoras e eficientes. Com experiência sólida em desenvolvimento backend e frontend, transformo ideias em aplicações robustas e escaláveis. Minha jornada na programação me proporcionou expertise em diversas tecnologias modernas, permitindo-me entregar projetos de alta qualidade que atendem às necessidades dos usuários e do negócio. Estou sempre em busca de novos desafios e oportunidades para aprender e crescer profissionalmente.',
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
            'social' => [
                'github' => 'https://github.com/marceloaugst',
                'linkedin' => 'https://www.linkedin.com/in/marcelo-augusto-3120641a3',
                'email' => 'marcelo.augsd@gmail.com',
            ]
        ];

        return view('portfolio.index', $data);
    }
}
