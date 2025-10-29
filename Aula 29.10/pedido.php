<?php

include 'C:\xampp\htdocs\meusite.com.br\Aula 29.10\includes\funcoes.php';


$caminho_cardapio = 'C:\xampp\htdocs\meusite.com.br\Aula 29.10\dados\cardapio.json';
$caminho_pedidos  = 'C:\xampp\htdocs\meusite.com.br\Aula 29.10\dados\pedidos.json';


$cardapio = lerJson($caminho_cardapio);

// 1. CAPTURA DOS DADOS DO FORMULÁRIO
$quantidades = $_POST['quantidade'] ?? [];
$nomeCliente = trim($_POST['nome_cliente'] ?? 'Cliente Anônimo');
// Captura o campo de observações (assumindo o 'name="observacoes"' do meu ajuste anterior no index.php)
$observacoes = trim($_POST['observacoes'] ?? ''); 

$pedido = [];
$totalPedido = 0;


foreach ($cardapio as $item) {
    $id = $item['id'];
    
    $qtd = (int)($quantidades[$id] ?? 0);

    if ($qtd > 0) {
        $preco = (float)$item['preco'];
        $total_item = $preco * $qtd;

        
        $pedido[] = [
            'id' => $id,
            'nome' => $item['nome'],
            'preco' => $preco,
            'quantidade' => $qtd,
            'total' => $total_item
        ];

        $totalPedido += $total_item;
    }
}


if (!empty($pedido)) {
    $pedidos_existentes = lerJson($caminho_pedidos);

    
    $novo_id = 1;
    if (!empty($pedidos_existentes)) {
        
        $ultimo_id = max(array_column($pedidos_existentes, 'id'));
        $novo_id = $ultimo_id + 1;
    }

    
    $itens_salvar = [];
    foreach ($pedido as $item) {
        $itens_salvar[] = [
            'quantidade' => $item['quantidade'],
            'produto' => $item['nome'],
            'subtotal' => $item['total']
        ];
    }

    // 2. SALVANDO NOVO PEDIDO COM AS OBSERVAÇÕES
    $novo_pedido = [
        'id' => $novo_id,
        'cliente' => $nomeCliente,
        'data' => date('d/m/Y H:i:s'), 
        'itens' => $itens_salvar,
        'total' => $totalPedido,
        // 3. Usa a variável $observacoes e aplica htmlspecialchars
        'observacoes' => htmlspecialchars($observacoes), 
    ];

    $pedidos_existentes[] = $novo_pedido;
    

    gravarJson($caminho_pedidos, $pedidos_existentes);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumo do Pedido</title>
    <link rel="stylesheet" href="pedido.css"> 
</head>
<body>
    <?php include 'C:\xampp\htdocs\meusite.com.br\Aula 29.10\includes\header.php'; ?>

    <div class="pedido-container"> 
        
        <?php if (empty($pedido)): ?>
            <div class="pedido-vazio">
                <h1 class="titulo-pedido"> Pedido Vazio</h1>
                <p>Nenhum item foi selecionado. Volte ao <a href="index.php" class="link-cardapio">cardápio</a>.</p>
            </div>
            
        <?php else: ?>
            <div class="resumo-pedido">
                <h1 class="titulo-pedido"> Resumo do Pedido #<?php echo $novo_id; ?></h1>
                <p class="cliente-pedido">
                    <strong>Cliente:</strong> <?php echo htmlspecialchars($nomeCliente); ?>
                    <br>
                    <small>Data do Pedido: <?php echo date('d/m/Y H:i'); ?></small>
                </p>

                <table class="tabela-itens">
                    <thead>
                        <tr>
                            <th>Qtd</th>
                            <th>Produto</th>
                            <th>Preço Unit.</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedido as $p): ?>
                            <tr>
                                <td><?php echo $p['quantidade']; ?>x</td>
                                <td><?php echo htmlspecialchars($p['nome']); ?></td>
                                <td>R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></td>
                                <td>R$ <?php echo number_format($p['total'], 2, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?php if (!empty($observacoes)): ?>
                    <div class="observacoes-pedido">
                        <strong>Observações:</strong>
                        <p><?php echo nl2br(htmlspecialchars($observacoes)); ?></p>
                    </div>
                <?php endif; ?>


                <div class="total-pedido">
                    <span class="label-total">Total a Pagar:</span>
                    <span class="valor-final">R$ <?php echo number_format($totalPedido, 2, ',', '.'); ?></span>
                </div>
                
                <p class="mensagem-final">Obrigado por seu pedido! Seu número de pedido é **#<?php echo $novo_id; ?>**.</p>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'C:\xampp\htdocs\meusite.com.br\Aula 29.10\includes\footer.php'; ?>
</body>
</html>