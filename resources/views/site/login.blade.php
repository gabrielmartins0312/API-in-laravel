<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2 class="mb-4">Login</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('auth') }}">
        @csrf
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Senha" required>
        <button type="submit" class="btn btn-primary w-100">Entrar</button>
    </form>
    <p class="mt-3 text-center">
        Não tem conta? <a href="{{ route('register') }}">Cadastre-se</a>
    </p>    
</body>
</html>
