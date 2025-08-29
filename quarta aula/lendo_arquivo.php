<?php 
    $arquivo = fopen("dados.txt", "r");
    while(!feof($arquivo)) {
        $linha = fgets($arquivo);
        echo $linha . "<br>";
    }
    fclose($arquivo);
    echo "Leitura do arquivo concluída com sucesso!"



?>

