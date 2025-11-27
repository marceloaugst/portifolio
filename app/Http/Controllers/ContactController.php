<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validar os dados do formulário
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ], [
            'name.required' => 'Por favor, insira seu nome.',
            'name.string' => 'O nome deve ser um texto válido.',
            'name.max' => 'O nome não pode exceder 255 caracteres.',
            'email.required' => 'Por favor, insira seu email.',
            'email.email' => 'Por favor, insira um email válido.',
            'email.max' => 'O email não pode exceder 255 caracteres.',
            'message.required' => 'Por favor, insira sua mensagem.',
            'message.string' => 'A mensagem deve ser um texto válido.',
            'message.max' => 'A mensagem não pode exceder 5000 caracteres.',
        ]);

        try {
            // Enviar email para o seu email
            Mail::to('marcelo.augsd@gmail.com')
                ->send(new ContactMessage(
                    $validated['name'],
                    $validated['email'],
                    $validated['message']
                ));

            // Retornar resposta de sucesso
            return response()->json([
                'success' => true,
                'message' => 'Mensagem enviada com sucesso! Em breve retornaremos o contato.',
            ]);
        } catch (\Exception $e) {
            // Retornar erro
            return response()->json([
                'success' => false,
                'message' => 'Erro ao enviar a mensagem. Por favor, tente novamente.',
            ], 500);
        }
    }
}
