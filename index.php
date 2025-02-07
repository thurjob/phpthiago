<?php
require_once 'config/db.php';
require_once 'classes/Produtos.php';

$produto = new Produto($conn);
$produtos = $produto->listarTodos();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Virtual de Roupas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <h1>VTSTORE</h1>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="admin/produtos.php">Gerenciar Produtos</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <section class="produtos-grid">
                <?php foreach ($produtos as $item): ?>
                    <div class="produto-card">
                        <div class="produto-imagem">
                            <img src="<?php echo htmlspecialchars($item['imagem']); ?>" 
                                alt="<?php echo htmlspecialchars($item['nome']); ?>">
                        </div>
                        <div class="produto-info">
                            <h3><?php echo htmlspecialchars($item['nome']); ?></h3>
                            <p class="categoria"><?php echo htmlspecialchars($item['categoria']); ?></p>
                            <p class="preco">R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></p>
                            <button class="btn-comprar">Comprar</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 VTSTORE. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>