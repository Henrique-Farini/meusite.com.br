<?php
function lerJson($caminho_arquivo) {
    if (!file_exists($caminho_arquivo) || filesize($caminho_arquivo) == 0) {
        return [];
    }
    $conteudo = file_get_contents($caminho_arquivo);
    return json_decode($conteudo, true);
}

function gravarJson($caminho_arquivo, $dados) {
    $json_string = json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents($caminho_arquivo, $json_string, LOCK_EX) !== false;
}

function adicionarPedido($pedido) {
    $arquivo = __DIR__ . '/../dados/pedidos.json';
    $pedidos = lerJson($arquivo);
    $pedido['id'] = count($pedidos) + 1;
    $pedido['data'] = date('d/m/Y H:i');
    $pedidos[] = $pedido;
    gravarJson($arquivo, $pedidos);
}

function calcularTotal($itens) {
    $total = 0;
    foreach ($itens as $item) {
        $total += $item['preco'];
    }
    return number_format($total, 2, ',', '.');
}
?>
