<?php
    $pessoa = array("nome" => "João", 
    "idade" => 30,
    "cpf" => 111111111112,
    "peso" => 76.5
);
   
    $chaves = array_keys($pessoa); 

for ($i = 0; $i < count($pessoa); $i++) {
    echo $chaves[$i] . ": " . $pessoa[$chaves[$i]] . "<br>";
}





?>
