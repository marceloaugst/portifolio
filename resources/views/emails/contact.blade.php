<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      color: #333;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #f5f5f5;
      border-radius: 8px;
    }

    .header {
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      color: white;
      padding: 20px;
      border-radius: 8px 8px 0 0;
      text-align: center;
    }

    .content {
      background-color: white;
      padding: 20px;
      margin-top: 0;
    }

    .info {
      margin: 15px 0;
      padding: 10px;
      background-color: #f9f9f9;
      border-left: 4px solid #6366f1;
    }

    .info strong {
      color: #6366f1;
    }

    .message {
      margin: 20px 0;
      padding: 15px;
      background-color: #f0f0f0;
      border-radius: 5px;
      white-space: pre-wrap;
      word-wrap: break-word;
    }

    .footer {
      text-align: center;
      padding: 20px;
      background-color: #f9f9f9;
      font-size: 12px;
      color: #666;
      border-radius: 0 0 8px 8px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h2>📬 Nova Mensagem de Contato</h2>
    </div>
    <div class="content">
      <p>Você recebeu uma nova mensagem através do seu portfólio!</p>

      <div class="info">
        <strong>Nome:</strong> {{ $contactName }}
      </div>

      <div class="info">
        <strong>Email:</strong> <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
      </div>

      <div>
        <strong>Mensagem:</strong>
        <div class="message">{{ $contactMessage }}</div>
      </div>

      <p style="margin-top: 20px; color: #666; font-size: 14px;">
        Para responder, use o email de origem: <strong>{{ $contactEmail }}</strong>
      </p>
    </div>
    <div class="footer">
      <p>Esta é uma mensagem automática do seu portfólio em Laravel.</p>
      <p>&copy; {{ date('Y') }} Marcelo Augusto Alves Farias</p>
    </div>
  </div>
</body>

</html>