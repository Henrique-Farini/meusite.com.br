<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados Json</title>
    <style>

    .dados {
        background-color: #393939ff;
        color: white;
        padding: 10px 20px;
        border: none; 
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-family: sans-serif;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        margin-right: 10px;
    }
    .cadastrar {
        background-color: #eb2273ff;
        color: white;
        padding: 10px 20px;
        border: none; 
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-family: sans-serif;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    form {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .dados:hover {
        background-color: #292929ff;
    }

    .conteudo {
        display: block;
        margin-top: 20px;
        text-align: center;
        color: #333;
        text-decoration: none;
    }



    </style>
</head>
<body>
    <form action="banco.json" method="post">
        <button type="submit" class="dados">Ver Dados Salvos</button>
        <button type="button" class="cadastrar" onclick="window.location.href='cadastro.html'">Novo Cadastro</button>
        <br><br>
        
        <a href="index.php" class="conteudo">Acessar meu conteudo</a>

    </form>
    <?php 

    ?>
    
</body>
</html>







<?php
    require_once "Usuario.php";
    require_once "Professor.php";
    require_once "Aluno.php";

    // Caminho do arquivo JSON
    $banco = 'banco.json';

    // Ler dados existentes
    $dados = [];
    if (file_exists($banco)) {
    $json = file_get_contents($banco);
    $dados = json_decode($json, true);
}

    // Receber dados do formulário
    $tipo = $_POST['tipo' ] ?? '';
    $nome = $_POST['nome' ] ?? '';
    $email = $_POST['email'] ?? '';
    $usuario = null;
    
    if ($tipo === 'professor') {
        $disciplina = $_POST['disciplina'] ?? '';
        $usuario = new Professor($nome, $email, $disciplina);
        
        $dados['professores'][] = [
            'nome' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'disciplina' => $usuario->getDisciplina()
        ];
    } elseif ($tipo === 'aluno') {
        $matricula = $_POST['matricula'] ?? '';
        $usuario = new Aluno($nome, $email, $matricula);
        $dados['alunos'][] = [
            'tipo' => 'aluno',
            'nome' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'matricula' => $usuario->getMatricula()
        ];
    }
    // Salvar dados atualizados
    // Salvar de volta no JSON
file_put_contents($banco, json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));




?>