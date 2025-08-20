<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accès Refusé - GMAO Trans'urb</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0fdf4 0%, #fefce8 50%, #fef3c7 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .error-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 90%;
        }
        .error-icon {
            font-size: 4rem;
            color: #dc2626;
            margin-bottom: 1rem;
        }
        .error-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
        }
        .error-message {
            color: #6b7280;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        .back-button {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .back-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">
            <i class="fas fa-ban"></i>
        </div>
        <h1 class="error-title">Accès Refusé</h1>
        <p class="error-message">
            @if(isset($message))
                {{ $message }}
            @else
                Vous n'avez pas les permissions nécessaires pour accéder à cette page.
            @endif
        </p>
        <a href="{{ url('/') }}" class="back-button">
            <i class="fas fa-home"></i>
            Retour à l'accueil
        </a>
    </div>
</body>
</html> 