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
}
