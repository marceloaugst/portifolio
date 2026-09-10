<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255',
            'link' => 'required|url|max:255',
            'description' => 'required|string|max:1000',
        ]);

        Project::create([
            ...$validated,
            'screenshots' => [],
            'order' => (Project::max('order') ?? 0) + 1,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Projeto adicionado com sucesso!');
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255',
            'link' => 'required|url|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $project->update($validated);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Projeto atualizado com sucesso!');
    }

    public function destroy(Project $project)
    {
        foreach ($project->screenshots ?? [] as $path) {
            Storage::disk('public')->delete($path);
        }

        $project->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Projeto removido com sucesso!');
    }

    public function uploadScreenshot(Request $request, Project $project)
    {
        $request->validate([
            'screenshot' => 'required|image|max:4096',
        ]);

        $path = $request->file('screenshot')->store("projects/{$project->id}", 'public');

        $project->update([
            'screenshots' => [...($project->screenshots ?? []), $path],
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Print enviado com sucesso!');
    }

    public function deleteScreenshot(Request $request, Project $project)
    {
        $validated = $request->validate([
            'path' => 'required|string',
        ]);

        Storage::disk('public')->delete($validated['path']);

        $project->update([
            'screenshots' => collect($project->screenshots ?? [])
                ->reject(fn ($path) => $path === $validated['path'])
                ->values()
                ->all(),
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Print removido com sucesso!');
    }
}
