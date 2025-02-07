<?php
require_once '../config/db.php';
require_once '../classes/Produtos.php';

$produto = new Produto($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acao'])) {
        switch ($_POST['acao']) {
            case 'adicionar':
                $produto->adicionar(
                    $_POST['nome'],
                    $_POST['descricao'],
                    $_POST['preco'],
                    $_POST['categoria'],
                    $_POST['imagem']
                );
                break;
            case 'editar':
                $produto->atualizar(
                    $_POST['id'],
                    $_POST['nome'],
                    $_POST['descricao'],
                    $_POST['preco'],
                    $_POST['categoria'],
                    $_POST['imagem']
                );
                break;
            case 'excluir':
                $produto->excluir($_POST['id']);
                break;
        }
    }
}

$produtos = $produto->listarTodos();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produtos - Fashion Store</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <h1>Fashion Store - Admin</h1>
                <ul>
                    <li><a href="../index.php">Voltar para Loja</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="admin-area">
        <div class="container">
            <section class="form-section">
                <h2>Adicionar Novo Produto</h2>
                <form action="produtos.php" method="POST" class="produto-form">
                    <input type="hidden" name="acao" value="adicionar">
                    
                    <div class="form-group">
                        <label for="nome">Nome do Produto:</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea id="descricao" name="descricao" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="preco">Preço:</label>
                        <input type="number" id="preco" name="preco" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="categoria">Categoria:</label>
                        <select id="categoria" name="categoria" required>
                            <option value="Camisetas">Camisetas</option>
                            <option value="Calças">Calças</option>
                            <option value="Vestidos">Vestidos</option>
                            <option value="Acessórios">Acessórios</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="imagem">URL da Imagem:</label>
                        <input type="url" id="imagem" name="imagem" required>
                    </div>

                    <button type="submit" class="btn-primary">Adicionar Produto</button>
                </form>
            </section>

            <section class="lista-produtos">
                <h2>Produtos Cadastrados</h2>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Categoria</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produtos as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['id']); ?></td>
                                <td><?php echo htmlspecialchars($item['nome']); ?></td>
                                <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($item['categoria']); ?></td>
                                <td class="acoes">
                                    <form action="produtos.php" method="POST" style="display: inline;">
                                        <input type="hidden" name="acao" value="excluir">
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <button type="submit" class="btn-danger">Excluir</button>
                                    </form>
                                    <a href="editar.php?id=<?php echo $item['id']; ?>" class="btn-secondary">Editar</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Fashion Store. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>