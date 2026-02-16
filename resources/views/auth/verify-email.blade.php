<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifica tu correo - YoSoy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #9333ea 0%, #7c3aed 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .verify-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 100%;
        }
        .verify-icon {
            text-align: center;
            font-size: 64px;
            color: #9333ea;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #9333ea;
            border-color: #9333ea;
        }
        .btn-primary:hover {
            background-color: #7c3aed;
            border-color: #7c3aed;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="verify-card">
            <div class="verify-icon">
                📧
            </div>
            <h2 class="text-center mb-4">Verifica tu correo electrónico</h2>
            
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <p class="text-center mb-4">
                Gracias por registrarte. Hemos enviado un enlace de verificación a tu correo electrónico.
                Por favor, revisa tu bandeja de entrada y haz clic en el enlace para verificar tu cuenta.
            </p>

            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="tu@email.com">
                </div>
                <button type="submit" class="btn btn-primary w-100">Reenviar correo de verificación</button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-decoration-none">Volver al inicio de sesión</a>
            </div>
        </div>
    </div>
</body>
</html>
