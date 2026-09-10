<?php

namespace App\Http\Controllers;

use App\Models\PortfolioConfig;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    /**
     * Dashboard administrativo
     */
    public function dashboard(): Response
    {
        $config = PortfolioConfig::getConfig();
        $config->setAttribute('skills', $config->normalizedSkills());

        $projects = Project::orderBy('order')->get()
            ->map(fn ($project) => [
                ...$project->toArray(),
                'screenshots' => collect($project->screenshots ?? [])
                    ->map(fn ($path) => ['path' => $path, 'url' => "/storage/{$path}"])
                    ->values(),
            ]);

        return Inertia::render('Admin/Dashboard', [
            'config' => $config,
            'projects' => $projects,
        ]);
    }

    /**
     * Atualizar configurações do portfólio
     */
    public function updatePortfolio(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'bio' => 'required|string',
            'skills' => 'nullable|array',
            'skills.*' => 'array',
            'skills.*.*.name' => 'required_with:skills|string|max:100',
            'skills.*.*.icon' => 'nullable|string|max:100',
            'skills.*.*.color' => 'nullable|string|max:20',
            'skills.*.*.url' => 'nullable|string|max:255',
        ]);

        $config = PortfolioConfig::first();

        if ($config) {
            $config->update($validated);
        } else {
            PortfolioConfig::create($validated);
        }

        return redirect()->route('admin.dashboard')
            ->with('success', 'Portfólio atualizado com sucesso!');
    }
}
