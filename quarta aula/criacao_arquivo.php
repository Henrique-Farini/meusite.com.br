<?php 
    $arquivo = fopen("dados.txt", "w");
     fwrite($arquivo, "Primeira linha de texto\n");
    fclose($arquivo);
    echo "Seu arquivo foi criado com sucesso!"





?>