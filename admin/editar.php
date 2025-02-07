<?php
require_once '../config/db.php';
require_once '../classes/Produtos.php';

$produto = new Produto($conn);

if (!isset($_GET['id'])) {
    header('Location: produtos.php');
    exit;
}

$id = $_GET['id'];
$item = $produto->buscarPorId($id);

if (!$item) {
    header('Location: produtos.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto - Fashion Store</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <h1>Fashion Store - Admin</h1>
                <ul>
                    <li><a href="produtos.php">Voltar para Lista</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="admin-area">
        <div class="container">
            <section class="form-section">
                <h2>Editar Produto</h2>
                <form action="produtos.php" method="POST" class="produto-form">
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                    
                    <div class="form-group">
                        <label for="nome">Nome do Produto:</label>
                        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($item['nome']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea id="descricao" name="descricao" required><?php echo htmlspecialchars($item['descricao']); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="preco">Preço:</label>
                        <input type="number" id="preco" name="preco" step="0.01" value="<?php echo $item['preco']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="categoria">Categoria:</label>
                        <select id="categoria" name="categoria" required>
                            <option value="Camisetas" <?php echo $item['categoria'] === 'Camisetas' ? 'selected' : ''; ?>>Camisetas</option>
                            <option value="Calças" <?php echo $item['categoria'] === 'Calças' ? 'selected' : ''; ?>>Calças</option>
                            <option value="Vestidos" <?php echo $item['categoria'] === 'Vestidos' ? 'selected' : ''; ?>>Vestidos</option>
                            <option value="Acessórios" <?php echo $item['categoria'] === 'Acessórios' ? 'selected' : ''; ?>>Acessórios</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="imagem">URL da Imagem:</label>
                        <input type="url" id="imagem" name="imagem" value="<?php echo htmlspecialchars($item['imagem']); ?>" required>
                    </div>

                    <button type="submit" class="btn-primary">Salvar Alterações</button>
                </form>
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