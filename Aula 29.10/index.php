<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio de Lanches</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php 
        
        include 'C:\xampp\htdocs\meusite.com.br\Aula 29.10\includes\header.php';
        include 'C:\xampp\htdocs\meusite.com.br\Aula 29.10\includes\funcoes.php';

        
        $cardapio = lerJson('C:\xampp\htdocs\meusite.com.br\Aula 29.10\dados\cardapio.json');
    ?>

    <h1 class="titulo-pagina">Cardápio</h1>

    <form action="pedido.php" method="post" class="formulario-cardapio">

        <div class="campo-nome">
            <label for="nome_cliente">Seu Nome:</label>
            <input 
                type="text" 
                id="nome_cliente" 
                name="nome_cliente" 
                required 
                class="input-nome-cliente"
                placeholder="Digite seu nome">
        </div>

   
        <div class="lista-produtos">
            <?php foreach ($cardapio as $item): ?>
                <div class="item-produto" data-id="<?php echo $item['id']; ?>">
                    <h3 class="nome-produto"><?php echo htmlspecialchars($item['nome']); ?></h3>
                    <p class="preco-produto">R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></p>
                    
                    <div class="quantidade-container">
                        <label for="quantidade_<?php echo $item['id']; ?>" class="label-quantidade">Quantidade:</label>
                        <input
                            class="input-quantidade" 
                            type="number" 
                            id="quantidade_<?php echo $item['id']; ?>"
                            name="quantidade[<?php echo $item['id']; ?>]" 
                            value="0" 
                            min="0" 
                            step="1">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="campo-nome"> 
            <label for="observacoes">Observações para o Pedido (opcional):</label>
            <textarea 
                id="observacoes" 
                name="observacoes" 
                rows="4" 
                class="input-nome-cliente" 
                placeholder="Ex: Sem cebola, ponto da carne, etc."></textarea>
        </div>


        <button type="submit" class="botao-fazer-pedido">Fazer Pedido</button>
    </form>

    <?php include 'C:\xampp\htdocs\meusite.com.br\Aula 29.10\includes\footer.php'; ?>
</body>
</html>