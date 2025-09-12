<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem</title>
</head>
<body style="font-family: Arial; background-color: #ffdbedff; margin:0; padding:20px;">

<header style="border: 2px solid black; background-color: pink; padding:15px; border-radius:10px; max-width:700px; margin:auto;">

<?php
    $sala = $_POST['sala'] ?? "";
    $nome = $_POST['nome'] ?? "";
    $ra   = $_POST['ra'] ?? "";


    if (!empty($sala) && !empty($nome) && !empty($ra)) {
        $arquivo = fopen("dados.txt", "a");
        fwrite($arquivo, "$sala | $nome | $ra\n");
        fclose($arquivo);
    }

    
    if (isset($_POST['apagar'])) {
        $linhas = file("dados.txt");
        if (count($linhas) > 0) {
            array_pop($linhas); 
            file_put_contents("dados.txt", implode("", $linhas));
        }
    }

    echo "<h2>Lista de Cadastros</h2>";
    if (file_exists("dados.txt")) {
        $arquivo = fopen("dados.txt", "r");
        while (!feof($arquivo)) {
            echo fgets($arquivo) . "<br>";
        }
        fclose($arquivo);
    } else {
        echo "<p>Nenhum cadastro encontrado.</p>";
    }
?>


<?php
echo "<br>";
echo count(file("dados.txt")) . " cadastros no total.";
echo "<br>";
?>


<form method="post" style="margin-top:20px;">
    <input type="hidden" name="apagar" value="1">
    <button type="submit" 
            style="background-color:#eb2273ff; color:white; padding:10px 20px; border:none; border-radius:5px; cursor:pointer; font-size:16px;">
        Apagar Último Cadastro
    </button>
</form>


<form action="index.php" method="get" style="margin-top:10px;">
    <button type="submit" 
            style="background-color:white; color:#eb2273ff; padding:10px 20px; border:none; border-radius:5px; cursor:pointer; font-size:16px;">
        Novo Cadastro
    </button>
</form>


</header>
</body>
</html>
