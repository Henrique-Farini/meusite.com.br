<?php
include 'C:\xampp\htdocs\meusite.com.br\Aula 29.10\includes\funcoes.php';

$caminho_pedidos = 'C:\xampp\htdocs\meusite.com.br\Aula 29.10\dados\pedidos.json';
$senhaCorreta = '1234';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senhaDigitada = $_POST['senha'] ?? '';

    if ($senhaDigitada === $senhaCorreta) {
        $pedidos = lerJson($caminho_pedidos);
        if (!empty($pedidos)) {
            $pedidos = array_reverse($pedidos);
        }
    } else {
        $erro = "Senha incorreta! Tente novamente.";
    }
}


if (!isset($pedidos)) {
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Histórico de Pedidos</title>
        <link rel="stylesheet" href="historico.css">

    </head>
    <body>
        <link rel="stylesheet" href="senha.css">
        <form method="POST" class="login-container">
            <h1>🔒 Acesso Restrito</h1>
            <p>Digite a senha para ver o histórico:</p>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
            <?php if (!empty($erro)) echo "<p class='erro'>$erro</p>"; ?>
        </form>
    </body>
    </html>
    <?php
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Pedidos</title>
    <link rel="stylesheet" href="historico.css">
</head>
<body>
    <?php include 'C:\xampp\htdocs\meusite.com.br\Aula 29.10\includes\header.php'; ?>

    <div class="container-historico">
        <h1 class="titulo-pagina">Histórico de Pedidos</h1>

        <?php if (empty($pedidos)): ?>
            <div class="historico-vazio">
                <p>Nenhum pedido realizado ainda.</p>
                <p>Volte ao <a href="index.php" class="link-cardapio">cardápio</a> para começar seu pedido.</p>
            </div>
        <?php else: ?>
            <?php foreach ($pedidos as $pedido): ?>
                <div class="item-historico">
                    <h3 class="titulo-pedido-historico">
                        Pedido #<?php echo $pedido['id']; ?> 
                        <span class="data-pedido"> (<?php echo $pedido['data']; ?>)</span>
                    </h3>
                    <p><strong>Cliente:</strong> <?php echo htmlspecialchars($pedido['cliente']); ?></p>

                    <?php 
                        // Verifica se existe o campo 'observacoes' e se não está vazio
                        $observacoes = $pedido['observacoes'] ?? $pedido['mensagem'] ?? '';
                    ?>
                    <?php if (!empty($observacoes)): ?>
                        <div class="observacoes-historico">
                            <p>
                                <strong>Obs:</strong> 
                                <?php echo nl2br(htmlspecialchars($observacoes)); ?>
                            </p>
                        </div>
                    <?php endif; ?>


                    <ul class="lista-itens-historico">
                        <?php foreach ($pedido['itens'] as $item): ?>
                            <li>
                                <span class="quantidade-item"><?php echo $item['quantidade']; ?>x</span>
                                <span class="nome-item"><?php echo $item['produto']; ?></span>
                                <span class="subtotal-item">R$ <?php echo number_format($item['subtotal'], 2, ',', '.'); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="total-pedido-historico">
                        <strong>Total: </strong>
                        <span class="valor-total-historico">R$ <?php echo number_format($pedido['total'], 2, ',', '.'); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php include 'C:\xampp\htdocs\meusite.com.br\Aula 29.10\includes\footer.php'; ?>
</body>
</html>