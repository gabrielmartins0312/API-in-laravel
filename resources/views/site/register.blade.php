<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registrar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2 class="mb-4">Registrar</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf
        <input type="text" name="name" class="form-control mb-2" placeholder="Nome" required>
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Senha" required>
        <button type="submit" class="btn btn-primary w-100">Criar Conta</button>
    </form>

    <p class="mt-3 text-center">
        Já tem uma conta? <a href="{{ route('login') }}">Faça login</a>
    </p>
</body>
</html>
