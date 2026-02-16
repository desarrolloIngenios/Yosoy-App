<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Correo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        h1 {
            color: #9333ea;
            text-align: center;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #9333ea;
            color: white !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }
        .button:hover {
            background-color: #7c3aed;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <h1>¡Bienvenida a YoSoy!</h1>
        </div>
        
        <p>Hola <strong>{{ $user->name }}</strong>,</p>
        
        <p>Gracias por registrarte en nuestra plataforma. Para completar tu registro y poder acceder a todas las funcionalidades, por favor verifica tu correo electrónico.</p>
        
        <div class="text-center">
            <a href="{{ $verificationUrl }}" class="button">Verificar mi correo electrónico</a>
        </div>
        
        <p>Si no puedes hacer clic en el botón, copia y pega el siguiente enlace en tu navegador:</p>
        <p style="word-break: break-all; color: #666; font-size: 12px;">{{ $verificationUrl }}</p>
        
        <p><strong>Nota:</strong> Este enlace expirará en 60 minutos.</p>
        
        <p>Si no creaste esta cuenta, puedes ignorar este correo.</p>
        
        <div class="footer">
            <p>© {{ date('Y') }} YoSoy. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
