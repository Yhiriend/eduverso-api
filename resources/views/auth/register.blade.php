<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h1 {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 0.5rem;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .social-login {
            text-align: center;
            margin-top: 1rem;
        }

        .social-login a {
            display: inline-block;
            margin: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            color: white;
        }

        .google {
            background-color: #db4437;
        }

        .facebook {
            background-color: #3b5998;
        }

        .google:hover {
            background-color: #c13527;
        }

        .facebook:hover {
            background-color: #2d4373;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h1>Eduverso</h1>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nombre" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="password" name="password_confirmation" placeholder="Confirma Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>

        <div class="social-login">
            <h2>O regístrate con</h2>
            <a href="{{ url('auth/login/google') }}" class="google">Google</a>
            <a href="{{ url('auth/login/facebook') }}" class="facebook">Facebook</a>
        </div>
    </div>
</body>

</html>