<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioConfig extends Model
{
    protected $fillable = [
        'name',
        'title',
        'bio',
        'skills',
    ];

    protected $casts = [
        'skills' => 'array',
    ];

    /**
     * Obter a configuração ativa do portfólio
     */
    public static function getConfig()
    {
        return self::first() ?? self::create([
            'name' => 'Seu Nome',
            'title' => 'Seu Título',
            'bio' => 'Sua biografia aqui...',
            'skills' => [],
        ]);
    }

    /**
     * Skills padrão, usadas quando a config ainda não tem uma estrutura por categoria
     */
    public static function defaultSkills(): array
    {
        return [
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

    /**
     * Skills normalizadas: usa a estrutura salva se já estiver por categoria, senão cai no padrão
     */
    public function normalizedSkills(): array
    {
        $skills = $this->skills;

        if (empty($skills) || (is_array($skills) && !isset($skills['backend']))) {
            return self::defaultSkills();
        }

        return $skills;
    }
}
