<?php 
function nomeDaFuncao($parametro1, $parametro2) {
    //código que será executado
    $resultado = $parametro1 + $parametro2;
    return $resultado;
}


//chamndo a função
$soma = nomeDaFuncao(5, 10);
echo "O resultado é: " . $soma;





?>