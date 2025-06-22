<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-product {
            border-radius: 8px;
            transition: all 0.2s;
        }
        .card-product:hover {
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Painel de Produtos</span>
            <a href="{{ route('logout') }}" class="btn btn-outline-danger">Sair</a>
        </div>
    </nav>

    <div class="container">
        <div class="row g-4">
            <!-- Cadastro -->
            <div class="col-md-4">
                <div class="card p-4 shadow-sm">
                    <h5 class="mb-3">
                        {{ isset($produtoEdicao) ? 'Editar Produto' : 'Cadastrar Produto' }}
                    </h5>
                    <form method="POST" action="{{ isset($produtoEdicao) ? route('produtos.update', $produtoEdicao['id']) : route('produtos.store') }}">
                        @csrf
                        @if(isset($produtoEdicao))
                            @method('PUT')
                        @endif

                        <input type="text" name="name" class="form-control mb-2" placeholder="Nome" required value="{{ $produtoEdicao['name'] ?? '' }}">
                        <textarea name="description" class="form-control mb-2" placeholder="Descrição" required>{{ $produtoEdicao['description'] ?? '' }}</textarea>
                        <input type="number" name="quantity" class="form-control mb-2" placeholder="Quantidade" required value="{{ $produtoEdicao['quantity'] ?? '' }}">
                        <input type="number" step="0.01" name="price" class="form-control mb-3" placeholder="Preço" required value="{{ $produtoEdicao['price'] ?? '' }}">

                        <button type="submit" class="btn btn-{{ isset($produtoEdicao) ? 'primary' : 'success' }} w-100">
                            {{ isset($produtoEdicao) ? 'Salvar Alterações' : 'Cadastrar' }}
                        </button>
                    </form>

                    @if(isset($produtoEdicao))
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                    @endif
                </div>
            </div>

            <!-- Listagem -->
            <div class="col-md-8">
                <h5 class="mb-3">Produtos Cadastrados</h5>
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    @foreach($produtos as $produto)
                        <div class="col">
                            <div class="card card-product p-3 h-100 shadow-sm">
                                <div class="mb-2">
                                    <h6 class="mb-0">{{ $produto['name'] }}</h6>
                                    <small class="text-muted">{{ $produto['description'] }}</small>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-success">
                                        R$ {{ number_format($produto['price'], 2, ',', '.') }}
                                    </span>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('produtos.edit', $produto['id']) }}" class="btn btn-sm btn-outline-primary">Editar</a>

                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $produto['id'] }}">
                                            Excluir
                                        </button>
                                        <div class="modal fade" id="confirmModal{{ $produto['id'] }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirmar Exclusão</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Tem certeza que deseja excluir o produto <strong>{{ $produto['name'] }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form method="POST" action="{{ route('produtos.destroy', $produto['id']) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Sim, excluir</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if (count($produtos) === 0)
                        <div class="col">
                            <div class="alert alert-warning text-center">Nenhum produto cadastrado.</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
