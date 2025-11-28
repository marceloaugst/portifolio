<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortfolioConfig;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Dashboard administrativo
     */
    public function dashboard()
    {
        $config = PortfolioConfig::getConfig();
        return view('admin.dashboard', compact('config'));
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
            'skills.*' => 'string|max:100',
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
