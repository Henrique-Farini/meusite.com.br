<?php
    $pessoa = [
        "nome" => "João",
        "idade" => 30,
        "cpf" => "123.456.789-00",
        "rg" => "12.345.678-9",
        "peso" => 72.5
    ];

    echo "Olá " . $pessoa["nome"] . 
         ", você está com " . $pessoa["idade"] . " anos" .
         ", seu cpf é " . $pessoa["cpf"] . 
         ", seu rg é  " . $pessoa["rg"] . 
         ", e por último seu peso, que é  " . $pessoa["peso"] . " kg.";
?>

