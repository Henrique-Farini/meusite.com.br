<?php

include 'C:\xampp\htdocs\meusite.com.br\Aula 29.10\includes\funcoes.php';


$caminho_contatos = 'C:\xampp\htdocs\meusite.com.br\Aula 29.10\dados\contatos.json';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   
    $nome       = trim($_POST['nome'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $telefone   = trim($_POST['telefone'] ?? '');
    $assunto    = trim($_POST['assunto'] ?? 'Não informado');
    $mensagem   = trim($_POST['mensagem'] ?? '');

 
    if (empty($nome) || empty($email) || empty($mensagem)) {
        $status_mensagem = "Erro: Por favor, preencha todos os campos obrigatórios (Nome, E-mail e Mensagem).";
        $sucesso = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $status_mensagem = "Erro: O endereço de e-mail fornecido é inválido.";
        $sucesso = false;
    } else {
        
      
        $nova_mensagem = [
            'id'       => time(), 
            'data'     => date('d/m/Y H:i:s'),
            'nome'     => htmlspecialchars($nome),
            'email'    => htmlspecialchars($email),
            'telefone' => htmlspecialchars($telefone),
            'assunto'  => htmlspecialchars($assunto),
            'mensagem' => htmlspecialchars($mensagem),
            'lida'     => false 
        ];

       
        $contatos_existentes = lerJson($caminho_contatos) ?? [];

    
        $novo_id = 1;
        if (!empty($contatos_existentes)) {
            
            $ultimo_id = max(array_column($contatos_existentes, 'id'));
            $nova_mensagem['id'] = $ultimo_id + 1;
        }

        $contatos_existentes[] = $nova_mensagem;
        
       
        if (gravarJson($caminho_contatos, $contatos_existentes)) {
            $status_mensagem = "Sua mensagem foi enviada com sucesso! Em breve, entraremos em contato.";
            $sucesso = true;
        } else {
            $status_mensagem = "Erro ao salvar a mensagem. Tente novamente mais tarde.";
            $sucesso = false;
        }
    }
} else {

    header('Location: contato.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status do Contato</title>
    <link rel="stylesheet" href="processa_contato.css">
    <style>

    </style>
</head>
<body>
    <div class="status-container">
        <h1><?php echo $sucesso ? ' Sucesso!' : ' Atenção!'; ?></h1>
        <p><?php echo $status_mensagem; ?></p>
        <a href="contato.html">Voltar ao Contato</a>
        <a href="index.php">Ir ao Cardápio</a>
    </div>
</body>
</html>