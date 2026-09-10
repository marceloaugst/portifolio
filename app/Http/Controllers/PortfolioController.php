<?php

namespace App\Http\Controllers;

use App\Models\PortfolioConfig;
use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;

class PortfolioController extends Controller
{
    public function index(): Response
    {
        $config = PortfolioConfig::getConfig();
        $skills = $config->normalizedSkills();

        $projects = Project::orderBy('order')->get(['id', 'name', 'domain', 'link', 'description', 'screenshots'])
            ->map(fn ($project) => [
                ...$project->toArray(),
                'screenshots' => collect($project->screenshots ?? [])
                    ->map(fn ($path) => "/storage/{$path}")
                    ->values(),
            ]);

        return Inertia::render('Portfolio/Index', [
            'name' => $config->name,
            'title' => $config->title,
            'bio' => $config->bio,
            'skills' => $skills,
            'projects' => $projects,
            'social' => [
                'github' => 'https://github.com/marceloaugst',
                'linkedin' => 'https://www.linkedin.com/in/marcelo-augusto-3120641a3',
                'email' => 'marcelo.augsd@gmail.com',
            ],
        ]);
    }
}
